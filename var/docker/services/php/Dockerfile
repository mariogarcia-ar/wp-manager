FROM php:8.1-fpm-alpine
# FROM php:7.4-fpm-alpine

# Install dependencies
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli pdo pdo_mysql 

RUN chown www-data:www-data /var/www/html -R && chmod 755 /var/www/html -R

# Install WP-CLI
RUN apk add --no-cache curl \
    && curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x wp-cli.phar \
    && mv wp-cli.phar /usr/local/bin/wp

RUN apk add --no-cache mysql-client    

RUN mkdir -p /var/www/html/wp-content/upgrade
RUN chown www-data:www-data /var/www/html/wp-content/upgrade -R && chmod 755 /var/www/html/wp-content/upgrade -R

# Install GD and Imagick extensions
RUN apk add --no-cache libpng libjpeg-turbo freetype libgomp \
    && apk add --no-cache --virtual .phpize-deps $PHPIZE_DEPS imagemagick-dev libpng-dev libjpeg-turbo-dev freetype-dev \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install -j$(nproc) gd 