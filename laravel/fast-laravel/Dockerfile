FROM php:8.2.6-fpm-alpine3.18

RUN docker-php-ext-install pdo pdo_mysql

RUN apk add libzip-dev

RUN docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Copy app source code
COPY . .
RUN composer install

# #Expose port and start application
EXPOSE 8000
CMD php artisan serve --host=0.0.0.0