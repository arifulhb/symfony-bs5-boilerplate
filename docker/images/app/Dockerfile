FROM php:8.1-fpm-alpine3.16

COPY ./docker/config/php/php-ini-development.ini /usr/local/etc/php/conf.d/php.ini

# Work Directory
WORKDIR /var/www/app

# Install Nodejs
#RUN apk update \
#    &&  apk add --no-cache --virtual buildDeps autoconf nodejs \
#    &&  apk del buildDeps

# Install packages
RUN apk update && apk add --no-cache --virtual buildDeps autoconf \
        wget \
        curl \
        bash \
        redis \
        mysql-client \
        imagemagick \
        libmcrypt-dev build-base gnupg \
        bash alpine-sdk \
    &&  apk del buildDeps

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.3.10

RUN apk update && apk add --no-cache --virtual buildDeps autoconf \
    &&  docker-php-ext-install \
        pcntl \
        exif \
        mysqli \
        pdo_mysql \
        opcache \
    &&  apk del buildDeps

RUN apk add --no-cache bash \
  && curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash \
  && apk add symfony-cli

# Add user for laravel application
RUN addgroup -S www && adduser -S -G www www \
    && chown -R www-data:www-data /var/www/app \
    && chmod -R 755 /var/www/app

# Change current user to www
USER www
EXPOSE 8080 8000
