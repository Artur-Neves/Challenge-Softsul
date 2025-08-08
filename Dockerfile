FROM php:8.2-apache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get upgrade -y \
    && apt-get install -y nano git wget unzip libpq-dev libzip-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev nodejs npm

RUN docker-php-ext-install bcmath pdo_pgsql pdo_mysql mysqli pgsql exif zip \
    && docker-php-ext-enable exif \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && a2enmod rewrite

RUN rm /etc/localtime \
    && ln -s /usr/share/zoneinfo/America/Bahia /etc/localtime \
    && echo "America/Bahia" > /etc/timezone \
    && sed "s/;date.timezone =/date.timezone = America\/Bahia/g" /usr/local/etc/php/php.ini-development > /usr/local/etc/php/php.ini

WORKDIR /etc/apache2/sites-available
COPY apache.conf .
RUN a2ensite apache.conf

WORKDIR /var/www/html/challenge-softsul
COPY . /var/www/html/challenge-softsul

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

RUN chown -R www-data:www-data /var/www/html/challenge-softsul

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["apache2-foreground"]
