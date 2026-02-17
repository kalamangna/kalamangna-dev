# Project Management System

A clean, modern, and production-ready Project Management System designed for single administrators. Built with **CodeIgniter 4** and **Tailwind CSS**.

## Features

- **Simple Authentication**: Secure admin login with session protection.
- **Client Management**: Full CRUD for managing client companies, contacts, and Indonesian regional locations (API integrated).
- **Project Tracking**: Manage projects with status tracking (Planning, On Progress, Completed).
- **Modern Dashboard**: Real-time statistics and recent activities overview.
- **Indonesian Region API**: Integrated with official province and city data.
- **Responsive UI**: Fully responsive sidebar layout using Tailwind CSS.
- **Soft Deletes**: Safety first data management.

## Tech Stack

- **Framework**: CodeIgniter 4.7.0
- **Styling**: Tailwind CSS v3
- **Icons**: Font Awesome 6
- **Database**: MySQL/MariaDB
- **API**: emsifa Indonesian Region API

## Getting Started

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & NPM (for CSS build)
- MySQL Server

### Installation

1. Clone the repository
2. Install PHP dependencies:
   ```bash
   composer install
   ```
3. Install NPM dependencies:
   ```bash
   npm install
   ```
4. Copy `env` to `.env` and configure your database:
   ```bash
   cp env .env
   ```
5. Run Migrations:
   ```bash
   php spark migrate
   ```
6. Seed the Admin account:
   ```bash
   php spark db:seed AdminSeeder
   ```

### Default Credentials

- **Email**: `abed@gmail.com`
- **Password**: `abed123`

### Development

Build and watch CSS changes:

```bash
npm run dev
```

Production CSS build:

```bash
npm run build
```

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).
