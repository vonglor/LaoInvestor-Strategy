# 1. Base Image: ໃຊ້ PHP Image ທີ່ຖືກຕ້ອງ
FROM php:8.4-fpm-alpine

# 2. ຕິດຕັ້ງ PHP Extensions ແລະເຄື່ອງມືທີ່ຈຳເປັນສຳລັບ Laravel
# (pdo_mysql/zip ແມ່ນສຳຄັນ)
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

# 4. ຕິດຕັ້ງ Composer (ສຳຄັນທີ່ສຸດ: ສ້າງ vendor/)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . .
RUN composer install --no-dev --optimize-autoloader

# 5. ຕັ້ງຄ່າ Permission (ສຳຄັນສຳລັບ Cache/Logs)
# ຕ້ອງໃຫ້ user ຂອງ server (www-data) ສາມາດຂຽນໄຟລ໌ໄດ້
RUN chown -R www-data:www-data storage bootstrap/cache

# 6. ເປີດ Port
EXPOSE 8080

# 7. Start Command ທີ່ຖືກແກ້ໄຂແລ້ວ
# ໃຊ້ PHP Artisan Serve ມາດຕະຖານ
CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8080"]