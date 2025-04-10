@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-background">
    <!-- Header com Gradiente -->
    <div class="bg-gradient-to-r from-primary to-blue-200 shadow-lg">
        <div class="container mx-auto px-4 py-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="flex items-center space-x-2">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-white">Dashboard Financeiro</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button
                        onclick="openTransactionModal()"
                        class="flex items-center space-x-2 hover:font-bold text-white px-6 py-3 rounded-xl transition-all duration-150 ease-in-out backdrop-blur-sm"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span>Nova Transação</span>
                    </button>
                    <a href="{{ route('categories.index') }}" class="flex items-center space-x-2 hover:font-bold text-white px-6 py-3 rounded-xl transition-all duration-150 ease-in-out backdrop-blur-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <span>Gerenciar Categorias</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Conteúdo Principal -->
    <div class="container mx-auto px-4 py-8">
        <!-- Resumo Financeiro Compacto -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Receitas</p>
                        <p class="text-2xl font-bold text-green-600 mt-1">R$ {{ number_format($income, 2, ',', '.') }}</p>
                    </div>
                    <div class="bg-green-50 p-3 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Despesas</p>
                        <p class="text-2xl font-bold text-red-600 mt-1">R$ {{ number_format($expenses, 2, ',', '.') }}</p>
                    </div>
                    <div class="bg-red-50 p-3 rounded-full">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Saldo</p>
                        <p class="text-2xl font-bold {{ $balance >= 0 ? 'text-green-600' : 'text-red-600' }} mt-1">
                            R$ {{ number_format($balance, 2, ',', '.') }}
                        </p>
                    </div>
                    <div class="bg-blue-50 p-3 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Metas Financeiras -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">Metas Financeiras</h2>
                        <a href="{{ route('goals.index') }}" class="text-primary hover:text-primary-dark text-sm font-medium">
                            Ver todas
                        </a>
                    </div>
                    <div class="space-y-4">
                        @forelse($goals as $goal)
                            <div class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                <div class="flex justify-between items-center mb-2">
                                    <h3 class="font-medium">{{ $goal->title }}</h3>
                                    <span class="text-sm text-gray-600">{{ number_format(($goal->current_amount / $goal->target_amount) * 100, 1) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                                    <div class="bg-primary h-2.5 rounded-full transition-all duration-300"
                                         style="width: {{ ($goal->current_amount / $goal->target_amount) * 100 }}%"></div>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600">
                                    <p>R$ {{ number_format($goal->current_amount, 2, ',', '.') }}</p>
                                    <p>R$ {{ number_format($goal->target_amount, 2, ',', '.') }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">Nenhuma meta definida</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Histórico de Transações -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">Histórico de Transações</h2>
                        <div class="flex items-center space-x-4">
                            <select id="filterType" class="text-sm border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring-primary">
                                <option value="all">Todos os Tipos</option>
                                <option value="income">Receitas</option>
                                <option value="expense">Despesas</option>
                            </select>
                            <select id="filterCategory" class="text-sm border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring-primary">
                                <option value="all">Todas as Categorias</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <input type="date" id="filterDate" class="text-sm border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring-primary">
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoria</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="transactionsTableBody">
                                @forelse($recentTransactions as $transaction)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $transaction->date->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $transaction->description }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $transaction->category->name ?? 'Sem categoria' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm {{ $transaction->type === 'income' ? 'text-green-600' : 'text-red-600' }}">
                                            R$ {{ number_format($transaction->amount, 2, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="flex items-center space-x-2">
                                                <button onclick="editTransaction({{ $transaction->id }})" class="text-gray-400 hover:text-gray-500">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-gray-400 hover:text-gray-500">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                            Nenhuma transação encontrada
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $recentTransactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Transação -->
<div id="transactionModal" class="fixed inset-0 flex items-center justify-center bg-gray-600 bg-opacity-50 z-50" style="display: none;">
    <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Nova Transação</h3>
            <button onclick="closeTransactionModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Tipo</label>
                    <select name="type" id="type" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        <option value="income">Receita</option>
                        <option value="expense">Despesa</option>
                    </select>
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                    <input type="text" name="description" id="description" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                </div>
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700">Valor</label>
                    <input type="number" step="0.01" name="amount" id="amount" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                </div>
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Categoria</label>
                    <select name="category_id" id="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        <option value="">Sem categoria</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Data</label>
                    <input type="date" name="date" id="date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary" value="{{ date('Y-m-d') }}">
                </div>
            </div>
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" onclick="closeTransactionModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    Cancelar
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-primary border border-transparent rounded-md hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    Salvar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openTransactionModal() {
        console.log('Abrindo modal...');
        const modal = document.getElementById('transactionModal');
        if (modal) {
            modal.style.display = 'flex';
        }
    }

    function closeTransactionModal() {
        console.log('Fechando modal...');
        const modal = document.getElementById('transactionModal');
        if (modal) {
            modal.style.display = 'none';
        }
    }

    // Quando o usuário clica fora do modal, fecha o modal
    window.onclick = function(event) {
        const modal = document.getElementById('transactionModal');
        if (event.target === modal) {
            closeTransactionModal();
        }
    }

    function toggleRecurringFields() {
        const recurringFields = document.getElementById('recurringFields');
        const frequency = document.getElementById('frequency');
        const endDate = document.getElementById('end_date');

        if (document.getElementById('is_recurring').checked) {
            recurringFields.classList.remove('hidden');
            frequency.setAttribute('required', 'required');
        } else {
            recurringFields.classList.add('hidden');
            frequency.removeAttribute('required');
            endDate.removeAttribute('required');
        }
    }

    function editRecurringTransaction(id) {
        // Implementar edição
        console.log('Editar transação:', id);
    }
</script>
@endsection
