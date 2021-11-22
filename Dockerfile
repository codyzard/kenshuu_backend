FROM php:7.4-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN apt update && apt install vim
RUN a2enmod rewrite && /etc/init.d/apache2 restart