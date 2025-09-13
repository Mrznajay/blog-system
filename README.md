# Blog Management System

A simple **Blog Management System** built with Laravel, featuring an **admin dashboard** and a **REST API** with Laravel Sanctum for authentication.  

---

## Features

**User Management**
- Admin login/logout  
- View, create, update, delete users  

**Blog Management**
- CRUD operations for blog posts  
- Pagination, view details, validations  

**API**
- `POST /api/login` → for login  
- `POST /api/logout` → for logout 
- `GET /api/blogs` → all blogs  
- `GET /api/blog/{id}` → blog details  
- **Authentication:** Laravel Sanctum (token-based)

---

## Requirements
- PHP >= 8.2, Laravel >= 10.x  
- MySQL
- Composer
- Node.js & npm (optinal) 

---

## Installation
```bash
git clone https://github.com/Mrznajay/blog-system.git
cd blog-system
composer install
npm install(optinal)
npm run build(optinal)
cp .env.example .env
php artisan config:cache
php artisan key:generate
php artisan migrate
php artisan db:seed --class=AdminUserTableSeeder
php artisan storage:link
php artisan serve

