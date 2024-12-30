

## Task Management API (Laravel)
This project is a backend Task Management API developed using Laravel and MySQL. The API allows users to register, authenticate, create, update, view, and delete tasks, with support for Role-Based Access Control (RBAC) and task completion management.

# Table of Contents
Features
Requirements
Installation
Usage

User Authentication: Users can register, log in, and log out using Laravel's built-in authentication system.
Task CRUD Operations: Users can create, read, update, and delete tasks.
Task Completion: Users can mark tasks as completed or uncompleted.
Role-Based Access Control (RBAC): Admin users can view all tasks, while regular users can only view and manage their own tasks.
Task Search and Filtering: Tasks can be searched and filtered based on completion status (completed or pending).
User Profile: Users can view and update their profile information.
Requirements
Make sure you have the following software installed:

PHP (version 8.0 or above)
Composer (for managing PHP dependencies)
MySQL (or MariaDB for database management)
Laravel (10.48.25)

Installation
Follow the steps below to set up this project on your local machine:

1. Clone the Repository
Clone the repository using Git:
git clone https://github.com/rkiran2505/new_task_management.git
cd new_task_management
2. Install Dependencies
composer install
3. Set Up Environment Variables
cp .env.example .env
Edit the .env file and configure your database settings:

env
Copy code
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management
DB_USERNAME=root
DB_PASSWORD=

4. Generate the Application Key
php artisan key:generate
5. Run Migrations

php artisan migrate
php artisan db:seed
6. Start the Development Server
php artisan serve

