#!/bin/bash

# Run as root
sudo su -
echo "Enter Your URL Without HTTP OR www. EX => example.com :"
read url
# Install PHP and necessary extensions
sudo apt update
sudo apt install -y php php-cli php-mysql php-mbstring php-xml php-bcmath php-fpm

# Install Composer and Nginx
sudo apt install -y composer nginx

# Check installed versions
php_v=$(php -v 2>/dev/null)
composer_v=$(composer --version 2>/dev/null)
nginx_v=$(nginx -v 2>&1)

# Validate installations
if [[ -z "$php_v" || -z "$composer_v" || -z "$nginx_v" ]]; then
    echo "One or more components failed to install. Retrying..."

    sudo apt install -y php php-cli php-mysql php-mbstring php-xml php-bcmath php-fpm
    sudo apt install -y composer nginx

    # Re-check
    php_v=$(php -v 2>/dev/null)
    composer_v=$(composer --version 2>/dev/null)
    nginx_v=$(nginx -v 2>&1)

    if [[ -z "$php_v" || -z "$composer_v" || -z "$nginx_v" ]]; then
        echo "Check your internet connection or package sources!"
        exit 1
    fi
fi
#ECHO Success
echo "Installation completed successfully!"
echo "PHP Version: $php_v"
echo "Composer Version: $composer_v"
echo "Nginx Version: $nginx_v"
# NGINX Config
sudo cp nginx.conf shopingo.conf
if [ -f shopingo.conf ]; then
    sudo cp shopingo.conf /etc/nginx/sites-available/
    sudo ln -s /etc/nginx/sites-available/shopingo.conf /etc/nginx/sites-enabled/
else
    echo "shopingo.conf not found. Skipping Nginx configuration."
    exit 1
fi
sudo nginx -t
sudo systemctl restart nginx

sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d $url -d www.$url
