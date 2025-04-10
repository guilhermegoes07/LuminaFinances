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
                Bem-vindo de volta
            </h2>
            <p class="mt-2 text-sm text-text-light">
                Não tem uma conta?
                <a href="{{ route('register') }}" class="font-medium text-primary hover:text-primary/90">
                    Crie uma agora
                </a>
            </p>
        </div>

        <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="rounded-xl shadow-sm space-y-6 bg-card p-8">
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
                            autocomplete="email"
                            autofocus>
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
                            autocomplete="current-password">
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-destructive">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                            class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="ml-2 block text-sm text-text-light">
                            Lembrar de mim
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm font-medium text-primary hover:text-primary/90">
                            Esqueceu sua senha?
                        </a>
                    @endif
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-300">
                        Entrar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
