<?php

namespace PHPCRUD\CRUD\Builder;


class QueryBuilder
{
    public static function selectAll(\mysqli $connection, string $DBTable)
    {
        $stmt = mysqli_prepare($connection, strtoupper("select * from ") . "`$DBTable`");
        
        $stmt->execute();
        
        return $stmt->get_result();
    }
    
    public static function selectById(string $DBTable, string $id): string
    {
        
    }
    
    public static function insert(string $DBTable, array $data): string
    {
        
    }
    
    public static function set(string $DBTable, string $id, array $data): string
    {
        
    }
    
    public static function delete(string $DBTable, string $id): string
    {
        
    }
}