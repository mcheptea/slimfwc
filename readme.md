# Template Slim Base application

This application is a template for Slim based web nodes. It is written in PHP and it's goal is to serve as a base for more complex independent components.
The application comes with a configured Swagger installation for generating documentation.

##### Project Structure
    /app
        /config
        /controllers
        /models
        /storage
        /views
    /public
    /vendor
    composer.json
    composer.lock
    composer.phar

* `/app` contains all the application's files. Here goes all your app logic goes.
    * `/config` contains the config files and the `routes`. You can add any `.ini` files here and then access them with `Config`. Example: `Config::get('database.mysql.host')`
    * `/controllers` contains the controllers (see MVC)
    * `/models` contains the models (see MVC)
    * `/storage` general usage directory, ie. can be used to store uploaded files.
    * `/views` contains the views, ie. html files
* `/public` this is the application document root. The virtual host needs to be configured with the document root pointed here.
    * `/swagger` contains the swagger-ui js client, for displaying the *APIs* swagger based documentation.
* `/vendor` contains the applications dependencies, installed with composer.

##### Dependencies
The application uses Composer for dependency management. The Composer config files are located in the project root. The dependencies are installed automatically in the `/vendor` directory.

The dependencies and the composer `.json` and `.lock` files are commited to git. Any dependency updates are also to be committed to git. This is done in order to make easier deployments (by avoiding running composer commands in production).

##### Using Composer
Extensive documentation can be found at https://getcomposer.org/doc/00-intro.md

*Basic Commands*
* `php composer.phar install` - installs all the packages in `composer.json`
* `php composer.phar require author/package` - installs a new package

##### Using Swagger PHP
Documentation can be found at https://github.com/zircote/swagger-php

Note this template uses the `Swagger 2.0` spec and it's php implementation by `zircote`.
