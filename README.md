# laravel-test-project

## Backend Usage

Use PHP >= 8.0 for this application

First enable gd extension in XAMPP, WAMP etc

Then clone this repository

    cd laravel-test-project

Then install a compiler

    composer install
    
Then create and configure .env

    cp .env.example .env
    
   Then create app key

    php artisan key:generate

   Then Set the database name to .ENV


Compiling Assets (Mix)

    npm install

 and

    npm run dev

Then running migrations

    php artisan migrate  --seed
    

Then start the server

    php artisan serve

Login now

App password : password

User Name

    * Admin Role   
                    admin_1
                    admin_2

    * Student Role 
                    distributor_1
                    .
                        to
                    .
                    distributor_5
    
## Security Vulnerabilities

If you discover a security vulnerability within this app, please send an e-mail to Shashika Nuwan via [Shashika Nuwan](mailto:kumararanaweera1999@gmail.com). All security vulnerabilities will be promptly addressed.
