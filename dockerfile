FROM php:7.3-apache
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install hash
RUN docker-php-ext-install json
RUN docker-php-ext-install session
WORKDIR /main

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer
