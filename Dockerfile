# 1. Base Image: ໃຊ້ PHP 8.4
FROM php:8.4-fpm-alpine

# 2. ຕິດຕັ້ງ PHP Extensions ແລະເຄື່ອງມືທີ່ຈຳເປັນສຳລັບ Laravel
RUN apk update && apk add \
    git \
    curl \
    unzip \
    libzip-dev \
    libpng-dev \
    libxml2-dev \
    # ຕິດຕັ້ງ PHP Extensions
    && docker-php-ext-install pdo_mysql zip opcache

# 3. ຕັ້ງຄ່າ Working Directory (ໂຟລເດີຫຼັກຂອງ Laravel)
WORKDIR /var/www/html

# 4. ຕິດຕັ້ງ Composer (ສ້າງ vendor/autoload.php)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY composer.json composer.lock ./
COPY . .
RUN composer install --no-dev --optimize-autoloader

# 5. ຕັ້ງຄ່າ Permission (ສຳຄັນສຳລັບ Cache/Logs)
RUN chown -R www-data:www-data storage bootstrap/cache


# Fix Composer memory limit
ENV COMPOSER_MEMORY_LIMIT=-1

RUN chmod -R 775 storage bootstrap/cache

ENV PORT=8080
EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=$PORT
