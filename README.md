[![PHP Composer](https://github.com/bojesav/E-comerce_Laravel/actions/workflows/php.yml/badge.svg)](https://github.com/bojesav/E-comerce_Laravel/actions/workflows/php.yml)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-4E56A6?style=for-the-badge&logo=livewire&logoColor=white)
![Filament](https://img.shields.io/badge/Filament-4E56A6?style=for-the-badge&logo=filament&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-003B57?style=for-the-badge&logo=sqlite&logoColor=white)
![Node.js](https://img.shields.io/badge/Node.js-339933?style=for-the-badge&logo=node-dot-js&logoColor=white)
# Project Overview

Welcome to the E-commerce  project! This project is designed to provide a robust and scalable e-commerce platform. Below you'll find instructions on how to set up and run the project.

## Table of Contents

- [Project Overview](#project-overview)
- [How to Run the Project](#how-to-run-the-project)
- [Features](#features)
- [Technologies Used](#technologies-used)

## Features

- User authentication and authorization
- Product management
- Shopping cart and checkout process
- Order management
- Responsive design

## Technologies Used

- **Frontend:** Tailwind CSS
- **Backend:** Laravel, Livewire, Filament, Sqlite
- **Other:** Node.js



# How to Run the Project

Follow these steps to set up and run the project:

1.  **Install dependencies:**
    ```sh
    composer install
    ```
2. **Install dependencies:**
    ```sh
    npm install
    ```

3. **Set up environment variables:**
    Create a `.env` file in the root directory and add the necessary environment variables. Refer to `.env.example` for the required variables.

4. **Run the development server:**
    ```sh
    npm start
    ```

5. **Build for production:**
    ```sh
    npm run build
    ```

6. **Run tests:**
    ```sh
    npm test
    ```



7. **Set up Laravel configuration:**

    - **Copy `.env.example` to `.env`:**
    
        ```sh
        cp .env.example .env
        ```

    - **Generate an application key:**
        ```sh
        php artisan key:generate
        ```

    - **Run the migrations:**
        ```sh
            php artisan migrate
        ```

     - **Serve the application:**
     
        ```sh
             php artisan serve
          ```

         ```sh
             npm run dev
          ```

    

**Adding admin run this command**

        php artisan make:filament-user
