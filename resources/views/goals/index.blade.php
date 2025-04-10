@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Metas Financeiras</h1>
        <a href="{{ route('goals.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
            <i data-lucide="plus" class="h-5 w-5 mr-2"></i>
            Nova Meta
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Lista de Metas -->
        <div class="lg:col-span-2 space-y-6">
            @forelse($goals as $goal)
                @php
                    $progress = ($goal->current_amount / $goal->target_amount) * 100;
                    $progressColor = $progress >= 75 ? 'bg-green-600' :
                                   ($progress >= 50 ? 'bg-blue-600' :
                                   ($progress >= 25 ? 'bg-yellow-600' : 'bg-red-600'));

                    $daysRemaining = now()->diffInDays($goal->target_date);
                    $dailyRequired = $daysRemaining > 0 ?
                        ($goal->target_amount - $goal->current_amount) / $daysRemaining : 0;
                @endphp

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">{{ $goal->title }}</h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Meta: R$ {{ number_format($goal->target_amount, 2, ',', '.') }}
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">
                                Conclusão prevista: {{ $goal->target_date->format('d/m/Y') }}
                            </p>
                            <p class="text-sm text-gray-500">
                                Faltam {{ $daysRemaining }} dias
                            </p>
                        </div>
                    </div>

                    <!-- Barra de Progresso -->
                    <div class="relative pt-1 mb-4">
                        <div class="flex mb-2 items-center justify-between">
                            <div>
                                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-primary bg-primary/10">
                                    Progresso
                                </span>
                            </div>
                            <div class="text-right">
                                <span class="text-xs font-semibold inline-block text-primary">
                                    {{ number_format($progress, 1) }}%
                                </span>
                            </div>
                        </div>
                        <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                            <div
                                style="width: {{ $progress }}%"
                                class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center {{ $progressColor }}"
                            ></div>
                        </div>
                    </div>

                    <!-- Informações de Progresso -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-500">Valor Atual</p>
                            <p class="text-lg font-semibold text-gray-900">
                                R$ {{ number_format($goal->current_amount, 2, ',', '.') }}
                            </p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-500">Valor Restante</p>
                            <p class="text-lg font-semibold text-gray-900">
                                R$ {{ number_format($goal->target_amount - $goal->current_amount, 2, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Previsão Diária -->
                    <div class="bg-blue-50 p-4 rounded-lg mb-4">
                        <p class="text-sm text-blue-600">
                            Para atingir a meta no prazo, você precisa economizar:
                        </p>
                        <p class="text-lg font-semibold text-blue-900">
                            R$ {{ number_format($dailyRequired, 2, ',', '.') }} por dia
                        </p>
                    </div>

                    <!-- Ações -->
                    <div class="flex justify-end space-x-3">
                        <button
                            type="button"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-primary bg-primary/10 hover:bg-primary/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
                            onclick="openAddProgressModal({{ $goal->id }})"
                        >
                            <i data-lucide="plus" class="h-4 w-4 mr-1"></i>
                            Adicionar Progresso
                        </button>
                        <a
                            href="{{ route('goals.edit', $goal) }}"
                            class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
                        >
                            <i data-lucide="edit" class="h-4 w-4 mr-1"></i>
                            Editar
                        </a>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-lg shadow p-8 text-center">
                    <i data-lucide="target" class="h-12 w-12 text-gray-400 mx-auto"></i>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhuma meta definida</h3>
                    <p class="mt-1 text-sm text-gray-500">Comece criando sua primeira meta financeira.</p>
                    <div class="mt-6">
                        <a href="{{ route('goals.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            <i data-lucide="plus" class="h-5 w-5 mr-2"></i>
                            Criar Meta
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Painel Lateral -->
        <div class="space-y-6">
            <!-- Resumo de Metas -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Resumo</h2>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500">Total de Metas</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $goals->count() }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Valor Total das Metas</p>
                        <p class="text-2xl font-semibold text-gray-900">
                            R$ {{ number_format($goals->sum('target_amount'), 2, ',', '.') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Progresso Médio</p>
                        <p class="text-2xl font-semibold text-gray-900">
                            {{ number_format($goals->avg('progress') ?? 0, 1) }}%
                        </p>
                    </div>
                </div>
            </div>

            <!-- Transações Recorrentes -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">Transações Recorrentes</h2>
                    <button
                        type="button"
                        class="text-primary hover:text-primary/80"
                        onclick="openRecurringTransactionModal()"
                    >
                        <i data-lucide="plus" class="h-5 w-5"></i>
                    </button>
                </div>
                <div class="space-y-4">
                    @forelse($recurringTransactions ?? [] as $transaction)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $transaction->description }}</p>
                                <p class="text-xs text-gray-500">
                                    {{ $transaction->amount }} • {{ $transaction->frequency }}
                                </p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button class="text-gray-400 hover:text-gray-500">
                                    <i data-lucide="edit" class="h-4 w-4"></i>
                                </button>
                                <button class="text-gray-400 hover:text-gray-500">
                                    <i data-lucide="trash" class="h-4 w-4"></i>
                                </button>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">
                            Nenhuma transação recorrente cadastrada
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Adicionar Progresso -->
<div id="addProgressModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">Adicionar Progresso</h3>
            <button onclick="closeAddProgressModal()" class="text-gray-400 hover:text-gray-500">
                <i data-lucide="x" class="h-5 w-5"></i>
            </button>
        </div>
        <form id="addProgressForm" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700">Valor</label>
                    <input
                        type="number"
                        name="amount"
                        id="amount"
                        step="0.01"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"
                        required
                    >
                </div>
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Data</label>
                    <input
                        type="date"
                        name="date"
                        id="date"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"
                        required
                    >
                </div>
            </div>
            <div class="mt-6 flex justify-end space-x-3">
                <button
                    type="button"
                    onclick="closeAddProgressModal()"
                    class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
                >
                    Cancelar
                </button>
                <button
                    type="submit"
                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
                >
                    Salvar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal de Transação Recorrente -->
<div id="recurringTransactionModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">Nova Transação Recorrente</h3>
            <button onclick="closeRecurringTransactionModal()" class="text-gray-400 hover:text-gray-500">
                <i data-lucide="x" class="h-5 w-5"></i>
            </button>
        </div>
        <form id="recurringTransactionForm" method="POST" action="{{ route('recurring-transactions.store') }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                    <input
                        type="text"
                        name="description"
                        id="description"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"
                        required
                    >
                </div>
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700">Valor</label>
                    <input
                        type="number"
                        name="amount"
                        id="amount"
                        step="0.01"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"
                        required
                    >
                </div>
                <div>
                    <label for="frequency" class="block text-sm font-medium text-gray-700">Frequência</label>
                    <select
                        name="frequency"
                        id="frequency"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"
                        required
                    >
                        <option value="monthly">Mensal</option>
                        <option value="bimonthly">Bimestral</option>
                        <option value="quarterly">Trimestral</option>
                        <option value="semiannual">Semestral</option>
                        <option value="annual">Anual</option>
                    </select>
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700">Data de Término (Opcional)</label>
                    <input
                        type="date"
                        name="end_date"
                        id="end_date"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"
                    >
                </div>
            </div>
            <div class="mt-6 flex justify-end space-x-3">
                <button
                    type="button"
                    onclick="closeRecurringTransactionModal()"
                    class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
                >
                    Cancelar
                </button>
                <button
                    type="submit"
                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
                >
                    Salvar
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openAddProgressModal(goalId) {
        const modal = document.getElementById('addProgressModal');
        const form = document.getElementById('addProgressForm');
        form.action = `/goals/${goalId}/add-progress`;
        modal.classList.remove('hidden');
    }

    function closeAddProgressModal() {
        const modal = document.getElementById('addProgressModal');
        modal.classList.add('hidden');
    }

    function openRecurringTransactionModal() {
        const modal = document.getElementById('recurringTransactionModal');
        modal.classList.remove('hidden');
    }

    function closeRecurringTransactionModal() {
        const modal = document.getElementById('recurringTransactionModal');
        modal.classList.add('hidden');
    }
</script>
@endpush
@endsection
