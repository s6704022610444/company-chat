#!/bin/sh
set -e

# Replace PORT in nginx.conf if provided by Render
PORT=${PORT:-8080}
sed -i "s/listen 8080;/listen $PORT;/g" /etc/nginx/nginx.conf

# Prepare database
touch /var/www/database/database.sqlite
chmod 777 /var/www/database/database.sqlite
chmod -R 777 /var/www/storage /var/www/bootstrap/cache

# Run migrations
php artisan migrate --force

# Seed initial users if empty
php artisan db:seed --force || true

# Start Laravel HTTP server in background
php artisan serve --host=127.0.0.1 --port=8000 &

# Start Laravel Reverb WebSocket server in background
php artisan reverb:start --host=127.0.0.1 --port=8081 &

# Start Nginx in foreground to handle external requests
echo "Starting Nginx on port $PORT..."
nginx -g "daemon off;"
