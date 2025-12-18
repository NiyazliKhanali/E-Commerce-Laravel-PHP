Car Sales Platform (Laravel)

A web-based car sales platform built with Laravel, allowing users to browse available vehicles and purchase them directly from a company. The system focuses on a fixed-price purchasing model — there is no auction or bidding functionality.

This project was developed as a portfolio project to demonstrate backend development, authentication, CRUD operations, and basic e-commerce logic using Laravel.

Features

User authentication (register, login, logout)

Browse available cars

View detailed car information

Fixed-price vehicle purchasing

Admin/company-side car management

Car categorization (brand, model, year, etc.)

Saving Liked Cars for registered users

Responsive UI

Tech Stack

Backend: Laravel

Frontend: Blade Templates, HTML, CSS, Tailwind (if applicable)

Database: MySQL

Authentication: Laravel Auth

Version Control: Git & GitHub

Project Purpose

This project simulates a company-owned car sales website, where:

All cars are listed by the company

Prices are fixed

Users purchase cars directly

No user-to-user interaction

No bidding or auction system

Installation & Setup
Prerequisites

PHP 8.x

Composer

MySQL

Node.js & npm (optional, if frontend assets are used)

Steps

Clone the repository

git clone https://github.com/your-username/your-repo-name.git
cd your-repo-name


Install PHP dependencies

composer install


Create environment file

cp .env.example .env


Generate application key

php artisan key:generate


Configure database
Update .env with your database credentials:

DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password


Run migrations

php artisan migrate


(Optional) Install frontend dependencies

npm install
npm run dev


Start the server

php artisan serve

Folder Structure (Simplified)
app/            → Application logic
routes/         → Web routes
resources/      → Blade views & assets
database/       → Migrations & seeders
public/         → Public assets

Future Improvements

Payment gateway integration

Order history for users

Admin dashboard analytics

Car availability & stock tracking

Image upload optimization

Disclaimer

This project is built for educational and portfolio purposes.
It does not represent a real commercial car dealership.

Author

Khanali Niyazli
Computer Engineering Student
GitHub: https://github.com/NiyazliKhanali

If you want:

a shorter README

a more technical README

or one tailored for recruiters