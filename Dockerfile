ARG PHP_VERSION=8

FROM php:${PHP_VERSION}-fpm

WORKDIR /var/www

RUN apt-get update && \
    apt-get install -y autoconf pkg-config libssl-dev git libzip-dev zlib1g-dev libpng-dev && \
    pecl install mongodb && docker-php-ext-enable mongodb && \
    docker-php-ext-install gd zip 


RUN apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

COPY . /var/www

RUN composer update

RUN composer install

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www/

# Copy existing application directory permissions
COPY --chown=www:www . /var/www


# Change current user to www
RUN chmod -R ug+w /var/www
RUN chmod -R 777 /var/www/storage

USER www

EXPOSE 9000
CMD ["php-fpm"]


