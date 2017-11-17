# laravel-adminpanel
[![License](https://img.shields.io/badge/License-MIT-red.svg)](https://github.com/viralsolani/laravel-adminpanel/blob/master/LICENSE.txt)
[![StyleCI](https://styleci.io/repos/30171828/shield?style=plastic)](https://styleci.io/repos/105789824/shield?style=plastic)


## Introduction
* This is a laravel Admin Panel, based on [Rappasoft Laravel Boilerplate](https://github.com/rappasoft/laravel-5-boilerplate), with enhancemenets and many modules pre-made, just for you.
* The project is taken to Laravel 5.5 so we can develop from the latest Laravel.

## Features
For Laravel 5 Boilerplate Features : [Features](https://github.com/rappasoft/laravel-5-boilerplate/wiki#features)

## Additional Features
* Built-in Laravel Boilerplate CRUD Generator,
* Dynamic Menu/Sidebar Builder
* CMS Pages Module
* Email Template Module
* Blog Module
* FAQ Module
* API Boilerplate - Coming Soon.

Give your project a Head Start by using [laravel-adminpanel](https://github.com/viralsolani/laravel-adminpanel).

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)


Clone the repository

    git clone https://github.com/viralsolani/laravel-adminpanel.git

Switch to the repo folder

    cd laravel-adminpanel

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Generate a new JWT authentication secret key

    php artisan jwt:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Run the database seeders

    php artisan db:seed

Install the javascript dependencies using npm

    npm install

Compile the dependencies

    npm run dev

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone https://github.com/viralsolani/laravel-adminpanel.git
    cd laravel-adminpanel
    composer install
    npm install
    npm run dev
    cp .env.example .env
    php artisan key:generate
    php artisan jwt:generate

## Issues

If you come across any issues please report them [here](https://github.com/viralsolani/laravel-adminpanel/issues).

## Contributing
Feel free to create any pull requests for the project. For propsing any new changes or features you want to add to the project, you can send us an email at viral.solani@gmail.com or basapativipulkumar@gmail.com.

## License

[MIT LICENSE](https://github.com/viralsolani/laravel-adminpanel/blob/master/LICENSE.txt)