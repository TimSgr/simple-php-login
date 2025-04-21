FROM php:fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    icu-dev \
    zlib-dev \
    libzip-dev \
    oniguruma-dev \
    && docker-php-ext-install \
    opcache \
    pdo \
    pdo_mysql \
    mysqli \
    intl \
    zip

COPY php/production/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
RUN sed -i 's/^;clear_env = no/clear_env = no/' /usr/local/etc/php-fpm.d/www.conf
