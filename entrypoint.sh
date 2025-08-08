#!/bin/sh
set -e

chown -R www-data:www-data /var/www/html/challenge-softsul || true

mkdir -p /var/www/html/challenge-softsul/storage/logs
chown -R www-data:www-data /var/www/html/challenge-softsul/storage /var/www/html/challenge-softsul/bootstrap/cache
find /var/www/html/challenge-softsul/storage -type d -exec chmod 755 {} \;
find /var/www/html/challenge-softsul/storage -type f -exec chmod 644 {} \;

touch /var/www/html/challenge-softsul/storage/logs/laravel.log
chown www-data:www-data /var/www/html/challenge-softsul/storage/logs/laravel.log
chmod 664 /var/www/html/challenge-softsul/storage/logs/laravel.log

exec "$@"
