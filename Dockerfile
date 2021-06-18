FROM composer:1.9.0 as build
WORKDIR /app
COPY . /app
RUN apk add imagemagick php7-imagick
RUN apk add php7-curl
RUN apk add libpng-dev
RUN apk add php7-gd

RUN composer require "ext-gd:*" --ignore-platform-reqs

FROM php:7.3-apache-stretch
RUN docker-php-ext-install pdo pdo_mysql
RUN composer global require hirak/prestissimo && composer install

EXPOSE 8080
COPY --from=build /app /var/www/
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY .env.example /var/www/.env
RUN chmod 777 -R /var/www/storage/ && \
    echo "Listen 8080" >> /etc/apache2/ports.conf && \
    chown -R www-data:www-data /var/www/ && \
    a2enmod rewrite
