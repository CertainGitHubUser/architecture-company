FROM php:7.4-fpm
RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        librabbitmq-dev \
    && docker-php-ext-install \
        pdo_mysql \
        zip \
    && pecl install amqp \
    && docker-php-ext-enable amqp


RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer
RUN mkdir -p /app
COPY docker/php-consumer/ /var/www/scripts/
WORKDIR /app
ENTRYPOINT ["bash", "/var/www/scripts/start_consumer.sh"]