# Use official PHP 8.4 FPM Alpine image
FROM php:8.4-fpm-alpine

WORKDIR /var/www/html

# Install system dependencies for PHP extensions
RUN apk update && apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    linux-headers \
    icu-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip

# Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        zip \
        pdo_mysql \
        gd \
        intl \
        exif \
        pcntl

# Install additional tools
RUN apk add --no-cache \
    bash \
    openssh-client \
    git \
    nodejs \
    npm

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set environment variables
ENV COMPOSER_PROCESS_TIMEOUT=2000

# Copy composer files first for better caching
COPY --chown=www-data:www-data composer.json composer.lock ./

# Install PHP dependencies
RUN composer clear-cache && \
    composer install --no-scripts --no-autoloader --no-interaction

# Copy application files
COPY --chown=www-data:www-data . .

# Copy .env if exists (optional - better to create it during deployment)
COPY --chown=www-data:www-data .env.example .env

# Optimize application
RUN composer dumpautoload -o && \
    php artisan optimize:clear

# Set proper permissions
RUN chmod -R 775 storage bootstrap/cache

USER www-data

# Expose port 9000
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]