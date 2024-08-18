# Use PHP with Apache as the base image
FROM php:8.3.10-apache

# Install Additional System Dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# # Clear cache
# RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# # Enable Apache mod_rewrite for URL rewriting
# RUN a2enmod rewrite

# # Install PHP extensions
# RUN docker-php-ext-install pdo_mysql zip

# # Configure Apache DocumentRoot to point to Laravel's public directory
# # and update Apache configuration files
# ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
# RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
# RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy the application code


# # Set the working directory
# WORKDIR /var/www/html

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

# Install project dependencies
RUN composer install

# EXPOSE 80

# Set permissions
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]