<?php


namespace PHPCRUD\CRUD\DBController;


final class MYSQLController extends DBController
{
    private static $mysqlInstance = null;
    
    private \mysqli|false|null $mysqlConnection = null;
    
    private function __construct()
    {
        try {
            
            $this->mysqlConnection = mysqli_connect("localhost", "root", "root", "crud", "8889");
            
            if ($this->mysqlConnection->connect_error) throw new \Exception($this->mysqlConnection->connect_error);
                
        } catch (\Exception $err) {
            
            exit($err->getMessage());
            
        }
    }
    
    public static function getDBInstance(): static
    {
        if (static::$mysqlInstance === null) static::$mysqlInstance = new static();
        
        return static::$mysqlInstance;
    }
    
    public function getConnection(): \mysqli|false|null
    {
        return $this->mysqlConnection;
    }
}