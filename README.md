# TaskFlow Laravel

Modern Project Management System built with Laravel 13.

## Features

- Authentication
- Dashboard Analytics
- Project CRUD
- Task Management
- Role Authorization
- File Upload
- Search & Filter
- Pagination
- Responsive UI

## Tech Stack

- Laravel 13
- PHP 8.3
- MySQL
- Tailwind CSS
- Blade

## Screenshots

### Dashboard

![Dashboard](screenshots/dashboard.png)

### Projects

![Projects](screenshots/projects.png)

### Tasks

![Tasks](screenshots/tasks.png)

## Installation

Clone repository:

```bash
git clone https://github.com/nathapradja/taskflow-laravel.git
```

Install dependency:

```bash
composer install
```

Copy environment:

```bash
cp .env.example .env
```

Generate app key:

```bash
php artisan key:generate
```

Run migration:

```bash
php artisan migrate
```

Run storage link:

```bash
php artisan storage:link
```

Start local server:

```bash
php artisan serve
```

## Author

Nathapradja