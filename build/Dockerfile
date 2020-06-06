FROM php:7.4-fpm

# install composer
RUN apt-get update && \
    apt-get install -y \
    git \
    curl && \
    curl -s https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

COPY . /web

WORKDIR /web

CMD ["php-fpm"]
