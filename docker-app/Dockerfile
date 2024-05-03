# Pull the PHP-FPM image from Docker Hub
FROM php:8.1-fpm-alpine

# Install system dependencies
RUN apk update && apk add --no-cache \
    autoconf \
    g++ \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    unzip \
    git \
    curl \
    icu-dev \
    oniguruma-dev \
    libxslt-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install zip
RUN docker-php-ext-install exif
RUN docker-php-ext-install pcntl
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install intl
RUN docker-php-ext-install soap
RUN docker-php-ext-install dom

# Install GD extension
RUN apk add --no-cache freetype libpng libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd
RUN apk del freetype-dev libpng-dev libjpeg-turbo-dev

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Set a build argument to pass a unique value for cache invalidation
# ARG CACHEBUST=1

# Clone your repository and checkout the specific branch
RUN git clone -b db-mysql https://github.com/zawad1992/fake_twitter_backend.git /tmp/repo && \
    cp -r /tmp/repo/. . && \
    rm -rf /tmp/repo

# Change into the directory containing composer.json
WORKDIR /var/www/html/engine

RUN git config --global --add safe.directory /var/www/html

# Update the repository to fetch the latest changes
RUN git pull origin db-mysql

# Copy .env.example to .env
RUN cp .env.example .env

# Install dependencies
RUN composer install

# RUN chown -R www-data:www-data /var/www/engine
# RUN chmod -R 755 /var/www/engine

RUN php artisan key:generate
RUN php artisan jwt:secret
RUN composer dump-autoload --optimize

RUN chmod -R 777 storage/
RUN chown -R www-data:www-data storage/

# RUN php artisan migrate:status

WORKDIR /var/www/html

# Expose port 9000 and start php-fpm server
EXPOSE 9000

CMD ["php-fpm"]

# CMD ["php artisan serve --port=9000"]