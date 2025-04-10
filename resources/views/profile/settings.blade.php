@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-card rounded-xl shadow-lg p-6">
        <h2 class="text-2xl font-bold mb-6">Configurações</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update-settings') }}" class="space-y-6">
            @csrf
            @method('PATCH')

            <div>
                <label for="currency" class="block text-sm font-medium text-foreground mb-2">Moeda Padrão</label>
                <select name="currency" id="currency"
                    class="w-full px-4 py-2 rounded-lg border border-border focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option value="BRL">Real Brasileiro (R$)</option>
                    <option value="USD">Dólar Americano ($)</option>
                    <option value="EUR">Euro (€)</option>
                </select>
            </div>

            <div>
                <label for="language" class="block text-sm font-medium text-foreground mb-2">Idioma</label>
                <select name="language" id="language"
                    class="w-full px-4 py-2 rounded-lg border border-border focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option value="pt-BR">Português (Brasil)</option>
                    <option value="en">English</option>
                    <option value="es">Español</option>
                </select>
            </div>

            <div>
                <label for="theme" class="block text-sm font-medium text-foreground mb-2">Tema</label>
                <select name="theme" id="theme"
                    class="w-full px-4 py-2 rounded-lg border border-border focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option value="light">Claro</option>
                    <option value="dark">Escuro</option>
                    <option value="system">Sistema</option>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                    Salvar Configurações
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
