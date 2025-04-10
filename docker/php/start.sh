#!/bin/bash

# Copiar .env.example para .env se .env não existir
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Instalar dependências do Composer
composer install --optimize-autoloader --no-dev

# Gerar chave da aplicação
php artisan key:generate

# Limpar cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Executar migrações
php artisan migrate

# Iniciar o PHP-FPM
php-fpm
