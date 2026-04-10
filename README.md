# Electronic Store - MongoDB Integration

This project is an existing HTML/CSS Electronic Store seamlessly integrated with MongoDB using PHP. It features a complete authentication system and performs full CRUD (Create, Read, Update, Delete) operations.

## Features Implemented

- **Create**: Sign up pages securely insert user credentials (hashing passwords) into MongoDB.
- **Read**: Login functionality authenticates against stored MongoDB records, and a custom Dashboard displays a list of registered users.
- **Update**: Users can update their Profile (e.g., First Name, Last Name, Password) directly from the Dashboard.
- **Delete**: Users have the option to logically manage and delete their account from the Dashboard.
- **Validation & Flow**: Handles empty fields, mismatching passwords, invalid length, and prevents duplicate email registration.

## Technical Stack

- **Backend**: PHP >= 8.0
- **Database**: MongoDB Community Server version >= 5.0
- **Driver**: PHP MongoDB Driver via Composer (`jenssegers/mongodb` or raw `mongodb/mongodb`)

## Setup Instructions

1. **Install Prerequisites**: Ensure you have PHP, Composer, and the MongoDB Community Server running locally. Verify that the [MongoDB PHP Extension](https://www.php.net/manual/en/mongodb.installation.php) is active in your `php.ini`.
2. **Clone the Repository**:
   ```bash
   git clone <repository_url>
   cd <repository_name>
   ```
3. **Install Dependencies**:
   Run the following to pull the MongoDB PHP library:
   ```bash
   composer install
   ```
4. **Configuration**:
   Copy or create the `config.php` file inside the root with the following format:
   ```php
   <?php
   return [
       'MONGODB_URI' => 'mongodb://127.0.0.1:27017',
       'DB_NAME' => 'electronic_store'
   ];
   ```
5. **Run the Project**:
   If you have a local web server (like XAMPP or MAMP), place the project in your `htdocs` or equivalent path. Alternatively, start the built-in PHP server:
   ```bash
   php -S localhost:8000
   ```
   Navigate to `http://localhost:8000/index.html`.

## Demonstration
- Begin by exploring the interface, then hit `login` to authenticate or `register` for new credentials. 
- You will be guided to the Dashboard populated directly from MongoDB. Use the Dashboard to review CRUD operations!

_Please remember to capture your screenshots of the database operations (Using MongoDB Compass or Shell) to add them to this document before complete submission!_
