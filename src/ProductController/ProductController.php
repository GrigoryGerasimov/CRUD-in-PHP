<?php

namespace PHPCRUD\CRUD\ProductController;

use PHPCRUD\CRUD\Builder\QueryBuilder;


class ProductController extends Controller
{
    private ?\mysqli $connection = null;
    
    public function __construct(\mysqli $connection)
    {
        $this->connection = $connection;
    }
    
    public function create(array $data): string
    {
        
    }
    
    public function readAll(): string
    {
        try {
            
            $queryResult = QueryBuilder::selectAll($this->connection, "products");
            
            $data = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
            
            var_dump(json_encode($data));
            
        } catch (\Exception $err) {
            
            
        }
    }
    
    public function readOne(string $id): string
    {
        
    }
    
    public function update(string $id, array $data): string
    {
        
    }
    
    public function delete(string $id): string
    {
        
    }
}