FROM php:8.2-apache
LABEL maintainer="majid.mohammadi11@gmail.com"
LABEL version="0.1"
LABEL description="Simple Framework"

WORKDIR /var/www/html
COPY ./ ./
RUN a2enmod rewrite
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN apt update
RUN apt install git -y
RUN composer install
EXPOSE 80 443
