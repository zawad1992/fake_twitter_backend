## Setting Up and Running the `fake_twitter_backend` Project

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
   - Clone the project repository to your local machine using the command:
     ```bash
     git clone https://github.com/zawad1992/fake_twitter_backend.git
     ```

2. **Install Dependencies:**
   - Navigate to the `engine` directory of the project:
     ```bash
     cd engine
     ```
   - Run `composer install` to install all the necessary dependencies, including the PHP MongoDB extension.

3. **Environment Configuration:**
   - Copy the `.env.example` file to a new file named `.env`.
   - Modify the `.env` file to set up your database and other environment variables.
   - Ensure you have MongoDB installed and configured, as it's required for the project.

4. **Generate Application Key:**
   - Run `php artisan key:generate` to generate a new application key. This will be automatically added to your `.env` file.

5. **Running the Project:**
   - To start the Laravel project, navigate to the `engine` directory and run `php artisan serve`.
   - The application will be served at `http://localhost:8000` by default.
   - If running the project with XAMPP or LARAGON, clone this repository inside the project directory (e.g., `htdocs`, `www`).

6. **Using Postman Collection:**
   - Please download and import `FakeTwitter.postman_collection.json` located in the root directory of this repository.
   - For instructions on using the Postman collection, visit [this guide](https://github.com/zawad1992/fake_twitter_backend/blob/master/POSTMAN.md).


### Running the Project

- After installing all dependencies, navigate to the `engine` directory of the project.
- Run the command `php artisan serve` to start the Laravel server.
- By default, the application will be available at `http://localhost:8000`.
- For users who prefer to run the project using XAMPP or LARAGON:
    - Clone this repository into the respective project directory (e.g., `htdocs` for XAMPP, `www` for LARAGON).
    - Ensure the server is pointed to the `public` directory within the `en

Ensure that MongoDB is running in the background before you start the Laravel application.

## Using the Postman Collection

To test and interact with the API endpoints, please download and import the `FakeTwitter.postman_collection.json` file, which is located in the root directory of this repository.

For detailed instructions on how to use the Postman collection, including setting up environment variables and executing requests, refer to the following guide:
[Postman Collection Usage Guide](https://github.com/zawad1992/fake_twitter_backend/blob/master/POSTMAN.md)

This guide provides step-by-step instructions to effectively utilize the Postman collection for testing the API endpoints of the Fake Twitter project.
