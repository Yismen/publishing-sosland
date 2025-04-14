# Dockerfile
FROM php:8.4-fpm

# Install system dependencies and Supervisor for process control
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    cron \
    supervisor

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd ext-intl ext-zip ext-zip

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Set working directory
WORKDIR /var/www

# Copy composer files
COPY composer.json composer.lock ./

# Install Composer from the official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Laravel dependencies optimized for production
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Copy the rest of the application code
COPY . .

# Optimize the application (this runs PHP artisan optimize)
RUN php artisan optimize

# Copy Supervisor configuration (see section 3)
COPY ./docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copy the entrypoint script (see section 4) and make it executable
COPY ./docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 9000

# Start entrypoint (which will run php-fpm and supervisor)
CMD ["/entrypoint.sh"]
