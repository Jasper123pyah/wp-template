FROM wordpress:php8.1-fpm

# Install additional PHP extensions if needed
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Copy custom php.ini settings
COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini

# Copy the theme
COPY theme /var/www/html/wp-content/themes/theme

# Set permissions
RUN chown -R www-data:www-data /var/www/html/wp-content