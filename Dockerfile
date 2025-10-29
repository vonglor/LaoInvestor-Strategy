FROM richarvey/nginx-php-fpm:latest

# Copy source
COPY . .

# Composer install
ENV SKIP_COMPOSER 0

# Laravel paths
ENV WEBROOT /var/www/html/public
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr
ENV COMPOSER_ALLOW_SUPERUSER=1

# Permissions fix
RUN chown -R nginx:nginx /var/www/html/storage /var/www/html/bootstrap/cache

# Generate APP Key and cache config
RUN php artisan key:generate --force || true
RUN php artisan config:cache || true
RUN php artisan route:cache || true
RUN php artisan view:cache || true

CMD ["/start.sh"]
