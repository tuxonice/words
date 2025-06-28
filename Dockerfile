FROM php:8.2-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy composer files
COPY composer.json composer.lock* ./

# Install dependencies including dev dependencies (PHPUnit)
RUN composer install

# Copy the rest of the application
COPY . .

# Make sure vendor/bin is in PATH
ENV PATH="/app/vendor/bin:${PATH}"

# Generate autoloader
RUN composer dump-autoload --optimize
