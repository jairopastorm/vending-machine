FROM php:7.4-fpm

RUN apt-get update && apt-get install -y git

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin

WORKDIR /var/www/vending-machine
