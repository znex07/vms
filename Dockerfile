FROM php:7.3-apache-stretch
WORKDIR /app
# RUN cd /app && \
RUN mkdir -p /app
COPY . /app
RUN apk add php7-curl
RUN apk add libpng-dev
RUN apk add php7-gd
RUN apk add imagemagick php7-imagick wget
RUN sh -c "wget http://getcomposer.org/composer.phar && chmod a+x composer.phar && mv composer.phar /usr/local/bin/composer"

RUN composer require "ext-gd:*" --ignore-platform-reqs

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
