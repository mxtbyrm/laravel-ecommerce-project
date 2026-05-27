# Laravel Shop

A simple e-commerce web application built with **Laravel**, **Bootstrap 5**, and **PostgreSQL**.

## Features

- Product catalog with search and pagination
- Product detail pages
- Session-based shopping cart (add / update / remove)
- User registration and login
- Checkout that places an order (mock payment — no real charge) and decrements stock
- Customer order history
- Admin panel for product management (create / edit / delete)

## Tech stack

| Layer    | Choice                          |
|----------|---------------------------------|
| Backend  | Laravel (PHP 8.5)               |
| Frontend | Blade templates + Bootstrap 5   |
| Database | PostgreSQL 17 (via Docker)      |

## Requirements

- PHP 8.2+ with the `pdo_pgsql` extension
- Composer
- Docker (for the PostgreSQL container)

## Getting started

1. **Install PHP dependencies**

   ```bash
   composer install
   ```

2. **Start PostgreSQL**

   ```bash
   docker compose up -d
   ```

   This runs Postgres on host port **5433** with database `laravel_shop`
   (user `laravel`, password `secret`).

3. **Configure the environment**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   The default `.env` is already pointed at the Docker database.

4. **Run migrations and seed sample data**

   ```bash
   php artisan migrate --seed
   ```

5. **Start the dev server**

   ```bash
   php artisan serve
   ```

   Visit <http://127.0.0.1:8000>.

## Demo accounts

The seeder creates two users (password `password` for both):

| Role     | Email                  |
|----------|------------------------|
| Admin    | `admin@example.com`    |
| Customer | `customer@example.com` |

Log in as the admin to access the **Admin** menu and manage products.

## Project structure

- `app/Models` — `Product`, `Order`, `OrderItem`, `User`
- `app/Services/Cart.php` — session-based cart logic
- `app/Http/Controllers` — storefront, cart, checkout, orders
- `app/Http/Controllers/Admin` — admin product CRUD
- `resources/views` — Bootstrap Blade templates
- `database/migrations` & `database/seeders` — schema and sample data
