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
- `GET /api/blogs` → all blogs  
- `GET /api/blog/{id}` → blog details  
- **Authentication:** Laravel Sanctum (token-based)

---

## Requirements
- PHP >= 8.2.29, Laravel >= 11.x  
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
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
