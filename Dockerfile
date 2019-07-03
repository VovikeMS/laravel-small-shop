FROM php:7.3-fpm

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        curl \
        libzip-dev \
        libz-dev \
        libpq-dev \
        zlib1g-dev \
        libjpeg-dev \
        libpng-dev \
        libicu-dev \
        libfreetype6-dev \
        libssl-dev \
        libmcrypt-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mysqli \
    && docker-php-ext-configure gd \
        --with-jpeg-dir=/usr/lib \
        --with-freetype-dir=/usr/include/freetype2 \
    && docker-php-ext-install gd \
    && pecl install -o -f redis \
    && docker-php-ext-enable redis \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-install zip \
    && docker-php-ext-install tokenizer \
    && docker-php-ext-install bcmath \
    && rm -rf /tmp/pear

RUN usermod -u 1000 www-data

ADD . /var/www
ADD ./docker/php-fpm/php.ini /usr/local/etc/php/conf.d
ADD ./docker/php-fpm/fpm.pool.conf /usr/local/etc/php-fpm.d/

WORKDIR /var/www

CMD ["php-fpm"]

EXPOSE 9000
