@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">
        {{ isset($transaction) ? 'Editar Transação' : 'Nova Transação' }}
    </h1>

    <form method="POST" action="{{ isset($transaction) ? route('transactions.update', $transaction) : route('transactions.store') }}" class="bg-white rounded-lg shadow p-6">
        @csrf
        @if(isset($transaction))
            @method('PUT')
        @endif

        <div class="space-y-4">
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                <input type="text" name="description" id="description" value="{{ old('description', $transaction->description ?? '') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700">Valor</label>
                <input type="number" step="0.01" name="amount" id="amount" value="{{ old('amount', $transaction->amount ?? '') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('amount')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Data</label>
                <input type="date" name="date" id="date" value="{{ old('date', isset($transaction) ? $transaction->date->format('Y-m-d') : '') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">Tipo</label>
                <select name="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="income" {{ old('type', $transaction->type ?? '') === 'income' ? 'selected' : '' }}>Receita</option>
                    <option value="expense" {{ old('type', $transaction->type ?? '') === 'expense' ? 'selected' : '' }}>Despesa</option>
                </select>
                @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Categoria</label>
                <select name="category_id" id="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $transaction->category_id ?? '') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('transactions.index') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                {{ isset($transaction) ? 'Atualizar' : 'Salvar' }}
            </button>
        </div>
    </form>
</div>
@endsection
