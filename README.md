# Laravel CRM Project

This is a Laravel-based CRM (Customer Relationship Management) application with various features for user management, authentication & authorization, and support for different user roles such as Company, Freelancer, Employee, etc.

## Project Structure

The project has the following key packages installed:

-   [Guzzle HTTP](https://docs.guzzlephp.org/en/stable/): A PHP HTTP client for making API requests.
-   [Laravel Sanctum](https://laravel.com/docs/8.x/sanctum): A lightweight API authentication package.
-   [Laravel Tinker](https://laravel.com/docs/8.x/tinker): Powerful REPL (Read-Eval-Print Loop) for interacting with your Laravel application.
-   [Nwidart Laravel Modules](https://nwidart.com/laravel-modules/): Organize your Laravel app into modules.
-   [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission/v4): Role and permission management for Laravel.

## Getting Started

### Prerequisites

1. Docker
2. Composer
3. PHP

### Installation

1. **Clone the repository:**

    ```bash
    git clone <repository-url>
    ```

    Replace `<repository-url>` with the actual URL of your Git repository.

2. **Navigate to the project directory:**

    ```bash
    cd laravel-crm
    ```

3. **Copy the `.env.example` file to `.env`:**

    ```bash
    cp .env.example .env
    ```

4. **Generate the application key:**

    ```bash
    php artisan key:generate
    ```

5. **Start the Docker containers:**

    ```bash
    docker-compose up -d
    ```

6. **Install dependencies and migrate the database:**

    ```bash
    docker ps (to fetch the container id)
    docker exec -it <container-id> bash
    composer install
    php artisan migrate
    ```

7. **Open your browser and visit [http://localhost:8000](http://0.0.0.0:8000).**

# Features

1. **CRM App**: A comprehensive CRM application.
2. **User Management**: Manage users with different roles.
3. **Authentication & Authorization**: Utilizes Laravel Sanctum and Spatie for secure authentication and authorization.
   Company, Freelancer, Employee, etc.: Support for different user roles.
4. **Task Management**: Manage CRUD and Assignment of Tasks

# Contributing

Feel free to contribute to this project by creating issues or submitting pull requests. Follow the Contributing Guidelines.

# License

This project is open-source and available under the MIT License.
