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
            
            foreach($data as $item) {
                
                $stmt = mysqli_prepare(
                    $connection, 
                    strtoupper("insert into " . "`$DBTable` " . "(`title`, `price`, `description`) " . "VALUES ('?', '?', '?')")
                    );
                
                $title = $item["title"];
                $price = $item["price"];
                $description = $item["description"];
                
                $stmt->bind_param("is", $title, $price, $description);
                
                $stmt->execute();
                
                return $stmt->get_result();
            }
            
        }

    }
    
    public static function set(\mysqli $connection, string $DBTable, string $id, array $data)
    {
        
    }
    
    public static function delete(\mysqli $connection, string $DBTable, string $id)
    {
        
    }
}