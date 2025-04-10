<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\RecurringTransaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $transactions = Transaction::where('user_id', $user->id)
            ->with('category')
            ->orderBy('date', 'desc')
            ->paginate(10);

        $categories = Category::where('user_id', $user->id)
            ->orderBy('name')
            ->get();

        return view('transactions.index', compact('transactions', 'categories'));
    }

    public function create()
    {
        $user = Auth::user();
        $categories = Category::where('user_id', $user->id)
            ->orderBy('name')
            ->get();

        return view('transactions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'category_id' => 'nullable|exists:categories,id',
            'date' => 'required|date',
        ]);

        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'type' => $request->type,
            'description' => $request->description,
            'amount' => $request->amount,
            'category_id' => $request->category_id ?: null,
            'date' => $request->date,
        ]);

        // Manter os filtros atuais na URL
        $redirectUrl = route('dashboard');
        if ($request->has('type')) {
            $redirectUrl .= '?type=' . $request->type;
        }
        if ($request->has('category')) {
            $redirectUrl .= '&category=' . $request->category;
        }
        if ($request->has('date')) {
            $redirectUrl .= '&date=' . $request->date;
        }

        return redirect($redirectUrl)
            ->with('success', 'Transação adicionada com sucesso!');
    }

    public function edit(Transaction $transaction)
    {
        $this->authorize('update', $transaction);

        $user = Auth::user();
        $categories = Category::where('user_id', $user->id)
            ->orderBy('name')
            ->get();

        return view('transactions.edit', compact('transaction', 'categories'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $this->authorize('update', $transaction);

        $request->validate([
            'type' => 'required|in:income,expense',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
        ]);

        $transaction->update([
            'type' => $request->type,
            'description' => $request->description,
            'amount' => $request->amount,
            'category_id' => $request->category_id,
            'date' => $request->date,
        ]);

        return redirect()->route('transactions.index')
            ->with('success', 'Transação atualizada com sucesso!');
    }

    public function destroy(Transaction $transaction)
    {
        $this->authorize('delete', $transaction);

        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transação removida com sucesso!');
    }
}
