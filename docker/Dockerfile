FROM dunglas/frankenphp:1-php8.4-alpine

WORKDIR /app

RUN apk add --no-cache \
    git curl unzip zip \
    freetype-dev libjpeg-turbo-dev libpng-dev \
    fontconfig ttf-dejavu

RUN install-php-extensions \
    pdo_mysql \
    redis \
    intl \
    zip \
    gd \
    opcache \
    mbstring \
    dom

RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

COPY docker/php.ini /usr/local/etc/php/php.ini
COPY docker/Caddyfile /etc/frankenphp/Caddyfile

EXPOSE 80
