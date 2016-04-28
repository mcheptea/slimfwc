<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Slim the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/* API */
$app->get('/api/documentation', 'Controllers\Swagger\Documentation:show');
$app->post('/user/:username', 'Controllers\User:create');

/* Application */
$app->get('/', function () {
    echo "Hello, world ";
});

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});