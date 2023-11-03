FROM php:7.4-cli

# Install dependencies for Chromium
RUN apt-get update && apt-get install -y wget gnupg2 \
    && apt-get install -y chromium

# Install additional PHP extensions if needed
# RUN docker-php-ext-install ...

# Copy your PHP script to the container
COPY . /var/www/html

# Expose the port the webserver is running on
EXPOSE 80

# Start the web server
CMD ["php", "-S", "0.0.0.0:${PORT}", "-t", "/var/www/html"]
