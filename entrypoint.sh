#!/bin/sh
set -e

PROJECT_PATH="/var/www/html/challenge-softsul"

chown -R www-data:www-data "$PROJECT_PATH"
chmod -R 777 "$PROJECT_PATH/storage" "$PROJECT_PATH/bootstrap/cache"

mkdir -p "$PROJECT_PATH/storage/logs"
touch "$PROJECT_PATH/storage/logs/laravel.log"
chmod 666 "$PROJECT_PATH/storage/logs/laravel.log"

if [ ! -d "$PROJECT_PATH/vendor" ]; then
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

php artisan migrate --force --no-interaction

exec apache2-foreground
