FROM php:8.2-apache
LABEL maintainer="majid.mohammadi11@gmail.com"
LABEL version="0.1"
LABEL description="Simple Framework"

WORKDIR /var/www/html
COPY ./* ./
RUN a2enmod rewrite
RUN composer install
EXPOSE 80 443