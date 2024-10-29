<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions">
        <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
    </a>
</p>

## Laravel Project

This is a Laravel project designed to [describe the purpose of your project, e.g., manage a system, provide an API, etc.]. It is built on the Laravel framework and includes essential CRUD operations, authentication, and other functionalities to support [the project's specific goal].

## Requirements

- **PHP:** >= 8.0
- **Composer:** >= 2.0
- **Node.js:** >= 12.x (for Laravel Mix)
- **Database:** MySQL or any other database supported by Laravel

## Getting Started

Follow these steps to set up the project locally:

1. **Clone the repository**
   ```bash
   git clone https://github.com/minhdat204/hackathon.git
   cd hackathon
2. **Install dependencies**
   ```bash
   composer install
3. **Copy the .env file Create a copy of the .env.example file and rename it to .env:**
    ```bash
   cp .env.example .env
4. **Generate application key**
    ```bash
   php artisan key:generate
5. **Run migrations Create the database tables by running migrations:**
    ```bash
    php artisan migrate
    php artisan db:seed
6. **Install Node.js dependencies (optional)**
    ```bash
    npm install
    npm run dev
7. **Serve the application Start the Laravel development server:**
    ```bash
    php artisan serve
Then, visit http://localhost:8000 to view the application.

