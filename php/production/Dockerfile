FROM php:fpm-alpine
RUN docker-php-ext-install opcache pdo pdo_mysql mysqli mbstring intl zip
COPY php/production/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY ./data/ /var/www/html/