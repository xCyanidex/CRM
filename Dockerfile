FROM php:8.2

WORKDIR /var/www/html

RUN apt-get update -y \
    && apt-get install -y openssl zip unzip git libonig-dev  # Added libonig-dev for oniguruma support

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo mbstring pdo_mysql

COPY . .

RUN chown -R www-data:www-data /var/www/html

RUN composer install

EXPOSE 8000
CMD php artisan serve --host=0.0.0.0
