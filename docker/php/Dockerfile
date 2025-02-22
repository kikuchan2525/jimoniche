FROM php:8.4-fpm

# COPY php.ini
COPY ./php/php.ini /usr/local/etc/php/php.ini

# Composer install
COPY --from=composer:2.2.0 /usr/bin/composer /usr/bin/composer

RUN apt-get update \
    && apt-get -y install \
        git \
        zip \
        unzip \
        vim \
        libpq-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libzip-dev \
        zlib1g-dev \ 
        libpng-dev \
    && docker-php-ext-configure \
        gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo_mysql \
        pdo_pgsql  \
        bcmath \
        -j$(nproc) gd \
        zip

WORKDIR /var/www/html