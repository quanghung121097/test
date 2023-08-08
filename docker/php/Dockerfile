FROM php:7.4-fpm
ARG NODE_VERSION=14
RUN apt-get update
RUN apt-get install -y openssl zip unzip git curl
RUN apt-get install -y libzip-dev libonig-dev libicu-dev libbz2-dev libpng-dev libjpeg-dev libmcrypt-dev libreadline-dev libfreetype6-dev
RUN apt-get install -y autoconf pkg-config libssl-dev \
    && php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && curl -sLS https://deb.nodesource.com/setup_$NODE_VERSION.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm
# RUN pecl install xdebug \
#     && docker-php-ext-enable xdebug
RUN chmod 777 /var/www
RUN  docker-php-ext-configure \
        gd --enable-gd --with-freetype --with-jpeg
RUN docker-php-ext-install bcmath mbstring intl opcache mysqli pdo pdo_mysql gd
COPY php.ini /etc/php/7.4/cli/conf.d/php.ini