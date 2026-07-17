# Windows Setup

## Requirements

- PHP 8.2 or newer
- Composer 2
- PHP extensions normally required by Laravel, including OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath, Fileinfo, and SQLite or MySQL PDO

## Run with SQLite

```bat
cd path\to\ascent-laravel12-php82-no-npm
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Open `http://127.0.0.1:8000` and `http://127.0.0.1:8000/admin`.

## Run with MySQL

Create a database named `ascent_website`, copy `.env.example` to `.env`, and update:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ascent_website
DB_USERNAME=root
DB_PASSWORD=
```

Then run:

```bat
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Change the default admin credentials in `.env` before deployment.
