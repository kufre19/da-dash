FROM php:8.2-apache




RUN  docker-php-ext-install mysqli pdo pdo_mysql
RUN umask 000




# Install Composer
# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer



COPY . /var/www/html

USER 1000