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
        try {

            $queryResult = QueryBuilder::insert($this->connection, "products", $data);
            
            if ($queryResult) {
                
                http_response_code(201);
                
                return json_encode([
                    "status" => "success",
                    "result" => "New product item created"
                ]);
                
            } else {
                
                http_response_code(400);
                
                throw new \Exception("New product item creation failed");
                
            }
            
        } catch (\Exception|\Error $err) {
            
            http_response_code(400);
            
            return json_encode([
                "status" => "failed",
                "result" => $err->getMessage()
            ]);
            
        }
    }
    
    public function readAll(): string
    {
        try {
            
            $queryResult = QueryBuilder::selectAll($this->connection, "products");
            
            $data = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
            
            if (!empty($data)) {
                
                http_response_code(200);
                
                return json_encode([
                    "status" => "success",
                    "result" => $data
                ]);
                
            } else {
                
                http_response_status(404);
                
                throw new \Exception("No products found");
                
            }
            
        } catch (\Exception|\Error $err) {
            
            http_response_status(400);
            
            return json_encode([
                "status" => "failed",
                "result" => $err->getMessage()
            ]);
            
        }
    }
    
    public function readOne(string $id): string
    {
        try {
            
            $queryResult = QueryBuilder::selectById($this->connection, "products", $id);
            
            $data = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
            
            if (!empty($data)) {
                
                http_response_code(200);
                
                return json_encode([
                    "status" => "success",
                    "result" => $data
                    
                ]);
            
            } else {
                
                http_response_code(404);
                
                throw new \Exception("Product with id $id not found");
            
            }
        
        } catch (\Exception|\Error $err) {
            
            http_response_code(400);
            
            return json_encode([
                "status" => "failed",
                "result" => $err->getMessage()
            ]);
            
        }
        
    }
    
    public function update(string $id, array $data): string
    {
        try {
            
        } catch (\Exception|\Error $err) {
            
        }
    }
    
    public function delete(string $id): string
    {
        try {
            
        } catch (\Exception|\Error $err) {
            
        }
    }
}