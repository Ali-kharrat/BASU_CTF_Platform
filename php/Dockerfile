FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    libmariadb-dev

RUN docker-php-ext-install mysqli

RUN a2enmod rewrite

RUN echo "ServerName basucomp.com" >> /etc/apache2/apache2.conf

