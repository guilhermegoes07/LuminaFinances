@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-6">Nova Transação</h1>

        <form method="POST" action="{{ route('transactions.store') }}" class="space-y-4">
            @csrf

            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">Tipo</label>
                <select
                    name="type"
                    id="type"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required
                >
                    <option value="expense" {{ old('type') === 'expense' ? 'selected' : '' }}>Despesa</option>
                    <option value="income" {{ old('type') === 'income' ? 'selected' : '' }}>Receita</option>
                </select>
                @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                <input
                    type="text"
                    name="description"
                    id="description"
                    value="{{ old('description') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required
                />
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700">Valor</label>
                <input
                    type="number"
                    name="amount"
                    id="amount"
                    step="0.01"
                    value="{{ old('amount') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required
                />
                @error('amount')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Categoria</label>
                <select
                    name="category_id"
                    id="category_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required
                >
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Data</label>
                <input
                    type="date"
                    name="date"
                    id="date"
                    value="{{ old('date', date('Y-m-d')) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required
                />
                @error('date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-4 mt-6">
                <a
                    href="{{ route('transactions.index') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                >
                    Cancelar
                </a>
                <button
                    type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    Salvar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
