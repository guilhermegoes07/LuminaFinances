<?php

namespace App\Console\Commands;

use App\Models\RecurringTransaction;
use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Console\Command;
use Carbon\Carbon;

class ProcessRecurringTransactions extends Command
{
    protected $signature = 'transactions:process-recurring';
    protected $description = 'Processa transações recorrentes e cria novas transações';

    public function handle()
    {
        $today = Carbon::today();
        $recurringTransactions = RecurringTransaction::where('start_date', '<=', $today)
            ->where(function ($query) use ($today) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', $today);
            })
            ->where(function ($query) use ($today) {
                $query->whereNull('last_processed_at')
                    ->orWhere('last_processed_at', '<', $today);
            })
            ->get();

        foreach ($recurringTransactions as $recurring) {
            $lastProcessed = $recurring->last_processed_at ? Carbon::parse($recurring->last_processed_at) : null;

            if ($this->shouldProcess($recurring, $today, $lastProcessed)) {
                $this->createTransaction($recurring);
                $recurring->update(['last_processed_at' => $today]);
                $this->info("Transação recorrente processada: {$recurring->description}");
            }
        }

        $this->info('Transações recorrentes processadas com sucesso!');
    }

    protected function shouldProcess(RecurringTransaction $recurring, Carbon $today, ?Carbon $lastProcessed): bool
    {
        if (!$lastProcessed) {
            return true;
        }

        $diff = $today->diffInDays($lastProcessed);

        return match ($recurring->frequency) {
            'monthly' => $diff >= 30,
            'bimonthly' => $diff >= 60,
            'quarterly' => $diff >= 90,
            'semiannual' => $diff >= 180,
            'annual' => $diff >= 365,
            default => false,
        };
    }

    protected function createTransaction(RecurringTransaction $recurring)
    {
        $category = Category::where('user_id', $recurring->user_id)
            ->where('name', 'Recorrente')
            ->where('type', $recurring->type)
            ->first();

        if (!$category) {
            $category = Category::create([
                'user_id' => $recurring->user_id,
                'name' => 'Recorrente',
                'type' => $recurring->type,
            ]);
        }

        Transaction::create([
            'user_id' => $recurring->user_id,
            'type' => $recurring->type,
            'description' => $recurring->description,
            'amount' => $recurring->amount,
            'category_id' => $category->id,
            'date' => Carbon::today(),
        ]);
    }
}
