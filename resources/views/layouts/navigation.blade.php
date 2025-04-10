<!-- Navbar -->
<nav class="border-b bg-card">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <i data-lucide="bar-chart-3" class="h-6 w-6 text-primary"></i>
                <span class="text-xl font-bold">Lumina Finances</span>
            </div>
            <div class="flex items-center space-x-6">
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="{{ route('dashboard') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Dashboard
                    </a>
                    <a href="{{ route('goals.index') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Metas
                    </a>
                </div>

                <!-- Menu de Perfil -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                            @click.away="open = false"
                            class="flex items-center space-x-2 text-foreground hover:text-primary transition-colors">
                        <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center">
                            <i data-lucide="user" class="h-5 w-5 text-primary"></i>
                        </div>
                        <span>{{ Auth::user()->name }}</span>
                        <i data-lucide="chevron-down" class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 bg-card rounded-md shadow-lg py-1 z-50"
                         @click.away="open = false">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-foreground hover:bg-primary/5 hover:text-primary">
                            <div class="flex items-center space-x-2">
                                <i data-lucide="user" class="h-4 w-4"></i>
                                <span>Meu Perfil</span>
                            </div>
                        </a>
                        <a href="{{ route('profile.settings') }}" class="block px-4 py-2 text-sm text-foreground hover:bg-primary/5 hover:text-primary">
                            <div class="flex items-center space-x-2">
                                <i data-lucide="settings" class="h-4 w-4"></i>
                                <span>Configurações</span>
                            </div>
                        </a>
                        <div class="border-t border-border my-1"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-foreground hover:bg-primary/5 hover:text-primary">
                                <div class="flex items-center space-x-2">
                                    <i data-lucide="log-out" class="h-4 w-4"></i>
                                    <span>Sair</span>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
