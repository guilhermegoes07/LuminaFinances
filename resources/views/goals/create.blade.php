@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-6">Novo Objetivo Financeiro</h1>

        <form method="POST" action="{{ route('goals.store') }}" class="space-y-4">
            @csrf

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required
                />
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="target_amount" class="block text-sm font-medium text-gray-700">Valor da Meta</label>
                <input
                    type="number"
                    name="target_amount"
                    id="target_amount"
                    step="0.01"
                    value="{{ old('target_amount') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required
                />
                @error('target_amount')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="current_amount" class="block text-sm font-medium text-gray-700">Valor Atual</label>
                <input
                    type="number"
                    name="current_amount"
                    id="current_amount"
                    step="0.01"
                    value="{{ old('current_amount', 0) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required
                />
                @error('current_amount')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700">Data de Início</label>
                <input
                    type="date"
                    name="start_date"
                    id="start_date"
                    value="{{ old('start_date', date('Y-m-d')) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required
                />
                @error('start_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="target_date" class="block text-sm font-medium text-gray-700">Data Alvo</label>
                <input
                    type="date"
                    name="target_date"
                    id="target_date"
                    value="{{ old('target_date') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required
                />
                @error('target_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-4 mt-6">
                <a
                    href="{{ route('goals.index') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                >
                    Cancelar
                </a>
                <button
                    type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    Criar Objetivo
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
