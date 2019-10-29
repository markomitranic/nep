FROM php:7.3-fpm AS prod

RUN apt-get update
RUN apt-get install nano -y
RUN apt-get install wget -y

RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli

RUN apt-get install -y libjpeg-dev \
    zlib1g-dev \
    libpng-dev \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libxpm-dev \
    libfreetype6-dev \
    libzip-dev

RUN docker-php-ext-configure gd --with-gd --with-webp-dir --with-jpeg-dir \
    --with-png-dir --with-zlib-dir --with-xpm-dir --with-freetype-dir \
    --enable-gd-native-ttf
RUN docker-php-ext-install gd
RUN docker-php-ext-install zip

WORKDIR /usr/share/nginx/html

COPY conf/php-fpm.conf /usr/local/etc/php-fpm.d/zzz-nep-fpm.conf
COPY conf/php.ini /usr/local/etc/php/conf.d/nep-php.ini
COPY conf/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.enable_cli=1" >> /usr/local/etc/php/conf.d/opcache.ini

COPY entrypoint.sh /app/entrypoint.sh
RUN ["chmod", "+x", "/app/entrypoint.sh"]

FROM prod AS dev
RUN echo "opcache.enable=0" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.enable_cli=0" >> /usr/local/etc/php/conf.d/opcache.ini
ARG XDEBUG_ACTIVE
ENV XDEBUG_ACTIVE=${XDEBUG_ACTIVE}
RUN if [ "$XDEBUG_ACTIVE" -eq 1 ] ; then \
        yes | pecl install xdebug \
        && PHP_IDE_CONFIG="serverName=nep.rs" \
        && echo "zend_extension=xdebug.so" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.remote_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.idekey=NEP-DEBUG" >> /usr/local/etc/php/conf.d/xdebug.ini \
    ; fi
