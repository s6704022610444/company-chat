FROM php:8.4-cli-alpine

# Install system dependencies, Nginx, Node.js, and PHP extensions
RUN apk add --no-cache \
    nginx \
    nodejs \
    npm \
    sqlite-dev \
    sqlite-libs \
    icu-dev \
    libzip-dev \
    sed \
    curl \
    && docker-php-ext-install pdo pdo_sqlite pcntl bcmath zip

# Copy Composer from official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs

# Set build-time & runtime environment defaults
ENV VITE_REVERB_APP_KEY="btadnryd37zz0juhuqkq" \
    REVERB_APP_KEY="btadnryd37zz0juhuqkq" \
    REVERB_APP_ID="372109" \
    REVERB_APP_SECRET="44vhsrogqglvwcn4uavh" \
    BROADCAST_CONNECTION="reverb" \
    DB_CONNECTION="sqlite" \
    SESSION_DRIVER="database" \
    QUEUE_CONNECTION="sync"

# Install NPM dependencies and build assets
RUN npm install && npm run build

# Copy custom Nginx configuration
COPY nginx.conf /etc/nginx/nginx.conf

# Setup start script
RUN chmod +x /var/www/start.sh

EXPOSE 8080

CMD ["/var/www/start.sh"]
