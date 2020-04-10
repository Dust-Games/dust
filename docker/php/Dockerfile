FROM php:7.4.4-fpm

# Dependencies
RUN apt-get update
RUN apt-get install -y dialog apt-utils

# Zip
RUN apt-get install -y libzip-dev zip && docker-php-ext-install zip

# Curl
RUN apt-get install -y libcurl3-dev curl && docker-php-ext-install curl

# PostgreSQL
RUN apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql

# PHP Redis extension
RUN pecl install redis
RUN docker-php-ext-enable redis

# Install Xdebug
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

# Composer installation
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
RUN chmod 0755 /usr/bin/composer

# Clean up
RUN apt-get clean
RUN apt-get -y autoremove
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Set up default directory
WORKDIR /var/www/backend

EXPOSE 9000
