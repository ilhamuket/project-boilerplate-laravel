FROM dunglas/frankenphp:latest

# PHP extensions
RUN install-php-extensions \
    pdo_mysql \
    redis \
    intl \
    zip \
    gd \
    opcache

WORKDIR /app

# Config
COPY docker/php.ini /usr/local/etc/php/php.ini
COPY docker/Caddyfile /etc/frankenphp/Caddyfile

EXPOSE 80
