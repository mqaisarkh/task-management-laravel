# Task Management App

A simple task management application built with Laravel.

## Requirements

- PHP 8.2 or higher
- Composer
- MySQL 5.7 or higher

## Setup

1. Clone the repository.
2. Install PHP dependencies:

   ```bash
   composer install
   ```

3. Create the environment file:

   ```bash
   cp .env.example .env
   ```

4. Create a MySQL database:

   ```sql
   CREATE DATABASE task_management_laravel
       CHARACTER SET utf8mb4
       COLLATE utf8mb4_unicode_ci;
   ```

5. Add your MySQL credentials to `.env`:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=task_management_laravel
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. Generate the application key:

   ```bash
   php artisan key:generate
   ```

7. Create the database tables:

   ```bash
   php artisan migrate
   ```

8. Start the development server:

   ```bash
   php artisan serve
   ```

## Unit Tests

Run the Unit test suite with:

```bash
php artisan test --testsuite=Unit
```

## Assumptions

- MySQL is used as the default database.
- The default local database name is `task_management_laravel`.
- The application is developed and committed in small, reviewable stages.
- New tasks use `pending` as their default status.

## Task Structure

Each task contains:

- A required title
- An optional description
- A `pending` or `completed` status
- An optional due date

## Features

- Create, view, edit, and delete tasks
- Mark pending tasks as completed
- Filter tasks by pending or completed status
- Search tasks by title
- Combine title search with status filters
- Validate task forms and display field-level errors
- Highlight overdue pending tasks
- Responsive Bootstrap interface with a reusable Blade layout
