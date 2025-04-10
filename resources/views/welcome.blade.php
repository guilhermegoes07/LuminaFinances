<!DOCTYPE html>
<html lang="pt-BR">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lumina Finances - Transforme sua vida financeira</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
            @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="min-h-screen bg-background font-['Poppins'] overflow-x-hidden">
    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-background/80 backdrop-blur-lg border-b">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-2">
                    <div class="flex items-center space-x-2">
                        <i data-lucide="bar-chart-3" class="h-6 w-6 text-primary"></i>
                        <i data-lucide="dollar-sign" class="h-5 w-5 text-secondary"></i>
                    </div>
                    <span class="text-xl font-bold">Lumina Finances</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-text-light hover:text-primary transition-colors">Entrar</a>
                    <a href="{{ route('register') }}" class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-xl transition-all duration-300 shadow-lg hover:shadow-primary/20">
                        Criar Conta
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-40 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-primary/5 to-transparent"></div>
        <div class="container mx-auto px-4 relative">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-5xl md:text-6xl font-bold text-text mb-6 leading-tight">
                    Controle Financeiro
                    <span class="bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                        Simplificado
                    </span>
                </h1>
                <p class="text-lg md:text-xl text-text-light mb-12 leading-relaxed">
                    Gerencie suas finanças de forma inteligente, estabeleça metas e alcance sua independência financeira com o Lumina Finances.
                </p>
                <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-6">
                    <a href="{{ route('register') }}" class="w-full sm:w-auto bg-primary hover:bg-primary/90 text-white px-8 py-4 rounded-xl text-lg font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-primary/20">
                        Comece Agora - É Grátis!
                    </a>
                    <a href="#features" class="w-full sm:w-auto flex items-center justify-center space-x-2 text-text-light hover:text-primary transition-colors">
                        <span>Ver recursos</span>
                        <i data-lucide="arrow-down" class="w-4 h-4"></i>
                    </a>
                </div>
                <div class="mt-16 grid grid-cols-1 sm:grid-cols-3 gap-8 max-w-3xl mx-auto">
                    <div class="flex items-center justify-center space-x-2 text-text-light">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-secondary"></i>
                        <span>Sem taxas escondidas</span>
                    </div>
                    <div class="flex items-center justify-center space-x-2 text-text-light">
                        <i data-lucide="shield" class="w-5 h-5 text-secondary"></i>
                        <span>100% seguro</span>
                    </div>
                    <div class="flex items-center justify-center space-x-2 text-text-light">
                        <i data-lucide="headphones" class="w-5 h-5 text-secondary"></i>
                        <span>Suporte 24/7</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-32 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-20">
                <h2 class="text-4xl font-bold text-text mb-6">
                    Funcionalidades Poderosas
                </h2>
                <p class="text-lg text-text-light max-w-2xl mx-auto">
                    Tudo que você precisa para ter controle total das suas finanças
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                $features = [
                    [
                        'icon' => 'bar-chart-3',
                        'title' => 'Dashboard Intuitivo',
                        'description' => 'Visualize suas finanças de forma clara e objetiva com gráficos e indicadores personalizados.'
                    ],
                    [
                        'icon' => 'wallet',
                        'title' => 'Gestão de Contas',
                        'description' => 'Organize todas as suas contas em um só lugar, com categorização inteligente.'
                    ],
                    [
                        'icon' => 'target',
                        'title' => 'Metas Financeiras',
                        'description' => 'Estabeleça objetivos e acompanhe seu progresso rumo à independência financeira.'
                    ],
                    [
                        'icon' => 'trending-up',
                        'title' => 'Análise de Investimentos',
                        'description' => 'Acompanhe o desempenho dos seus investimentos e receba sugestões personalizadas.'
                    ],
                    [
                        'icon' => 'bell',
                        'title' => 'Alertas Personalizados',
                        'description' => 'Receba notificações sobre gastos, vencimentos e oportunidades de economia.'
                    ],
                    [
                        'icon' => 'shield',
                        'title' => 'Segurança Avançada',
                        'description' => 'Seus dados financeiros protegidos com a mais alta tecnologia de criptografia.'
                    ]
                ];
                @endphp

                @foreach ($features as $feature)
                    <div class="group p-6 bg-card hover:bg-card/80 rounded-2xl transition-all duration-300">
                        <div class="mb-6 p-4 bg-primary/10 rounded-xl w-fit group-hover:bg-primary/20 transition-colors">
                            <i data-lucide="{{ $feature['icon'] }}" class="w-6 h-6 text-primary"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-text mb-3">
                            {{ $feature['title'] }}
                        </h3>
                        <p class="text-text-light leading-relaxed">
                            {{ $feature['description'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-32 bg-gradient-to-b from-background to-card/50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1">
                    <h2 class="text-4xl font-bold text-text mb-8">
                        Por que escolher o<br>
                        <span class="text-primary">Lumina Finances?</span>
                    </h2>
                    <div class="space-y-8">
                        <div class="flex items-start space-x-4">
                            <div class="p-3 bg-primary/10 rounded-lg">
                                <i data-lucide="smartphone" class="w-6 h-6 text-primary"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-text mb-2">
                                    Acesso em Qualquer Lugar
                                </h3>
                                <p class="text-text-light">
                                    Gerencie suas finanças de qualquer dispositivo, a qualquer momento.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="p-3 bg-primary/10 rounded-lg">
                                <i data-lucide="users" class="w-6 h-6 text-primary"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-text mb-2">
                                    Perfeito para Famílias
                                </h3>
                                <p class="text-text-light">
                                    Compartilhe o controle financeiro com sua família de forma segura.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="p-3 bg-primary/10 rounded-lg">
                                <i data-lucide="shield" class="w-6 h-6 text-primary"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-text mb-2">
                                    Segurança Total
                                </h3>
                                <p class="text-text-light">
                                    Seus dados protegidos com criptografia de ponta a ponta.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="relative">
                        <div class="absolute -inset-4 bg-gradient-to-r from-primary/30 to-secondary/30 rounded-3xl blur-2xl opacity-30"></div>
                        <div class="relative bg-card rounded-2xl p-8 shadow-xl">
                            <div class="aspect-[4/3] bg-primary/10 rounded-xl flex items-center justify-center mb-6">
                                <div class="flex items-center space-x-2">
                                    <i data-lucide="bar-chart-3" class="w-24 h-24 text-primary"></i>
                                    <i data-lucide="dollar-sign" class="w-20 h-20 text-secondary"></i>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="h-4 bg-primary/10 rounded-full w-3/4"></div>
                                <div class="h-4 bg-secondary/10 rounded-full w-1/2"></div>
                                <div class="h-4 bg-primary/10 rounded-full w-5/6"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="py-32 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-20">
                <h2 class="text-4xl font-bold text-text mb-6">
                    Planos para Todos os Perfis
                </h2>
                <p class="text-lg text-text-light max-w-2xl mx-auto">
                    Escolha o plano ideal para suas necessidades financeiras
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                $plans = [
                    [
                        'name' => 'Básico',
                        'price' => 'Grátis',
                        'features' => [
                            'Dashboard básico',
                            'Controle de despesas',
                            'Metas financeiras',
                            'Suporte por email'
                        ]
                    ],
                    [
                        'name' => 'Premium',
                        'price' => 'R$ 19,90/mês',
                        'features' => [
                            'Todas as funcionalidades básicas',
                            'Análise de investimentos',
                            'Alertas personalizados',
                            'Relatórios avançados',
                            'Suporte prioritário'
                        ],
                        'highlighted' => true
                    ],
                    [
                        'name' => 'Empresarial',
                        'price' => 'R$ 49,90/mês',
                        'features' => [
                            'Todas as funcionalidades premium',
                            'Múltiplos usuários',
                            'API de integração',
                            'Gestor de conta dedicado',
                            'Personalização avançada'
                        ]
                    ]
                ];
                @endphp

                @foreach ($plans as $plan)
                    <div class="p-8 rounded-xl {{ $plan['highlighted'] ?? false ? 'bg-primary text-white transform scale-105 shadow-2xl shadow-primary/20 border-2 border-primary/20' : 'bg-card shadow-xl shadow-gray-200/50 hover:shadow-2xl hover:shadow-gray-200/70 transition-all duration-300 border border-gray-100 hover:border-gray-200' }}">
                        <h3 class="text-2xl font-bold mb-4 {{ $plan['highlighted'] ?? false ? 'text-white' : 'text-text' }}">
                            {{ $plan['name'] }}
                        </h3>
                        <p class="text-3xl font-bold mb-8 {{ $plan['highlighted'] ?? false ? 'text-white' : 'text-primary' }}">
                            {{ $plan['price'] }}
                        </p>
                        <ul class="space-y-4 mb-8">
                            @foreach ($plan['features'] as $feature)
                                <li class="flex items-center space-x-2">
                                    <i data-lucide="check" class="w-5 h-5 {{ $plan['highlighted'] ?? false ? 'text-white' : 'text-primary' }}"></i>
                                    <span class="{{ $plan['highlighted'] ?? false ? 'text-white' : 'text-text-light' }}">{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('register') }}" class="block w-full text-center py-3 px-4 rounded-xl {{ $plan['highlighted'] ?? false ? 'bg-white text-primary hover:bg-white/90 shadow-lg shadow-white/20' : 'bg-primary text-white hover:bg-primary/90 shadow-lg shadow-primary/20' }} transition-all duration-300">
                            Começar Agora
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-32">
        <div class="container mx-auto px-4">
            <div class="bg-primary rounded-3xl p-12 md:p-16 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-primary-dark/50 to-transparent"></div>
                <div class="relative z-10 max-w-3xl">
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                        Pronto para transformar suas finanças?
                    </h2>
                    <p class="text-white/90 text-lg mb-8">
                        Junte-se a milhares de pessoas que já estão no controle de suas finanças com o Lumina Finances.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}" class="inline-flex justify-center items-center bg-white text-primary hover:bg-white/90 px-8 py-4 rounded-xl text-lg font-semibold transition-colors">
                            Criar Conta Grátis
                        </a>
                        <a href="#features" class="inline-flex justify-center items-center text-white hover:text-white/90 px-8 py-4 rounded-xl text-lg font-semibold transition-colors border-2 border-white/20 hover:border-white/30">
                            Saiba Mais
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 border-t">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-2 mb-4 md:mb-0">
                    <div class="flex items-center space-x-2">
                        <i data-lucide="bar-chart-3" class="h-6 w-6 text-primary"></i>
                        <i data-lucide="dollar-sign" class="h-5 w-5 text-secondary"></i>
                    </div>
                    <span class="text-xl font-bold">Lumina Finances</span>
                </div>
                <div class="flex items-center space-x-6 text-text-light">
                    <a href="#" class="hover:text-primary transition-colors">Sobre</a>
                    <a href="#" class="hover:text-primary transition-colors">Termos</a>
                    <a href="#" class="hover:text-primary transition-colors">Privacidade</a>
                    <a href="#" class="hover:text-primary transition-colors">Contato</a>
                </div>
            </div>
            <div class="mt-8 text-center text-text-light">
                <p>&copy; {{ date('Y') }} Lumina Finances. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <script>
        // Inicializa os ícones do Lucide
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });
    </script>
    </body>
</html>
