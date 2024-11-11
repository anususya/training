FROM php:8.2-fpm-alpine3.20
LABEL authors="anna"
# ENV ADMIN="anna"
RUN apk update && apk upgrade && apk add bash

RUN apk add  --no-cache \
    php82-cli \
    php82-intl \
    php82-bcmath \
    php82-opcache \
    php82-pdo \
    php82-pdo_pgsql \
    php82-pecl-imagick \
    php82-gd

RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS imagemagick-dev \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && apk del .build-deps

RUN apk add libgomp

RUN apk add --no-cache composer

RUN apk add --update linux-headers

RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apk del -f .build-deps

WORKDIR /var/www

#CMD ["supervisord", "-c", "/etc/supervisor.d/supervisord.ini"]