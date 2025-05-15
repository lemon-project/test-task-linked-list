# Use the official PHP 8.4 image
FROM php:8.4-cli-bullseye

# Update package list
RUN apt-get update

# Install required system dependencies one-by-one
RUN apt-get install -y git
RUN apt-get install -y unzip
RUN apt-get install -y libzip-dev

# Install PHP extensions individually for better error tracking
RUN docker-php-ext-install zip
RUN docker-php-ext-enable zip

# Install Xdebug (optional for development)
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www