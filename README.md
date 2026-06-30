
## About Shopingo - Laravel E-Commerce Project

A modern Laravel-based e-commerce application with a powerful admin panel.  
Built with **Laravel 12** and **PHP 8.4**, this project uses **jQuery**, **Bootstrap**, and **FontAwesome** to provide a clean and responsive UI for both the admin and customer sides.


## 🚀 Features

- Admin Panel with full management access
- Clean UI using Bootstrap 5 and FontAwesome icons
- Dynamic behaviors powered by jQuery
- Product category management
- Secure and extendable Laravel architecture
- RTL-friendly layout for Persian/Arabic support

## 🛠️ Technologies Used

- [Laravel 12](https://laravel.com/)
- PHP 8.4+
- jQuery
- Bootstrap 5
- FontAwesome 6
- MySQL (or any Laravel-supported database)
- SweetAlert
- ToastAlert
- CKEditor

### 📦 Installation & Setup

> Make sure you have PHP 8.4+, Composer, and a database (like MariaDB OR MySQL) ready.
> Make sure you Own an API From kavenegar.com For OTP Logins
> Make sure you Have an Email Set in .env

### 1. Clone the repository

```shell
git clone https://github.com/MrVH-IR/Shopingo.git
cd Shopingo
```

## Install dependencies
```shell
composer install
cp .env.example .env
```

## Then edit .env and set your database credentials
```shell
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
APP_KAVENEGAR_API=your_kavenegar_api
MAIL_MAILER=
MAIL_SCHEME=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_FROM_ADDRESS=
```

## Laravel Commands
```shell
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan serve
```

### Docker WalkThrough
```shell
curl -fsSL https://get.docker.com | sudo sh

sudo systemctl start docker
sudo systemctl enable docker

sudo usermod -aG docker $USER
newgrp docker
docker --version

cp -r shopingo ./app

docker-compose up -d --build

docker exec -it laravel_app bash
```
