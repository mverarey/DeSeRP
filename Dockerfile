FROM php:7.2-fpm-alpine
RUN apk add --no-cache zip libzip-dev
RUN docker-php-ext-configure zip --with-libzip
RUN docker-php-ext-install zip pdo pdo_mysql
