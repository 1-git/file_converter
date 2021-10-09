FROM php:8.0-cli-alpine

COPY . /var/www/html

WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN wget https://phar.phpunit.de/phpunit-9.phar -O /usr/local/bin/phpunit && \
    chmod +x /usr/local/bin/phpunit