# FIIT_WTECH2025

# 🛒 E-Shop | Web Semestral Task  

Welcome to our **Web Semestral Task project!** This repository contains the source code for our **E-Shop**, a simple yet functional online store where users can browse watches, add them to their cart, and complete purchases.

## 📌 Project Overview  
The goal of this project is to develop a fully functional e-commerce web application as part of our semester coursework. The e-shop will allow users to:
- Browse a catalog of watches with detailed descriptions and images
- Add watches to their cart and manage the cart contents
- Create an account, log in, and manage their profile
- Simulate completing purchases

## 🛠️ Tech Stack  
Our e-shop is built using the following technologies:
- **Frontend:** HTML, CSS, JavaScript  
- **Backend:** PHP, Laravel  
- **Database:** PostgreSQL

## 🚀 Contributors
Tomáš Majerčík <br>
Zdenko Kanoš


# Setting Up the Laravel Project
## Requirements

Make sure you have the following installed:

- PHP
- Composer
- Node.js and npm
- A local database (PostgreSQL)

## 1. Clone the Repository
```bash
git clone https://github.com/tomasmajercik/FIIT_WTECH2025.git
cd FIIT_WTECH2025/laravel/chronoLux/
```

## 2. Install PHP dependencies
```bash
composer install
```
NOTE: vendor/ directory is excluded via .gitignore, so dependencies must be installed locally

## 3. Install Frontend Dependencies
```bash
npm install
```
NOTE: This installs dependencies found in package.json. The node_modules/ folder is also ignored by Git

## 4. Environment Configuration
Copy the example environment file and create your own `.env`
```bash
cp .env.example .env
```
Edit `.env` with your preferred settings

## 5. Generate aplication key
```bash
php artisan key:generate
```

## 6. Migrate and seed the database
```bash
php artisan migrate --seed
```

## 7. Link storage (for uploaded files)
```bash
php artisan storage:link
```

## 8. Serve the app
```bash
php artisan serve
```