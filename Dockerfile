FROM php:7.2-fpm

# install the PHP extensions we need
# from wordpress:4.9-php7.2-fpm
RUN set -ex; \
    \
    apt-get update; \
    apt-get install -y --no-install-recommends \
    libjpeg-dev \
    libpng-dev \
    nginx \
    supervisor \
    gnupg \
    subversion \
    git \
    ; \
    \
    docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr; \
docker-php-ext-install gd mysqli zip;

# Configure nginx
COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf
COPY ./nginx/conf /etc/nginx
COPY ./nginx/nginx.conf /etc/nginx/nginx.conf

# Configure supervisord
COPY ./supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Custom PHP configurations
COPY ./php.ini /usr/local/etc/php

# install node and yarn
RUN bash -c "curl -sL https://deb.nodesource.com/setup_6.x | bash -"
RUN bash -c "apt-get install -y nodejs"
RUN bash -c "npm install -g yarn"

# install php composer
RUN bash -c "curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer"

# install wp cli
RUN bash -c "curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar"
RUN bash -c "chmod +x wp-cli.phar"
RUN bash -c "mv wp-cli.phar /usr/local/bin/wp"

WORKDIR /var/www/html/dist

EXPOSE 80 443
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
