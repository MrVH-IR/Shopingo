#!/bin/bash

# Check if running as root
if [ "$EUID" -ne 0 ]; then
    echo "Please run this script with sudo or as root."
    exit 1
fi

# Get domain from user
echo "Enter your domain name without http:// or www. (e.g., example.com):"
read -r url

if [ -z "$url" ]; then
    echo "Domain name cannot be empty!"
    exit 1
fi

# Update system
apt update

# Install PHP, Nginx, Composer
apt install -y php php-cli php-fpm php-mysql php-mbstring php-xml php-bcmath php-zip php-curl
apt install -y nginx composer

# Verify installations
if ! php -v > /dev/null 2>&1; then
    echo "PHP installation failed!"
    exit 1
fi

if ! composer --version > /dev/null 2>&1; then
    echo "Composer installation failed!"
    exit 1
fi

if ! nginx -v > /dev/null 2>&1; then
    echo "Nginx installation failed!"
    exit 1
fi

echo "✅ PHP, Composer, and Nginx installed successfully."

# Create web root
WEB_ROOT="/var/www/html/current"
sudo mkdir -p "$WEB_ROOT"
sudo chown -R $SUDO_USER:www-data /var/www/html
sudo chmod -R 775 /var/www/html

# Copy Nginx config
if [ ! -f "nginx_nodocker.conf" ]; then
    echo "Error: nginx_nodocker.conf not found in current directory!"
    echo "Please create a template with 'server_name localhost;' and 'root /var/www/html/current/public;'"
    exit 1
fi

SITE_CONF="/etc/nginx/sites-available/$url.conf"

# Remove old config if exists
rm -f "$SITE_CONF"
rm -f "/etc/nginx/sites-enabled/$url.conf"

cp nginx.conf "$SITE_CONF"

# Replace placeholders
sed -i "s/localhost/$url/g" "$SITE_CONF"
sed -i "s|/var/www/html/current/public|/var/www/html/current/public|g" "$SITE_CONF"

# Enable site
ln -s "$SITE_CONF" "/etc/nginx/sites-enabled/"

# Test Nginx config
if ! nginx -t; then
    echo "Nginx configuration test failed!"
    exit 1
fi

# Restart Nginx
systemctl restart nginx
echo "✅ Nginx configured and restarted."

# Install Certbot
apt install -y certbot python3-certbot-nginx

# Obtain SSL certificate (non-interactive)
echo "Setting up SSL with Let's Encrypt..."
certbot --nginx -d "$url" -d "www.$url" \
    --non-interactive \
    --agree-tos \
    --email admin@"$url" \
    --redirect || {
    echo "⚠️ Certbot failed. Maybe this domain already has a cert, or DNS isn't ready."
    echo "You can run certbot manually later."
}

# Final message
cat << EOF

✅ LEMP Stack Setup Complete!

Your site is ready at:
👉 https://$url
👉 https://www.$url

Next steps:
1. Deploy your Laravel app to /var/www/html/current/
2. Run:
   cd /var/www/html/current
   composer install
   cp .env.example .env
   php artisan key:generate
   php artisan config:cache
   php artisan migrate --seed

3. Set file permissions:
   sudo chown -R www-data:www-data storage bootstrap/cache
   sudo chmod -R 775 storage bootstrap/cache

Happy Selling! 🚀
EOF
