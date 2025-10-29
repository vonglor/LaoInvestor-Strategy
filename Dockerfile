# # 1. Base Image: ໃຊ້ PHP 8.4
# FROM php:8.4-fpm-alpine

# # 2. ຕິດຕັ້ງ PHP Extensions ແລະເຄື່ອງມືທີ່ຈຳເປັນສຳລັບ Laravel
# RUN apk update && apk add \
#     git \
#     curl \
#     unzip \
#     libzip-dev \
#     libpng-dev \
#     libxml2-dev \
#     # ຕິດຕັ້ງ PHP Extensions
#     && docker-php-ext-install pdo_mysql zip opcache

# # 3. ຕັ້ງຄ່າ Working Directory (ໂຟລເດີຫຼັກຂອງ Laravel)
# WORKDIR /var/www/html

# # 4. ຕິດຕັ້ງ Composer (ສ້າງ vendor/autoload.php)
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# COPY composer.json composer.lock ./
# COPY . .
# RUN composer install --no-dev --optimize-autoloader

# # 5. ຕັ້ງຄ່າ Permission (ສຳຄັນສຳລັບ Cache/Logs)
# RUN chown -R www-data:www-data storage bootstrap/cache


# # Fix Composer memory limit
# ENV COMPOSER_MEMORY_LIMIT=-1

# RUN chmod -R 775 storage bootstrap/cache

# ENV PORT=10000
# EXPOSE 10000

# CMD php artisan serve --host=0.0.0.0 --port=$PORT

FROM richarvey/nginx-php-fpm:latest

COPY . .

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]