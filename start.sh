#!/bin/sh
set -e

export TZ="Asia/Bangkok"

# Replace PORT in nginx.conf if provided by Render
PORT=${PORT:-8080}
sed -i "s/listen 8080;/listen $PORT;/g" /etc/nginx/nginx.conf

# Prepare database
if [ -n "$DATABASE_URL" ] || [ -n "$DB_URL" ]; then
    echo "=========================================================="
    echo "  DATABASE_URL detected! Switching to PostgreSQL database "
    echo "=========================================================="
    export DB_CONNECTION="pgsql"
else
    echo "=========================================================="
    echo "  WARNING: DATABASE_URL not set! Using local SQLite file  "
    echo "  (Note: SQLite in Docker will reset upon redeployment)   "
    echo "=========================================================="
    export DB_CONNECTION="sqlite"
    touch /var/www/database/database.sqlite
    chmod 777 /var/www/database/database.sqlite
fi
chmod -R 777 /var/www/storage /var/www/bootstrap/cache

# Clear cached config so runtime environment variables are strictly loaded
php artisan config:clear || true

# Run migrations
echo "Running database migrations..."
php artisan migrate --force

# Seed initial users if empty
php artisan db:seed --force || true

export REVERB_HOST="127.0.0.1"
export REVERB_PORT="8081"
export REVERB_SCHEME="http"

# Start Laravel HTTP server in background
php artisan serve --host=127.0.0.1 --port=8000 &

# Start Laravel Reverb WebSocket server in background
php artisan reverb:start --host=0.0.0.0 --port=8081 &

# Start Nginx in foreground to handle external requests
echo "Starting Nginx on port $PORT..."
nginx -g "daemon off;"
