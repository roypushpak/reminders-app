FROM php:8.2-apache

# Install required system packages
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql

# Enable Apache modules
RUN a2enmod rewrite

# Copy application files from the Reminders App directory to the web root
COPY "Reminders App/" /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80
