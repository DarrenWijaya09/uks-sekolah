# UKS School Health Management System

A modern Laravel-based web application for managing school health services through the Unit Kesehatan Sekolah (UKS). This project provides a centralized platform for schools to manage student health data, medication administration, consultations, schedules, and health-related reporting in a structured and role-based workflow.

## Project Description

This system is designed to support both administrators and regular users in handling school health operations efficiently. It helps schools keep track of student health history, manage medicine stock, record medication usage, organize UKS schedules, and provide health education and warning information to users.

## Main Features

- Role-based access for administrators and users
- Student data management
- Health history and medical record tracking
- Medicine inventory management
- Medication usage history and reporting
- Staff management for UKS personnel
- Health consultation and follow-up tracking
- Health education content management
- UKS schedule management with calendar-style views
- Early warning and health reminder features
- Dashboard overview for quick monitoring

## Technologies Used

- PHP 8.2
- Laravel 12
- Laravel Breeze
- Tailwind CSS
- Vite
- Composer
- NPM
- SQLite/MySQL-compatible database support

## Installation Guide

1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd UKS-sekolah
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install frontend dependencies:
   ```bash
   npm install
   ```

4. Copy the environment file and configure it:
   ```bash
   copy .env.example .env
   ```

5. Generate the application key:
   ```bash
   php artisan key:generate
   ```

## Environment Setup

Update your .env file with the appropriate application and database settings.

### Using SQLite (default configuration)

```env
DB_CONNECTION=sqlite
```

Create the SQLite database file if needed:

```bash
touch database/database.sqlite
```

### Using MySQL

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=uks_sekolah
DB_USERNAME=root
DB_PASSWORD=
```

## Database Migration

Run the migrations and seed the database:

```bash
php artisan migrate --seed
```

If you prefer to run them separately:

```bash
php artisan migrate
php artisan db:seed
```

## Running the Application

Start the backend server:

```bash
php artisan serve
```

Start the frontend build pipeline in another terminal:

```bash
npm run dev
```

The application will be available at http://localhost:8000 by default.

## Screenshots

Screenshots will be added soon. You can update this section with dashboard and module screenshots once the application is running locally.

## Demo Account

A default seeded demo user is available for testing:

- Email: test@example.com
- Password: password
- Role: user

## Folder Structure

```text
app/
  Http/Controllers/
  Http/Middleware/
  Models/
  Providers/
config/
database/
  factories/
  migrations/
  seeders/
public/
resources/
  css/
  js/
  views/
routes/
storage/
tests/
```

## Author

Developed by Darren for school health service management purposes.
