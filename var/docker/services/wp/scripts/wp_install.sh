#!/bin/bash

echo "Checking if WordPress is already installed..."

# Check if WordPress directory exists
if [ -d "$WP_DIR" ]; then
    echo "WordPress is already installed. Removing existing installation..."
    rm -rf "$WP_DIR"/*
fi

echo "Installing WordPress $WP_VERSION ... on $WP_DIR"

# Create WordPress directory
mkdir -p "$WP_DIR"

# Navigate to WordPress directory
cd "$WP_DIR"

# Download WordPress
wp core download --version="$WP_VERSION" --allow-root

# Create wp-config.php
wp config create --dbname="$WP_DB_NAME" \
                --dbuser="$WP_DB_USER" \
                --dbpass="$WP_DB_PASS" \
                --dbhost="$WP_DB_HOST" \
                --allow-root

# Clean the database if it exists
# wp db drop --yes --allow-root

# Create the database
# wp db create --allow-root

# Install WordPress
wp core install --url="$WP_URL" \
                --title="$WP_TITLE" \
                --admin_user="$WP_ADMIN_USER" \
                --admin_password="$WP_ADMIN_PASS" \
                --admin_email="$WP_ADMIN_EMAIL" \
                --allow-root


chown -R www-data:www-data "$WP_DIR"
chmod -R 755 "$WP_DIR"

echo "WordPress installed successfully! Visit https://$WP_URL to access your site."