<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Goal;
use App\Models\RecurringTransaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Calcular resumo financeiro
        $income = $user->transactions()->where('type', 'income')->sum('amount');
        $expenses = $user->transactions()->where('type', 'expense')->sum('amount');
        $balance = $income - $expenses;

        // Buscar despesas por categoria para o gráfico
        $expensesByCategory = DB::table('categories')
            ->select(
                'categories.id',
                'categories.name',
                DB::raw('COALESCE(SUM(transactions.amount), 0) as total_amount')
            )
            ->leftJoin('transactions', function($join) {
                $join->on('categories.id', '=', 'transactions.category_id')
                    ->where('transactions.type', 'expense')
                    ->whereMonth('transactions.date', now()->month)
                    ->whereYear('transactions.date', now()->year);
            })
            ->where('categories.user_id', $user->id)
            ->where('categories.type', 'expense')
            ->groupBy('categories.id', 'categories.name')
            ->havingRaw('COALESCE(SUM(transactions.amount), 0) > 0')
            ->get()
            ->map(function ($category) {
                return [
                    'name' => $category->name,
                    'amount' => $category->total_amount
                ];
            });

        // Buscar objetivos financeiros com cálculos adicionais
        $goals = $user->goals()->orderBy('created_at', 'desc')->take(3)->get();

        // Transações recentes com paginação e filtros
        $query = $user->transactions()->with('category');

        // Aplicar filtros
        if (request()->has('type') && request('type') !== 'all') {
            $query->where('type', request('type'));
        }

        if (request()->has('category') && request('category') !== 'all') {
            $query->where('category_id', request('category'));
        }

        if (request()->has('date')) {
            $query->whereDate('date', request('date'));
        }

        $recentTransactions = $query->orderBy('date', 'desc')->paginate(10);

        // Buscar transações recorrentes
        $recurringTransactions = RecurringTransaction::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($transaction) {
                $transaction->next_date = $this->calculateNextDate($transaction);
                return $transaction;
            });

        // Buscar categorias para o modal
        $categories = $user->categories()->orderBy('name')->get();

        return view('dashboard', compact(
            'income',
            'expenses',
            'balance',
            'goals',
            'recentTransactions',
            'recurringTransactions',
            'expensesByCategory',
            'categories'
        ));
    }

    private function calculateNextDate($transaction)
    {
        $startDate = Carbon::parse($transaction->start_date);
        $today = Carbon::today();

        if ($today->lt($startDate)) {
            return $startDate;
        }

        $nextDate = $startDate;
        while ($nextDate->lt($today)) {
            switch ($transaction->frequency) {
                case 'monthly':
                    $nextDate->addMonth();
                    break;
                case 'bimonthly':
                    $nextDate->addMonths(2);
                    break;
                case 'quarterly':
                    $nextDate->addMonths(3);
                    break;
                case 'semiannual':
                    $nextDate->addMonths(6);
                    break;
                case 'annual':
                    $nextDate->addYear();
                    break;
            }
        }

        if ($transaction->end_date && $nextDate->gt(Carbon::parse($transaction->end_date))) {
            return null;
        }

        return $nextDate;
    }

    public function storeRecurringTransaction(Request $request)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'frequency' => 'required|in:monthly,bimonthly,quarterly,semiannual,annual',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        RecurringTransaction::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'description' => $request->description,
            'amount' => $request->amount,
            'frequency' => $request->frequency,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Transação recorrente cadastrada com sucesso!');
    }

    public function destroyRecurringTransaction(RecurringTransaction $transaction)
    {
        $this->authorize('delete', $transaction);

        $transaction->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Transação recorrente removida com sucesso!');
    }
}
