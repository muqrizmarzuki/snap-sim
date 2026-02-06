FROM php:8.3-fpm

# Install System Dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    supervisor \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    libpq-dev \
    curl \
    gnupg

# Install PHP Extensions
RUN docker-php-ext-install -j$(nproc) pdo_mysql bcmath zip pcntl posix sockets
RUN pecl install redis && docker-php-ext-enable redis

# Configure Nginx and Supervisor
RUN mkdir -p /var/log/supervisor /run/nginx
COPY docker/conf.d/nginx.conf /etc/nginx/sites-available/default
RUN ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

COPY docker/conf.d/supervisord.conf /etc/supervisor/conf.d/supervisord.conf


# Set Working Directory
WORKDIR /var/www
COPY . /var/www

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Fix Permissions (Ubuntu uses www-data:www-data as well)
RUN chown -R www-data:www-data /var/www && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
