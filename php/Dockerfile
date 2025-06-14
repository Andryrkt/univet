FROM php:8.2-fpm

# Install system dependencies + PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip zip curl bash vim \
    libpq-dev libicu-dev libxml2-dev libzip-dev libonig-dev \
    && docker-php-ext-install pdo pdo_pgsql intl xml zip opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install Symfony CLI (optional)
RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# Ajouter fichier php.ini avec opcache activé
COPY ./php/php.ini /usr/local/etc/php/php.ini
