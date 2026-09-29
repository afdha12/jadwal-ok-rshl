# ==========================================
# 🎨 Stage 1: Build Frontend (Vite) Assets
# ==========================================
FROM node:20-alpine AS frontend

WORKDIR /app

# Copy dependency files first for layer caching
COPY package.json package-lock.json ./

# Install npm dependencies
RUN npm ci

# Copy files required for Vite & Tailwind compilation
COPY vite.config.js tailwind.config.js postcss.config.js ./
COPY resources ./resources

# Build assets (outputs to public/build)
RUN npm run build

# ==========================================
# 🚀 Stage 2: PHP Application (Octane + FrankenPHP)
# ==========================================
FROM php:8.3-cli

WORKDIR /app

# ========================
# 🧱 System Dependencies
# ========================
RUN apt update && apt install -y \
    curl zip unzip git wget gnupg ca-certificates bash \
    libzip-dev libjpeg-dev libpng-dev libfreetype6-dev \
    libonig-dev libxml2-dev \
    && rm -rf /var/lib/apt/lists/*

# ========================
# 🧩 PHP Extensions
# ========================
RUN docker-php-ext-install \
    pdo pdo_mysql mbstring zip exif bcmath gd pcntl \
    && docker-php-ext-enable zip exif

# Increase PHP memory limit
RUN echo 'memory_limit = 2G' > /usr/local/etc/php/conf.d/memory.ini

# ========================
# 📦 Composer
# ========================
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy composer dependency declaration files first
COPY composer.json composer.lock ./

# Composer install without scripts (to avoid artisan errors before code is copied)
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts

# ========================
# 📦 Laravel App Setup
# ========================
COPY . .

# Copy compiled frontend assets from frontend stage
COPY --from=frontend /app/public/build ./public/build

# Ensure dev server hot file is never present in production image
RUN rm -f public/hot

# Ensure .env exists for key generation during build
RUN if [ ! -f .env ]; then cp .env.example .env; fi \
    && php artisan key:generate --force

# ========================
# 🚀 Laravel Octane + FrankenPHP
# ========================
RUN php artisan octane:install --server=frankenphp --no-interaction

# Run artisan storage link
RUN php artisan storage:link || true

# Set file permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# ========================
# ✅ Runtime Setup
# ========================
EXPOSE 8003

USER www-data

CMD ["php", "artisan", "octane:start", "--server=frankenphp", "--host=0.0.0.0", "--port=8003"]
