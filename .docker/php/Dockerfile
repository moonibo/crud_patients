FROM php:8.1-fpm-alpine

ARG UID
ARG GID

COPY zzz-fpm.conf /usr/local/etc/php-fpm.d/zzz-fpm.conf

RUN apk --update --no-cache add curl git openssh

RUN apk --update --no-cache add --virtual deps $PHPIZE_DEPS libsodium-dev libpng-dev libmemcached-dev linux-headers \
 && apk --update --no-cache add libpng libzip-dev libmemcached-libs libpq-dev mariadb-client mariadb-connector-c-dev \
 && pecl install -f redis xdebug

RUN git clone -b master https://github.com/php-memcached-dev/php-memcached /usr/src/php/ext/memcached \
 && docker-php-ext-configure /usr/src/php/ext/memcached --disable-memcached-sasl

RUN docker-php-ext-install -j$(nproc) opcache pdo pdo_mysql zip gd sockets pcntl /usr/src/php/ext/memcached \
 && docker-php-ext-enable opcache pdo_mysql pcntl sodium sockets memcached zip gd redis xdebug \
 && apk del --purge deps \
 && rm -rf /usr/src/php/ext/memcached

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
 && echo "xdebug.start_with_request=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
 && echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
 && echo "opcache.enable=0" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
 && echo "opcache.enable_cli=0" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
 && echo "opcache.jit=1255" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
 && echo "opcache.jit_buffer_size=128M" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini

RUN addgroup -S -g ${GID} app \
 && adduser -S -D -u ${UID} -s /bin/ash -h /home/app -G app app \
 && chown -R app:app /home/app \
 && chmod -R g+w /home/app \
 && mkdir -p /var/run/php \
 && chown -R app:app /var/run/php \
 && chmod -R g+w /var/run/php

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

RUN mkdir -p /home/app/.composer \
 && chmod -R g+w /home/app/.composer

USER app
WORKDIR /app
