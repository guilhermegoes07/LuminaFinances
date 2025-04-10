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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-white">Gerenciar Categorias</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 hover:font-bold text-white px-6 py-3 rounded-xl transition-all duration-150 ease-in-out backdrop-blur-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Voltar ao Dashboard</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Conteúdo Principal -->
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Lista de Categorias -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold">Suas Categorias</h2>
                    <button
                        onclick="openCategoryModal()"
                        class="text-primary hover:text-primary-dark text-sm font-medium flex items-center space-x-1"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span>Nova Categoria</span>
                    </button>
                </div>
                <div class="space-y-3">
                    @forelse($categories as $category)
                        <div class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-4">
                                    <div class="p-2 rounded-full {{ $category->type === 'income' ? 'bg-green-50' : 'bg-red-50' }}">
                                        <svg class="w-5 h-5 {{ $category->type === 'income' ? 'text-green-600' : 'text-red-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $category->type === 'income' ? 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z' : 'M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z' }}" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium">{{ $category->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $category->type === 'income' ? 'Receita' : 'Despesa' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button
                                        onclick="editCategory({{ $category->id }}, '{{ $category->name }}', '{{ $category->type }}')"
                                        class="text-gray-400 hover:text-gray-500 p-2 rounded-full hover:bg-gray-200 transition-colors duration-200"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-gray-500 p-2 rounded-full hover:bg-gray-200 transition-colors duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Nenhuma categoria cadastrada</p>
                    @endforelse
                </div>
            </div>

            <!-- Estatísticas -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-xl font-semibold mb-6">Estatísticas</h2>
                <div class="space-y-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Total de Categorias</h3>
                        <p class="text-3xl font-bold text-primary">{{ $categories->count() }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Categorias de Receita</h3>
                        <p class="text-3xl font-bold text-green-600">{{ $categories->where('type', 'income')->count() }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Categorias de Despesa</h3>
                        <p class="text-3xl font-bold text-red-600">{{ $categories->where('type', 'expense')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Categoria -->
<div id="categoryModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4 shadow-xl">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Nova Categoria</h3>
            <button onclick="closeCategoryModal()" class="text-gray-400 hover:text-gray-500 p-2 rounded-full hover:bg-gray-100 transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form id="categoryForm" method="POST" action="{{ route('categories.store') }}">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"
                        required
                    >
                </div>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Tipo</label>
                    <select
                        name="type"
                        id="type"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"
                        required
                    >
                        <option value="expense">Despesa</option>
                        <option value="income">Receita</option>
                    </select>
                </div>
            </div>
            <div class="mt-6 flex justify-end space-x-3">
                <button
                    type="button"
                    onclick="closeCategoryModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
                >
                    Cancelar
                </button>
                <button
                    type="submit"
                    class="px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
                >
                    Salvar
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openCategoryModal() {
        const modal = document.getElementById('categoryModal');
        const form = document.getElementById('categoryForm');
        const title = document.getElementById('modalTitle');
        const method = document.getElementById('formMethod');

        form.reset();
        form.action = "{{ route('categories.store') }}";
        method.value = "POST";
        title.textContent = "Nova Categoria";

        modal.classList.remove('hidden');
    }

    function closeCategoryModal() {
        const modal = document.getElementById('categoryModal');
        modal.classList.add('hidden');
    }

    function editCategory(id, name, type) {
        const modal = document.getElementById('categoryModal');
        const form = document.getElementById('categoryForm');
        const title = document.getElementById('modalTitle');
        const method = document.getElementById('formMethod');
        const nameInput = document.getElementById('name');
        const typeInput = document.getElementById('type');

        form.action = `/categories/${id}`;
        method.value = "PUT";
        title.textContent = "Editar Categoria";
        nameInput.value = name;
        typeInput.value = type;

        modal.classList.remove('hidden');
    }
</script>
@endpush
@endsection
