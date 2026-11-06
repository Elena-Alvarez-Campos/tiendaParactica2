FROM php:apache

RUN apt-get update
RUN apt-get install -y autoconf pkg-config libssl-dev
RUN pecl install mongodb
RUN docker-php-ext-enable mongodb
RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini

RUN pecl install
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer


EXPOSE 80 443