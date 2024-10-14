# Project Management System

A Project Management System built using Laravel that allows users to manage projects and tasks efficiently. This system includes features such as task creation, project management, priority labeling, status updates, AJAX filtering, and more.

## Features
- Create, edit, and delete tasks.
- Drag-and-drop tasks for easy management.
- Filter tasks by projects using AJAX without reloading the page.
- Priority labels for tasks: High, Medium, Low.
- Task statuses: Not Started, Pending, Ongoing, Completed.

## Prerequisites

Before you begin, ensure you have met the following requirements:
- PHP 8.0 or higher
- Composer
- MySQL or any other compatible database
- Git
- Node.js & npm

## Installation

### 1. Clone the repository

Use Git to clone the repository to your local machine:


git clone https://github.com/your-username/task-manager.git
cd task-manager

### 2. Install dependencies
Backend (Laravel)
First, install the PHP dependencies using Composer:

composer install

Frontend
Next, install the JavaScript dependencies using npm:

### 3. Environment setup
- Copy the .env.example file to create your .env file:
cp .env.example .env

- Generate the application key:
php artisan key:generate

### 4. Set up your database
Open the .env file and update the following lines to configure your database connection:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

- Create a new MySQL database matching the name in your .env file.

- Run the following command to migrate the database tables:
php artisan migrate

### 5. Build the frontend assets
After the installation, compile the frontend assets using Laravel Mix:

npm run dev
To compile for production:

npm run prod
### 6. Serve the application
Start the local development server:
php artisan serve

Your application should now be running at http://127.0.0.1:8000.
