FROM php:7.1-fpm

ENV DEBIAN_FRONTEND noninteractive

MAINTAINER Aleksand Manichev <a.manichev@gmail.com>

# Install packages
RUN apt-get update &&\
  apt-get install -y curl unzip git \
          libfreetype6-dev \
          libjpeg62-turbo-dev \
          libmcrypt-dev \
          libxml2 libxml2-dev \
          libicu52 libicu-dev \
          libpng12-dev &&\
          apt-get clean && \
  rm -r /var/lib/apt/lists/* /tmp/*

RUN docker-php-ext-install pdo pdo_mysql mysqli mbstring bcmath iconv zip opcache soap intl &&\
    docker-php-ext-configure gd \
        --with-freetype-dir=/usr/include/ \
        --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-install gd

RUN pecl install xdebug redis igbinary

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN mkdir /var/www/.composer && chown www-data:www-data /var/www/.composer

# Add configuration files
ADD php.ini /usr/local/etc/php/php.ini
ADD www.conf /usr/local/etc/php-fpm.d/www.conf
ADD conf.d /usr/local/etc/php/conf.d

RUN usermod -u 1000 www-data

# Copy source files
COPY . /var/www/test_t.test

WORKDIR /var/www/test_t.test./

CMD ["php-fpm"]

EXPOSE 9000