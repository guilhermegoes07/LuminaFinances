<nav class="bg-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800">
                        Financial Manager
                    </a>
                </div>
            </div>
            <div class="flex items-center">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                        Dashboard
                    </a>
                    <a href="{{ route('profile') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                        Perfil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                            Sair
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                        Entrar
                    </a>
                    <a href="{{ route('register') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                        Registrar
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
