FROM php:7.4-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN apt-get update && apt-get install vim -y
RUN a2enmod rewrite && /etc/init.d/apache2 restart