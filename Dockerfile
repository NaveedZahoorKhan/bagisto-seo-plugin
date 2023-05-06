# Docker file for building a laravel application

FROM php:8.1-apache

# Set Environment Variables
ENV DEBIAN_FRONTEND noninteractive

# RUN echo "deb http://ppa.launchpad.net/chris-lea/libsodium/ubuntu precise main" >> /etc/apt/sources.list
# RUN echo "deb-src http://ppa.launchpad.net/chris-lea/libsodium/ubuntu precise main" >> /etc/apt/sources.list


#
#--------------------------------------------------------------------------
# Software's Installation
#--------------------------------------------------------------------------
#
# Installing tools and PHP extentions using "apt", "docker-php", "pecl",
#

# Install "curl", "libmemcached-dev", "libpq-dev", "libjpeg-dev",
#         "libpng-dev", "libfreetype6-dev", "libssl-dev", "libmcrypt-dev",


RUN apt-get update && apt-get upgrade -y 
RUN apt-get install -y zlib1g-dev libicu-dev g++ \
&& docker-php-ext-configure intl \
&& docker-php-ext-install intl

RUN set -eux; \
    apt-get update; \
    apt-get upgrade -y; \
    apt-get install -y --no-install-recommends \
    curl \
    libmemcached-dev \
    libz-dev \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libssl-dev \
    libzip-dev \
    libwebp-dev \
    libxpm-dev \
    libmcrypt-dev \
    libonig-dev; \
    # libsodium-dev \
    rm -rf /var/lib/apt/lists/*

RUN set -eux; \
    # Install the PHP pdo_mysql extention
    docker-php-ext-install pdo_mysql; \
    # Install the PHP pdo_pgsql extention
    docker-php-ext-install pdo_pgsql; \
    # Install the PHP gd library
    docker-php-ext-configure gd \
    --prefix=/usr \
    --with-jpeg \
    --with-webp \
    --with-xpm \
    --with-freetype; \
    docker-php-ext-install gd; \
    # Install the PHP zip extention
    docker-php-ext-install zip; \
    # Install the PHP exif extention
    docker-php-ext-install exif; \
    # install mysqli extension
    docker-php-ext-install mysqli; \
    # Install the PHP sodium extention
    # docker-php-ext-install sodium; \
    php -r 'var_dump(gd_info());'


# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set an active directory
WORKDIR /var/www/html

# copy files
COPY . .


RUN sed -i -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf


RUN a2enmod rewrite


EXPOSE 80
