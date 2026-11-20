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
    
    public static function selectById(\mysqli $connection, string $DBTable, string $id)
    {
        $stmt = mysqli_prepare($connection, strtoupper("select * from" ) . "`$DBTable`" . "where " . "id = $id");
        
        $stmt->execute();
        
        return $stmt->get_result();
    }
    
    public static function insert(\mysqli $connection, string $DBTable, array $data)
    {
        if (!empty($data)) {
            
            $stmt = mysqli_prepare(
                $connection,
                strtoupper("insert into " . "`$DBTable` " . "(`title`, `price`, `description`) " . "VALUES (?, ?, ?)")
                );
            
            $title = array_key_exists("title", $data) ? $data["title"] : null;
            $price = array_key_exists("price", $data) ? $data["price"] : null;
            $description = array_key_exists("description", $data) ? $data["description"] : null;
            
            $stmt->bind_param("sis", $title, $price, $description);
            
            return $stmt->execute();

        }

    }
    
    public static function set(\mysqli $connection, string $DBTable, string $id, array $data)
    {
        
    }
    
    public static function delete(\mysqli $connection, string $DBTable, string $id)
    {
        
    }
}