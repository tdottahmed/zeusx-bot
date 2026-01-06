# Zeusx-web_automation

This automation will act like a expert bot for creating offers and manages offers. There is an admin panel for managing offer templates and all other staffs.

## Technology Stack

- **Backend**: Laravel
- **Automation**: Node.js (Playwright)
- **Frontend**: Laravel Blade & Tailwind CSS

## Getting Started

### Prerequisites

- PHP 8.2+
- Composer
- Node.js & NPM

### Installation

1. Install PHP dependencies:
   ```bash
   composer install
   ```

2. Install Node.js dependencies:
   ```bash
   npm install
   ```

3. Setup environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Serve the application:
   ```bash
   php artisan serve
   ```

5. Build frontend assets (for Tailwind CSS):
   ```bash
   npm run dev
   ```

## Usage

### Admin Panel
Access the admin panel at `http://localhost:8000/admin`. From here you can trigger the automation script.

### CLI Automation
You can also run the automation directly via the command line:

```bash
php artisan automation:run
```
