<?php

namespace PHPCRUD\CRUD;


header("Content-type: application/json");

use PHPCRUD\CRUD\Router\Router;

require_once("../vendor/autoload.php");


$router = new Router();

var_dump($router->route());