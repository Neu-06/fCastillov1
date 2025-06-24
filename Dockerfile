FROM php:8.2-fpm

# Instalar dependencias del sistema incluyendo Node.js 20
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \ 
    zip \
    unzip \
    git \
    curl \
    libpq-dev \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@10.8.2 \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copiar solo composer para cache eficiente
COPY composer.json composer.lock ./

RUN composer install --no-interaction --optimize-autoloader --no-scripts

# Copiar todo el código, INCLUYENDO public/build
COPY . .

# Asegurarte de que los permisos sean correctos
RUN chown -R www-data:www-data /app \
    && chmod -R 755 /app/storage /app/bootstrap/cache /app/public

# ✅ Descargar wait-for-it.sh directamente desde GitHub y dar permisos
RUN curl -o /usr/local/bin/wait-for-it.sh https://raw.githubusercontent.com/vishnubob/wait-for-it/master/wait-for-it.sh \
    && chmod +x /usr/local/bin/wait-for-it.sh

EXPOSE 9000

# CMD robusto usando wait-for-it
#CMD sh -c "wait-for-it.sh postgres:5432 -- php artisan migrate --force && php artisan db:seed && php-fpm"

CMD sh -c "chown -R www-data:www-data /app/storage /app/bootstrap/cache && chmod -R 775 /app/storage /app/bootstrap/cache && wait-for-it.sh postgres:5432 -- php artisan migrate --force && php artisan db:seed && php-fpm"
