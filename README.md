<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

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

### 📦 Installation & Setup

> Make sure you have PHP 8.4+, Composer, and a database (like MySQL) ready.

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
```

## Laravel Commands
```shell
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```
