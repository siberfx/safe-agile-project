# Dashboard

A modern dashboard built with Laravel 12 and Vite.

## Features

-   **Laravel 12** - Modern PHP framework
-   **Vite** - Fast build tool
-   **Tailwind CSS 4** - Utility-first CSS framework
-   **Alpine.js** - Minimal JavaScript framework
-   **DataTables** - Advanced table management
-   **SweetAlert2** - Modern alert system

## Requirements

-   **PHP** >= 8.2
-   **Composer** >= 2.0
-   **Node.js** >= 18.0
-   **npm** >= 9.0
-   **MySQL/PostgreSQL** or **SQLite**

## Installation

### 1. Clone the project

```bash
git clone <repository-url>
cd panel
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install Node.js dependencies

```bash
npm install
```

### 4. Setup environment file

```bash
cp .env.example .env
```

Configure your database settings in `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=panel_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate application key

```bash
php artisan key:generate
```

### 6. Run database migrations

```bash
php artisan migrate
```

### 7. Build frontend assets

**For development:**

```bash
npm run dev
```

**For production:**

```bash
npm run build
```

### 8. Start the application

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`