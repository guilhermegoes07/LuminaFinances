<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lumina Finances</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-background text-text">
    <!-- Minimal Navbar -->
    <nav class="border-b bg-card">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-center">
                <a href="{{ route('welcome') }}" class="flex items-center space-x-2 hover:opacity-80 transition-opacity">
                    <i data-lucide="bar-chart-3" class="h-6 w-6 text-primary"></i>
                    <i data-lucide="dollar-sign" class="h-5 w-5 text-secondary"></i>
                    <span class="text-xl font-bold">Lumina Finances</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-[calc(100vh-8rem)]">
        @yield('content')
    </main>

    <!-- Minimal Footer -->
    <footer class="border-t bg-card py-4">
        <div class="container mx-auto px-4 text-center text-muted-foreground">
            <p>&copy; {{ date('Y') }} Lumina Finances. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
