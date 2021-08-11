FROM php:7.4-apache-buster
RUN docker-php-ext-install mysqli && a2enmod rewrite