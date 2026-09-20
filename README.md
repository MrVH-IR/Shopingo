## About Shopingo - Laravel E-Commerce Project

A modern Laravel-based e-commerce application with a powerful admin panel.  
Built with **Laravel 12** and **PHP 8.4**, this project uses **jQuery**, **Bootstrap**, and **FontAwesome** to provide a clean and responsive UI for both the admin and customer sides.

## 🚀 Features

- Admin Panel with full management access
- Clean UI using Bootstrap 5 and FontAwesome icons
- Dynamic behaviors powered by jQuery
- Product category management
- Secure and extendable Laravel architecture
- RTL-friendly layout for Persian support

## 🛠️ Technologies Used

- [Laravel 13](https://laravel.com/)
- PHP 8.4+
- jQuery
- Bootstrap 5
- FontAwesome 6
- MariaDB 12+ Is Default (Use Other DBs With Caution)
- SweetAlert
- ToastAlert
- CKEditor
- Default Payment Gateway (Zarinpal)
- Default SMS Login Gateway (Kavenegar)

### 📦 Installation & Setup

> Make sure you have PHP 8.4+, Composer, and a database (like MariaDB OR MySQL) ready.
> Make sure you Own an API From kavenegar.com For OTP Logins
> Make sure you Have an Email Set in .env

### 1. Clone the repository

```shell
git clone https://github.com/MrVH-IR/Shopingo.git
cd Shopingo
```

##

Change The timezone if you are not Inside Iran

```php
    'timezone' => 'Asia/Tehran',
```

## Install dependencies

```shell
composer install
cp .env.example .env
```

## Then edit .env and set your database credentials

```shell
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=shopingo
DB_USERNAME=admin
DB_PASSWORD=secret
APP_KAVENEGAR_API=
APP_KAVENEGAR_NUMBER=
APP_KAVENEGAR_NUMBER_2=
ZARINPAL_MERCHANT_ID=
ZARINPAL_SANDBOX=false
TURNSTILE_KEY=
TURNSTILE_SECRET=
MINIO_REGION=default
MINIO_SECRET=some-long-string
MINIO_KEY=
MINIO_ENDPOINT=
MINIO_USE_PATH_STYLE_ENDPOINT=
MINIO_REPORT=
MINIO_BUCKET=shopingo
MINIO_THROW_EXCEPTION=
MAIL_MAILER=
MAIL_SCHEME=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_FROM_ADDRESS=
REDIS_CLIENT=phpredis
REDIS_HOST=
REDIS_PASSWORD=
REDIS_PORT=
REDIS_PREFIX=shopingo_redis_db
```

## Laravel Commands

```shell
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan serve
```

# Docker Installation

## Install Docker

```bash
curl -fsSL https://get.docker.com | sudo sh

sudo systemctl enable docker
sudo systemctl start docker

sudo usermod -aG docker $USER
newgrp docker

docker --version
docker compose version
```

---

## Build Containers

```bash
docker compose up -d --build
```

---

## Enter PHP Container

```bash
docker exec -it shopingo_laravel bash
```

---

## Install Dependencies

```bash
composer install
```

---

## Laravel

```bash
cp .env.example .env

php artisan key:generate

php artisan migrate

php artisan storage:link
```

---

## Permission

```bash
chown -R www-data:www-data storage bootstrap/cache

chmod -R 775 storage bootstrap/cache
```

---

## Run

```
http://localhost:8080
```

# Laravel Nginx Configuration

This File is for running this application on Ubuntu/Debian PHP-FPM

---

## Requirements

- Nginx
- PHP 8.4 FPM
- Composer
- Laravel
- Cloudflare Account
- MinIO
- Redis
- MariaDB
- Zarinpal Account
- Kavenegar Account
---

## Server Requirements #BestPractice(Depends On RPS)

- 16 GB Ram
- 8 Core CPU
- 100 GB SSD

## Project Structure

If project exists here:

```text
/var/www/html/current
```

and `/public/index.php` is here:

```text
/var/www/html/current/public
```

---

## Install Configuration

Copy File

```bash
sudo cp nginx_nodocker.conf /etc/nginx/sites-available/shopingo
```

Create Symlink:

```bash
sudo ln -s /etc/nginx/sites-available/nginx_nodocker.conf \
/etc/nginx/sites-enabled/
```

Check settings

```bash
sudo nginx -t
```

Reload:

```bash
sudo systemctl reload nginx
```

---

## PHP-FPM

Ensure PHP-FPM is running

```bash
sudo systemctl status php8.4-fpm
```

Restart if down

```bash
sudo systemctl restart php8.4-fpm
```

---

## Laravel Permissions

```bash
sudo chown -R www-data:www-data storage bootstrap/cache

sudo chmod -R 775 storage bootstrap/cache
```

---

## Laravel Commands

```bash
composer install

cp .env.example .env

php artisan key:generate

php artisan migrate

php artisan storage:link
```

---

## Verify Configuration

```bash
sudo nginx -t
```

If you saw this STD-Output

```
syntax is ok
test is successful
```

Configuration is correct.

---

## Notes

- `root` Must Go to `public` Laravel Applications root are public/index.php.
- Change `fastcgi_pass` if you are using a different PHP version
- In any changes to Nginx configuration , Re-run this command:

```bash
sudo systemctl reload nginx
```

### Add Most Visited URI Here
```text
public/sitemap.xml
```
