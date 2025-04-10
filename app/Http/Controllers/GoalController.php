<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\RecurringTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    public function index()
    {
        $goals = Auth::user()->goals()
            ->orderBy('created_at', 'desc')
            ->get();

        $recurringTransactions = Auth::user()->recurringTransactions()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('goals.index', compact('goals', 'recurringTransactions'));
    }

    public function create()
    {
        return view('goals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0.01',
            'target_date' => 'required|date|after:today',
        ]);

        Auth::user()->goals()->create($validated);

        return redirect()->route('goals.index')
            ->with('success', 'Meta criada com sucesso!');
    }

    public function edit(Goal $goal)
    {
        $this->authorize('update', $goal);
        return view('goals.edit', compact('goal'));
    }

    public function update(Request $request, Goal $goal)
    {
        $this->authorize('update', $goal);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0.01',
            'target_date' => 'required|date|after:today',
        ]);

        $goal->update($validated);

        return redirect()->route('goals.index')
            ->with('success', 'Meta atualizada com sucesso!');
    }

    public function destroy(Goal $goal)
    {
        $this->authorize('delete', $goal);

        $goal->delete();

        return redirect()->route('goals.index')
            ->with('success', 'Meta excluída com sucesso!');
    }

    public function addProgress(Request $request, Goal $goal)
    {
        $this->authorize('update', $goal);

        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'date' => 'required|date',
        ]);

        $goal->current_amount += $validated['amount'];
        $goal->save();

        return redirect()->route('goals.index')
            ->with('success', 'Progresso adicionado com sucesso!');
    }
}
