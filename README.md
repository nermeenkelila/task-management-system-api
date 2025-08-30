<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Task Management System API

A Laravel RESTful API for a Task Management System running in a Docker containerized environment.

## Features

- Authentication.
- Authorizations.
- Create a new task.
- Retrieve a list of all tasks, and allow filtering based on status, due
date range, or assigned user.
- Add task dependencies with other tasks. A task cannot be
completed until all its dependencies are completed.
- Retrieve details of a specific task including dependencies.
- Update the details of a task
- Dockerized development environment
- Pre-configured services (Nginx, PHP, MySQL, phpmyadmin.)

## Prerequisites
- Docker Desktop (for Windows/Mac) or Docker Engine (for Linux)

## Application Installation Document

|#|          Laravel              |         Commands            |          Notes              |
|-|-------------------------------|-----------------------------|-----------------------------|
|1|Clone the Project|||
|2|Copy Environment File|`cp .env.example .env`| Fill it with data database credentials|
|3|Start Docker Containers|`docker compose up -d`||
|4|Generate Application Key|`docker compose exec app php artisan key:generate`||
|5|Run Database Migrations|`docker compose exec app php artisan migrate`||
|6|Seed the Database|`docker compose exec app php artisan db:seed`||
|7|Clear Laravel caches|`docker compose exec app php artisan optimize` `docker compose exec app php artisan config:clear` `docker compose exec app php artisan cache:clear`||
|8| View application logs |`docker compose logs app`||

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
