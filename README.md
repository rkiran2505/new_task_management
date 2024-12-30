# Task Management API 
This is a backend Task Management API developed using Laravel and MySQL. The API allows users to register, authenticate, create, update, view, and delete tasks, with support for Role-Based Access Control (RBAC) and task completion management.


# Features
## User Authentication: 
Register, log in, and log out using Laravel's built-in authentication.
Task 
## CRUD Operations: 
Create, read, update, and delete tasks.
## Task Completion:
 Mark tasks as completed or uncompleted.
#Role-Based Access Control (RBAC):
 Admins view all tasks; regular users manage only their own.
#Task Search and Filtering:
 Filter tasks by completion status.

# Requirements

PHP (8.0 or above).
Composer (for managing PHP dependencies).
MySQL (or MariaDB).
Laravel (latest stable version).

# Installation
1. Clone the Repository
git clone https://github.com/rkiran2505/new_task_management.git

2. Install Dependencies: composer install
3. Set Up Environment Variables: cp .env.example .env 
4. Generate the Application Key: php artisan key:generate
5. Run Migrations: php artisan migrate 
6. Start the Development Server: php artisan serve