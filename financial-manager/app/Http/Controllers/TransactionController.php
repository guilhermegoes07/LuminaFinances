<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Profile;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $profileId = $request->query('profile_id');
        $type = $request->query('type');
        $categoryId = $request->query('category_id');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = Transaction::query();

        if ($profileId) {
            $profile = Profile::findOrFail($profileId);
            $this->authorize('view', $profile);
            $query->where('profile_id', $profileId);
        } else {
            $query->whereIn('profile_id', Auth::user()->profiles->pluck('id'));
        }

        if ($type) {
            $query->where('type', $type);
        }

        if ($categoryId) {
            $category = Category::findOrFail($categoryId);
            $this->authorize('view', $category);
            $query->where('category_id', $categoryId);
        }

        if ($startDate) {
            $query->where('date', '>=', $startDate);
        }

        if ($endDate) {
            $query->where('date', '<=', $endDate);
        }

        $transactions = $query->with(['profile', 'category'])->get();
        return response()->json($transactions);
    }

    public function store(Request $request)
    {
        $request->validate([
            'profile_id' => 'required|exists:profiles,id',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
            'date' => 'required|date',
            'is_recurring' => 'boolean',
            'recurring_frequency' => 'required_if:is_recurring,true|in:daily,weekly,monthly,yearly',
            'recurring_end_date' => 'required_if:is_recurring,true|date|after:date',
        ]);

        $profile = Profile::findOrFail($request->profile_id);
        $this->authorize('update', $profile);

        $category = Category::findOrFail($request->category_id);
        $this->authorize('view', $category);

        $transaction = Transaction::create([
            'profile_id' => $request->profile_id,
            'category_id' => $request->category_id,
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
            'date' => $request->date,
            'is_recurring' => $request->is_recurring ?? false,
            'recurring_frequency' => $request->recurring_frequency,
            'recurring_end_date' => $request->recurring_end_date,
        ]);

        return response()->json($transaction->load(['profile', 'category']), 201);
    }

    public function show(Transaction $transaction)
    {
        $this->authorize('view', $transaction->profile);
        return response()->json($transaction->load(['profile', 'category']));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $this->authorize('update', $transaction->profile);

        $request->validate([
            'category_id' => 'sometimes|required|exists:categories,id',
            'type' => 'sometimes|required|in:income,expense',
            'amount' => 'sometimes|required|numeric|min:0',
            'description' => 'sometimes|required|string|max:255',
            'date' => 'sometimes|required|date',
            'is_recurring' => 'boolean',
            'recurring_frequency' => 'required_if:is_recurring,true|in:daily,weekly,monthly,yearly',
            'recurring_end_date' => 'required_if:is_recurring,true|date|after:date',
        ]);

        if ($request->has('category_id')) {
            $category = Category::findOrFail($request->category_id);
            $this->authorize('view', $category);
        }

        $transaction->update($request->all());

        return response()->json($transaction->load(['profile', 'category']));
    }

    public function destroy(Transaction $transaction)
    {
        $this->authorize('update', $transaction->profile);
        $transaction->delete();
        return response()->json(null, 204);
    }
}
