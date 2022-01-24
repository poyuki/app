FROM php:8.0.10-fpm-alpine3.14

ENV PHPIZE_DEPS \
        autoconf \
        dpkg-dev \
        dpkg \
        file \
        g++ \
        gcc \
        libc-dev \
        make \
        pkgconf \
        re2c \
        wget

RUN set -eux; \
        cd /; \
        apk add --no-cache --virtual .build-deps $PHPIZE_DEPS

RUN  set -eux; \
     cd /;\
     yes "" | pecl install redis xdebug \
     ; \
     docker-php-ext-enable xdebug; \
     docker-php-ext-enable redis;

# composer
RUN set -eu; \
    EXPECTED_CHECKSUM="$(php -r 'copy("https://composer.github.io/installer.sig", "php://stdout");')"; \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"; \
    ACTUAL_CHECKSUM="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"; \
    if [ "$EXPECTED_CHECKSUM" != "$ACTUAL_CHECKSUM" ]; \
    then \
        >&2 echo 'ERROR: Invalid installer checksum'; \
        rm composer-setup.php; \
        exit 1; \
    fi; \
    php composer-setup.php --quiet --install-dir=/usr/local/bin --filename=composer; \
    RESULT=$?; \
    rm composer-setup.php; \
    exit $RESULT;

WORKDIR /var/www/html
