FROM ubuntu:22.04
LABEL maintainer="majid.mohammadi11@gmail.com"
LABEL version="0.1"
LABEL description="Simple Framework"

COPY . /var/www/html

EXPOSE 1880
