FROM php:7.4-fpm-alpine

RUN apk add --no-cache nginx wget
RUN apk add zlib-dev libpng-dev libzip-dev
RUN apk add imagemagick php7-imagick
RUN php -m | grep imagick
RUN docker-php-ext-install gd zip
RUN mkdir -p /run/nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf

RUN mkdir -p /app
COPY . /app

RUN sh -c "wget http://getcomposer.org/composer.phar && chmod a+x composer.phar && mv composer.phar /usr/local/bin/composer"
RUN cd /app && \
    /usr/local/bin/composer install --no-dev --no-scripts
RUN cd /app && /usr/local/bin/composer dump-autoload
RUN chown -R www-data: /app

CMD sh /app/docker/startup.sh
