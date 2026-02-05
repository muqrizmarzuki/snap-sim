FROM php:8.3-fpm

WORKDIR /var/www/app

# Install system dependencies required for Laravel
RUN apt-get update && apt-get install -y \
    curl \
    zip \
    unzip \
    git \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring xml \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copy Composer from official Composer image
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# PHP configuration tweaks
RUN echo "upload_max_filesize=100M" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size=100M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "max_execution_time=300" >> /usr/local/etc/php/conf.d/uploads.ini

# Set folder permission (for development use only — adjust for production)
RUN chmod -R 777 /var/www/app

RUN mkdir -p /var/www/app/storage /var/www/app/bootstrap/cache \
    && chown -R www-data:www-data /var/www/app/storage /var/www/app/bootstrap/cache \
    && chmod -R 777 /var/www/app/storage /var/www/app/bootstrap/cache
