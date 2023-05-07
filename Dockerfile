FROM php:8.0.5-fpm-alpine
LABEL maintainer="majid.mohammadi11@gmail.com"
LABEL version="0.1"
LABEL description="Simple Framework"

WORKDIR /var/www/html
# RUN a2enmod rewrite
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN apk update
RUN apk upgrade
RUN apk add git
RUN git clone git@github.com:majidphp/OneFramework.git
RUN composer install
EXPOSE 80
CMD sh server.sh cron
