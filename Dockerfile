FROM php:7.2.30-apache

RUN docker-php-ext-install pdo pdo_mysql

# COPY ./src /var/www/html

WORKDIR /var/www/html

CMD [ "php", "./artisan", "serve", "--host=0.0.0.0", "--port=7000" ]
