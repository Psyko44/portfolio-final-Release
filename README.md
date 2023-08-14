# Symfony 6 Project Template

Welcome to your Symfony 6 project! This template provides a basic structure to get you started with Symfony 6 development.

## Prerequisites

- PHP 8.2
- Composer
- Symfony CLI
- Web Server (e.g., Apache, Nginx)
- Database Server (e.g., MySQL, PostgreSQL)

## Getting Started

1. Clone this repository to your local machine:

   ```bash
   git clone https://github.com/Psyko-44/portfolio-final-Release.git


2. Navigate to the project directory:
    ```bash

    cd symfony6-project

3. Install dependencies using Composer:

    ```bash

    composer install

4. Configure your environment variables:
Copy the .env.example file to .env and set your database credentials and other configuration.
Create the database and schema:
    ```bash

    php bin/console doctrine:database:create
    php bin/console doctrine:schema:create


5. Start the Symfony development server:
    ```bash

    symfony server:start
6. Access the application in your browser:
    ```bash
  
    http://localhost:8000
