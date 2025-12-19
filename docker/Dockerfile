FROM dunglas/frankenphp:1-php8.4-alpine

WORKDIR /app

# System deps for GD (and some common build needs)
RUN apk add --no-cache \
    git curl unzip zip \
    freetype-dev libjpeg-turbo-dev libpng-dev

# PHP extensions
# NOTE: jangan install gd 2x. Pilih 1 jalur aja (install-php-extensions).
RUN install-php-extensions \
    pdo_mysql \
    redis \
    intl \
    zip \
    gd \
    opcache

# Install Composer (stable)
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

# Config
COPY docker/php.ini /usr/local/etc/php/php.ini
COPY docker/Caddyfile /etc/frankenphp/Caddyfile

EXPOSE 80
