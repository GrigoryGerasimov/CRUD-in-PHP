<?php

namespace PHPCRUD\CRUD\DBController;


interface DBControllerInterface
{
    public static function getDBInstance(): static;
    
    public function getConnection(): \mysqli|false|null;
}