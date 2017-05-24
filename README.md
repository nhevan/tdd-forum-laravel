<h2 align="center">A Forum Application Using Laravel and Test Suites</h2>

<p align="center">
<a href="https://travis-ci.org/nhevan/tdd-forum-laravel"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>

</p>

## About The Project

This application was built explicitly to try out a tdd approach using laravel.
  - it includes unit and feature tests
  - all code blocks are highly refactored
  - this app was built while following the Laracast tutorial on tdd

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb combination of simplicity, elegance, and innovation give you tools you need to build any application with which you are tasked.

## Installing the App
  1. create a .env and setup the database configurations. See .env.example to get some idea.
  2. create the two databases that you defined in the previous step.
  3. run the following commands in the terminal
  ```sh
  $ php artisan key:generate
  $ composer install
  $ composer dump-autoload
  $ php artisan migrate
  $ php artisan migrate --database mysql_test
  ```
  After successful installation you can use laravel valet or run php artisan serve to checkout the project in browser.
  
  To run the included tests execute the following command in your terminal while on the root of this project.
  ```sh
  $ vendor/bin/phpunit
  ```

## Security Vulnerabilities

If you discover a security vulnerability within this application, please send an e-mail to NH Evan at nhevan@gmail.com. All security vulnerabilities will be promptly addressed.

## License

The App is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
