Here is your improved **README.md**, fully in English, formatted as plain Markdown, without code fences, and ready to drop into a file:

---

# Laravel Sail — Template Project

## Requirements

* Composer
* Docker Desktop

## Startup Instructions

1. Clone the repository.
   Important: Do not clone this project on an external hard drive, as Docker Desktop cannot mount volumes from external devices on macOS.

   git clone [repo_name]

2. Move into the project directory.

   cd [project_name]

3. Install the PHP dependencies.

   composer install

4. Create the environment configuration file.

   cp .env.example .env

5. Start the Sail environment using Docker.

   ./vendor/bin/sail up -d

## Development Guide

Once the containers are running, you can access the test API endpoint to verify the system is working:

[http://localhost/api/test](http://localhost/api/test)

This endpoint returns the text:
“The backend is working correctly.” (in Spanish)

### Running Artisan Commands with Sail

Execute migrations:

./vendor/bin/sail artisan migrate

Run database seeders:

./vendor/bin/sail artisan db:seed

---

If you want, I can also help you add badges, a project structure section, Docker troubleshooting notes, or instructions for creating an alias for Sail.
