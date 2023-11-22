## Setting Up and Running the Laravel Project

### Prerequisites

Before you begin, ensure you have the following installed:
- PHP 8.1.*
- Composer
- MongoDB
- PHP MongoDB extension

### Installing PHP Extensions

1. **MongoDB Extension for PHP:**
   - Install the MongoDB PHP extension to enable interaction with MongoDB. 
   - For installation, use the command: `pecl install mongodb`
   - Don't forget to add `extension=mongodb.so` to your `php.ini` file.

### Setting Up the Project

1. **Clone the Repository:**
   - Clone the project repository to your local machine.

2. **Install Dependencies:**
   - Navigate to the `engine` directory of the project.
   - Run `composer install` to install all the necessary dependencies.

3. **Environment Configuration:**
   - Copy the `.env.example` file to a new file named `.env`.
   - Modify the `.env` file to set up your database and other environment variables.

4. **Generate Application Key:**
   - Run `php artisan key:generate` to generate a new application key. This will be added to your `.env` file.

### Running the Project

- To start the Laravel project, run `php artisan serve` from the root directory.
- The application will be served at `http://localhost:8000` by default.

Ensure that MongoDB is running in the background before you start the Laravel application.
