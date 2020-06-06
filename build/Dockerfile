FROM php:7.4-fpm

COPY . /web

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

WORKDIR /web

CMD ["php-fpm"]
