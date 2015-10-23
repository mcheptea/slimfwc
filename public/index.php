<?php
/**
 * App's unique entry point.
 *
 * User: Mark Cheptea
 * Date: 10/23/2015
 * Time: 10:42 AM
 */
require '../vendor/autoload.php';

use \Slim\Slim;

$app = new Slim(array('debug' => true));

/* Routes */
require_once("../app/config/routes.php");

$app->run();