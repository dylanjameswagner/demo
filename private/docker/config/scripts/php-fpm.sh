#!/bin/bash
set -e

# Emulate /srv/binding
mkdir -p /srv/bindings
ln -s / "/srv/bindings/colab" || true
ln -s /media "/srv/bindings/colab/files" || true

# Additional setup
mkdir -p /src/logs

# Replace https with http
PRODUCTION_URL=${PRODUCTION_URL//https/http}

# Remove single trailing slash
PRODUCTION_URL=${PRODUCTION_URL%/}

# Update nginx config with production url
if [ -z "${PRODUCTION_URL}" ] || [ "$PRODUCTION_URL" == '""' ] || [ "$PRODUCTION_URL" == "''" ]; then
    PRODUCTION_URL="0.0.0.0"
fi

echo "set \$production_url '${PRODUCTION_URL}';" > /etc/nginx/snippets/production_images.conf

/etc/init.d/nginx start

# Run fpm with command options
php-fpm "$@"
