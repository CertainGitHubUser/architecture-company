ARG PHP_VERSION=7.4.30

FROM php:7.4-fpm-alpine AS app_php

ARG WORKDIR=/app

RUN docker-php-source extract \
    && apk add --update --virtual .build-deps autoconf g++ make pcre-dev icu-dev openssl-dev libxml2-dev libmcrypt-dev git libpng-dev \
     # Sockets
     && docker-php-ext-install pdo_mysql sockets opcache bcmath \
     # Amqp
     && apk add --no-cache rabbitmq-c rabbitmq-c-dev $PHPIZE_DEPS \
     && pecl install amqp\
     && docker-php-ext-enable amqp \
     && apk del $PHPIZE_DEPS \
     && apk add --update rabbitmq-c-utils \
    # Install pgsql
    && apk add postgresql-dev \
    && docker-php-ext-install pgsql pdo_pgsql \
    && apk del postgresql-libs libsasl db \
    # Instaling pecl modules
	&& pecl install apcu xdebug-3.1.5 \
    # Enable pecl modules
    && docker-php-ext-enable apcu opcache xdebug \
    # Installing intl
    && apk add icu-libs icu \
    && docker-php-ext-install intl \
    # Post run
	&& runDeps="$( \
		scanelf --needed --nobanner --format '%n#p' --recursive /usr/local/lib/php/extensions \
			| tr ',' '\n' \
			| sort -u \
			| awk 'system("[ -e /usr/local/lib/" $1 " ]") == 0 { next } { print "so:" $1 }' \
	)" \
    && apk add --update dumb-init\
    && apk add --no-cache --virtual .app-phpexts-rundeps $runDeps \
	&& pecl clear-cache \
    && docker-php-source delete \
    && apk del --purge .build-deps \
    && rm -rf /tmp/pear \
    && rm -rf /var/cache/apk/*

#RUN echo "Extensions install - start" \
#    #TODO add messages
#    && echo "Extensions install - finish" \
RUN apk add --no-cache bash
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY docker/php/php.ini $PHP_INI_DIR/conf.d/php.ini
COPY docker/php/php-cli.ini $PHP_INI_DIR/conf.d/php-cli.ini
COPY docker/php/xdebug.ini $PHP_INI_DIR/conf.d/xdebug.ini

RUN mkdir -p ${WORKDIR}
WORKDIR ${WORKDIR}

# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1

# prevent the reinstallation of vendors at every changes in the source code
COPY composer.json composer.lock symfony.lock ./
RUN set -eux; \
	composer install --prefer-dist --no-autoloader --no-scripts  --no-progress; \
	composer clear-cache

RUN set -eux \
	&& mkdir -p var/cache var/log \
	&& composer dump-autoload --classmap-authoritative

RUN chmod 777 -R var

VOLUME ${WORKDIR}/var

COPY docker/php/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]