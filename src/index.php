<?php

namespace PHPCRUD\CRUD;

use PHPCRUD\CRUD\DBController\MYSQLController;

require_once("../vendor/autoload.php");


$connection = MYSQLController::getDBInstance()->getConnection();

var_dump($connection);