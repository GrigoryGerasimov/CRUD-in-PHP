<?php

namespace PHPCRUD\CRUD\view;

use PHPCRUD\CRUD\Router\Router;

require_once __DIR__."/../../vendor/autoload.php";


$id = $_GET["id"];

$router = new Router();

$router->getController()->delete($id);

header("Location: /");