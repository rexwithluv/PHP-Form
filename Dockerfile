FROM php:apache-bullseye
RUN docker-php-ext-install pdo pdo_mysql