<?php

namespace PHPCRUD\CRUD;

header("Content-type: application/json");

use PHPCRUD\CRUD\DBController\MYSQLController;
use PHPCRUD\CRUD\ProductController\ProductController;

require_once("../vendor/autoload.php");


$connection = MYSQLController::getDBInstance()->getConnection();

$productController = new ProductController($connection);

$productController->readAll();