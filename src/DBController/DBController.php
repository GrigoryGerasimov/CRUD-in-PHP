<?php

namespace PHPCRUD\CRUD\DBController;


abstract class DBController implements DBControllerInterface
{    
    public static function getDBInstance(): static {}
    
    public function getConnection(): \mysqli|false|null {}
    
    public function __wakeup() {}
    
    private function __clone() {}
}