# ໃຊ້ PHP Image ຈາກ Docker Hub
FROM php:8.2-fpm-alpine

# ຕິດຕັ້ງເຄື່ອງມື ແລະ Extensions ທີ່ຈຳເປັນສຳລັບ Laravel
RUN apk update && apk add \
    nginx \
    supervisor \
    mysql-client \
    git \
    curl \
    unzip \
    libzip-dev \
    libpng-dev \
    libxml2-dev \
    # ຕິດຕັ້ງ PHP Extensions
    && docker-php-ext-install pdo_mysql zip pcntl opcache \
    # ຕັ້ງຄ່າ Supervisor ສຳລັບການ Process Management
    && mkdir -p /etc/supervisord.d /run/nginx

# ຕິດຕັ້ງ Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ຕັ້ງຄ່າ Environment
WORKDIR /var/www/html

# ຕັ້ງຄ່າ nginx (ທ່ານຈະຕ້ອງສ້າງໄຟລ໌ nginx.conf ດ້ວຍຕົນເອງ)
COPY . /var/www/html

# ຕັ້ງຄ່າ Permission ໃຫ້ກັບ Storage (ສຳຄັນສຳລັບ Laravel)
RUN chown -R www-data:www-data /var/www/html/storage

# ເປີດ Port ທີ່ຈຳເປັນ
EXPOSE 8080

# ຕັ້ງຄ່າ Start Command (Nginx ຈະເປີດໃນພື້ນຫຼັງ)
# ທ່ານສາມາດໃຊ້ Supervisor ເພື່ອ run Nginx ແລະ PHP-FPM ພ້ອມກັນ
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]