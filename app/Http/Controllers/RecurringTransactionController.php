<?php

namespace App\Http\Controllers;

use App\Models\RecurringTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecurringTransactionController extends Controller
{
    public function index()
    {
        $recurringTransactions = Auth::user()->recurringTransactions()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('goals.index', compact('recurringTransactions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'frequency' => 'required|in:monthly,bimonthly,quarterly,semiannual,annual',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        Auth::user()->recurringTransactions()->create($validated);

        return redirect()->route('goals.index')
            ->with('success', 'Transação recorrente criada com sucesso!');
    }

    public function update(Request $request, RecurringTransaction $recurringTransaction)
    {
        $this->authorize('update', $recurringTransaction);

        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'frequency' => 'required|in:monthly,bimonthly,quarterly,semiannual,annual',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        $recurringTransaction->update($validated);

        return redirect()->route('goals.index')
            ->with('success', 'Transação recorrente atualizada com sucesso!');
    }

    public function destroy(RecurringTransaction $recurringTransaction)
    {
        $this->authorize('delete', $recurringTransaction);

        $recurringTransaction->delete();

        return redirect()->route('goals.index')
            ->with('success', 'Transação recorrente excluída com sucesso!');
    }
}
