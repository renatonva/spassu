FROM php:8.2-fpm

WORKDIR /var/www

RUN rm -rf /var/www/html

# Install system dependencies and the PostgreSQL PDO extension
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    unzip \
    git \
    curl \
    libzip-dev \
    apt-utils \
    libonig-dev \
    postgresql-client 
    
RUN apt-get install -y postgresql-server-dev-all
RUN docker-php-ext-install pdo_pgsql
RUN docker-php-ext-install opcache
# Copiar configurações do OPcache
COPY opcache.ini /usr/local/etc/php/conf.d/opcache.ini

COPY . /var/www

RUN docker-php-ext-install pdo_mysql mbstring exif
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd

RUN mkdir -p /usr/src/php/ext/redis; \
	curl -fsSL https://pecl.php.net/get/redis --ipv4 | tar xvz -C "/usr/src/php/ext/redis" --strip 1; \
	docker-php-ext-install redis;

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY --chown=user:laravel . /var/www

RUN useradd -m -s /bin/bash user
USER user

EXPOSE 9000

CMD ["php-fpm"]