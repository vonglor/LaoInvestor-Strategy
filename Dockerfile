FROM php:8.1-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git curl libpq-dev zip unzip \
    && docker-php-ext-install pdo pdo_pgsql

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --optimize-autoloader --no-dev

RUN chmod -R 775 storage bootstrap/cache

# Generate optimized Laravel cache
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear

# Render uses PORT env
ENV PORT=8080
EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=$PORT
