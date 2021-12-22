FROM php:8.0.0-fpm-alpine3.12

RUN apk add --update git openssh

COPY --from=composer:2.1 /usr/bin/composer /usr/local/bin/composer

RUN apk add --update autoconf make gcc g++ mysql-client curl-dev pkgconfig openssl-dev ca-certificates alpine-sdk automake autoconf libxml2-dev curl-dev git bash zip
RUN docker-php-ext-install pdo_mysql

COPY php.ini /usr/local/etc/php/conf.d/php.ini

RUN pecl install xdebug-3.1.0
RUN docker-php-ext-enable xdebug
COPY xdebug-config.ini /usr/local/etc/php/conf.d/xdebug-config.ini
