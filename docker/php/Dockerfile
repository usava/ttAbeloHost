FROM php:8.5-fpm-alpine
LABEL authors="usava"

RUN apk update && \
    apk upgrade && \
    apk add --no-cache \
        bash shadow git \
        mysql-client perl wget linux-headers

# change uid and gid for www-data user
RUN usermod -u 1000 www-data && \
    groupmod -g 1000 www-data

RUN apk add --no-cache --virtual build-essentials \
    zlib-dev g++ make automake autoconf

RUN docker-php-ext-install pdo pdo_mysql

# Install Xdebug
RUN pecl install xdebug && \
    docker-php-ext-enable xdebug

# Copy Xdebug configuration
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN wget https://getcomposer.org/composer-stable.phar -O /usr/local/bin/composer && chmod +x /usr/local/bin/composer