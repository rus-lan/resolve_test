FROM php:7.4-fpm

# intl
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    g++
RUN docker-php-ext-install intl

# zip
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zlib1g-dev \
    locales locales-all
RUN docker-php-ext-install zip

RUN apt-get update && apt-get install -y git

RUN docker-php-ext-install \
    pcntl \
    mysqli \
    pdo_mysql \
    gd

# APCU
RUN pecl install apcu-5.1.17 && docker-php-ext-enable apcu

# xdebug
RUN pecl install xdebug-2.9.5 && docker-php-ext-enable xdebug && echo "" > /tmp/xdebug.log && chmod 0777 /tmp/xdebug.log
COPY resources/deployments/local/site/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# opcache
RUN docker-php-ext-install opcache
COPY resources/deployments/local/site/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

RUN docker-php-ext-install exif

# user mapping
ARG HOME
ARG USER
ARG UID
ARG GID

RUN groupadd \
    --gid ${GID} \
    ${USER} \
 && useradd \
    --uid ${UID} \
    --gid ${GID} \
    --shell /bin/bash \
    --home-dir ${HOME} \
    ${USER} \
 && sed -i "s/user = \(\S*\)/user = ${USER}/g" /usr/local/etc/php-fpm.d/www.conf \
 && sed -i "s/group = \(\S*\)/group = ${USER}/g" /usr/local/etc/php-fpm.d/www.conf

# install composer
ARG COMPOSER_VERSION

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --version=${COMPOSER_VERSION} --install-dir=/usr/local/bin --filename=composer

USER ${USER}

COPY resources/deployments/local/site/php/uploads.ini /usr/local/etc/php/conf.d/uploads.ini
COPY resources/deployments/local/site/php/tzone.ini /usr/local/etc/php/conf.d/tzone.ini

WORKDIR /app
