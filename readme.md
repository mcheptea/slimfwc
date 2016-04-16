# Template Slim Base application

This application is a template for Slim based web nodes. It is written in PHP and it's goal is to serve as a base for more complex independent components.
The application comes with a configured Swagger installation for generating API documentation.

##### **Project Structure**
    /app
        /commands
        /config
        /controllers
        /models
        /storage
        /views
    /migrations
    /public
    /vendor
    composer.json
    composer.lock
    composer.phar

* `/app` contains all the application's files. Here goes all your app logic.
    * `/commands` contains the configuration commands.
    * `/config` contains the config files and the `routes`. You can add any `.ini` files here and then access them with `Config`. Example: `Config::get('database.mysql.host')`
    * `/controllers` contains the controllers (see MVC)
    * `/models` contains the models (see MVC)
    * `/storage` general usage directory, ie. can be used to store uploaded files.
    * `/views` contains the views, ie. html files
* `/migrations` contains all the database migrations
* `/public` this is the application document root. The virtual host needs to be configured with the document root pointed here.
    * `/swagger` contains the swagger-ui js client, for displaying the *APIs* swagger based documentation.
* `/vendor` contains the applications dependencies, installed with composer.

##### **Dependencies**
The application uses Composer for dependency management. The Composer config files are located in the project root. The dependencies are installed automatically in the `/vendor` directory.

To install the dependencies download [composer](https://getcomposer.org/download/) to the project root. Then run:

    php composer.phar install

##### **Using Composer**
Extensive documentation can be found at https://getcomposer.org/doc/00-intro.md

***Basic Commands***

* `php composer.phar install` - installs all the packages in `composer.json`
* `php composer.phar require author/package` - installs a new package

##### **Using Swagger PHP**
Documentation can be found at https://github.com/zircote/swagger-php

Note this template uses the `Swagger 2.0` spec and it's php implementation by `zircote`.

##### **Using Phinx**
A good and comprehensive tutorial about Phinx can be found at http://docs.phinx.org/en/latest/intro.html

The `phinx.yml` file contains the database configurations phinx needs in order to operate. The default environment flag is set to `production`.

***Basic Commands***

* `vendor/bin/phinx status` - displays the status of the migrations.
* `vendor/bin/phinx create MyMigrationName` - creates a new migration.
* `vendor/bin/phinx migrate` - migrates all the down migrations.
* `vendor/bin/phinx rollback` - rollbacks one migration. The `-t` option cna be used to rollback multiple migrations.

##### Slimer
`slimer` is a cli based command runner. The aplication comes with a default command found in `app/commands`.

Running commands example: `slimer@ghostbusters$ slimer hello World`

All commands should be registered in the `slimer` file in the project root.

#### Sample Installation/Deployment Flow
This application provides a series of commands which allows quick app configuration and deployment.
 
*Steps*

1. Clone the repository. Example: `git clone https://github.com/mcheptea/slimfwc.git`
2. Configure the virtual host in your Apache server. ***Note:*** The `DocumentRoot` setting SHOULD point to the `public/` directory in this project.
3. Create a **MySQL** Database, Username and Password.
4. Run the application configuration commands (use `--help` to see the parameter list):
    1. Example: `php slimer hello world`
5. Run the **phinx** migrations to bring the database up to date. Example: `vendor/bin/phinx migrate`


#### API
After the installation the application's API becomes available. It can be accessed by opening [http://mydomain.com/swagger/](http://mydomain.com/swagger/) in your browser.