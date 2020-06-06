FROM php:7.4-fpm

# install composer
RUN apt-get install -y \
    curl && \
    curl -s https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# nodejs
RUN curl -sL https://deb.nodesource.com/setup_10.x | bash - \
&& \

# yarn
curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
&& \
echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list \
&& \

# install standart packages
apt-get update && \
    apt-get install -y \
    git \
    nodejs \
    yarn \
    libpng-dev

COPY . /web

WORKDIR /web

CMD ["php-fpm"]
