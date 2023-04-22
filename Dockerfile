FROM --platform=linux/amd64,linux/arm phpdockerio/php74-fpm
LABEL maintainer="majid.mohammadi11@gmail.com"
LABEL version="0.1"
LABEL description="Simple Framework"

COPY . /var/www/html/test

EXPOSE 8090
