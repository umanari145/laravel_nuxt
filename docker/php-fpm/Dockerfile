FROM php:8.1-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
  zlib1g-dev mariadb-client \
  libpq-dev \
  libzip-dev \
  postgresql \
  python3 \
  unzip \
  && docker-php-ext-install \
    pdo_mysql \
    sockets \
    zip \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY --from=node:18 /usr/local/bin /usr/local/bin
COPY --from=node:18 /usr/local/lib /usr/local/lib

RUN npm install -g npm-check-updates
WORKDIR /var/www/html
