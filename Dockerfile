FROM php:7.4-fpm


RUN apt-get update && apt-get upgrade && apt-get install -y \
        php-curl \
        php-xml \
        php-zip \
        php7.4-mysql \
        php7.4-common \
        php7.4-json \
        php7.4-mbstring \
        vim \
        openssl \



