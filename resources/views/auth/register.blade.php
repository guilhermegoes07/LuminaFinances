@extends('layouts.auth')

@section('content')
<div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <div class="flex items-center justify-center space-x-2 mb-6">
                <i data-lucide="bar-chart-3" class="h-8 w-8 text-primary"></i>
                <i data-lucide="dollar-sign" class="h-7 w-7 text-secondary"></i>
            </div>
            <h2 class="text-3xl font-bold text-text">
                Crie sua conta
            </h2>
            <p class="mt-2 text-sm text-text-light">
                Já tem uma conta?
                <a href="{{ route('login') }}" class="font-medium text-primary hover:text-primary/90">
                    Faça login
                </a>
            </p>
        </div>

        <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="rounded-xl shadow-sm space-y-6 bg-card p-8">
                <div>
                    <label for="name" class="block text-sm font-medium text-text mb-2">
                        Nome completo
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="user" class="h-5 w-5 text-text-light"></i>
                        </div>
                        <input id="name" name="name" type="text" required
                            class="input pl-10 @error('name') border-destructive @enderror"
                            placeholder="Seu nome completo"
                            value="{{ old('name') }}"
                            autocomplete="name"
                            autofocus>
                    </div>
                    @error('name')
                        <p class="mt-2 text-sm text-destructive">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-text mb-2">
                        Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="mail" class="h-5 w-5 text-text-light"></i>
                        </div>
                        <input id="email" name="email" type="email" required
                            class="input pl-10 @error('email') border-destructive @enderror"
                            placeholder="seu@email.com"
                            value="{{ old('email') }}"
                            autocomplete="email">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-destructive">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-text mb-2">
                        Senha
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="h-5 w-5 text-text-light"></i>
                        </div>
                        <input id="password" name="password" type="password" required
                            class="input pl-10 @error('password') border-destructive @enderror"
                            placeholder="••••••••"
                            autocomplete="new-password">
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-destructive">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="password-confirm" class="block text-sm font-medium text-text mb-2">
                        Confirmar senha
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="h-5 w-5 text-text-light"></i>
                        </div>
                        <input id="password-confirm" name="password_confirmation" type="password" required
                            class="input pl-10"
                            placeholder="••••••••"
                            autocomplete="new-password">
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="terms" name="terms" type="checkbox" required
                        class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                    <label for="terms" class="ml-2 block text-sm text-text-light">
                        Eu concordo com os
                        <a href="#" class="font-medium text-primary hover:text-primary/90">
                            Termos de Serviço
                        </a>
                        e
                        <a href="#" class="font-medium text-primary hover:text-primary/90">
                            Política de Privacidade
                        </a>
                    </label>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-300">
                        Criar conta
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
