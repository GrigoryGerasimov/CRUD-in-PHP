<?php

namespace PHPCRUD\CRUD\Router;

use PHPCRUD\CRUD\DBController\MYSQLController;
use PHPCRUD\CRUD\ProductController\ProductController;


class Router
{
    private ?array $path = null;
    
    private ?string $method = null;
    
    private ?array $postData = null;
    
    private ?array $updateData = null;
    
    private ?ProductController $controller = null;
    
    
    public function __construct()
    {
        $connection = MYSQLController::getDBInstance()->getConnection();
        
        $this->controller = new ProductController($connection);
        
        $this->path = $_GET;
        
        $this->method = $_SERVER["REQUEST_METHOD"];
        
        $this->postData = $_POST;
        
        parse_str(file_get_contents("php://input"), $output);

        $this->updateData = $output;
        
    }
    
    public function getApiPath(): int|string|null
    {
        if (!empty($this->path)) {
            
            $splitPath = explode("/", $this->path["q"]);
            
            return $splitPath[count($splitPath) - 1];
        
        } else return null;

    }
    
    public function getMethod(): ?string
    {
        return isset($this->method) ? $this->method : null;
        
    }
    
    public function getController(): ?ProductController
    {
        return $this->controller;
    }
    
    public function route()
    {
        try {

            $result = match($this->getMethod()) {
                
                "GET" => (int) $this->getApiPath() ? $this->controller->readOne($this->getApiPath()) : $this->controller->readAll(),
                "POST" => $this->getApiPath() === "products" ? $this->controller->create($this->postData) : throw new \Exception("Please return to products list to create a new product"),
                "PATCH" => (int) $this->getApiPath() ? $this->controller->update($this->getApiPath(), $this->updateData) : throw new \Exception("Please select a product to update"),
                "DELETE" => (int) $this->getApiPath() ? $this->controller->delete($this->getApiPath()) : throw new \Exception("Please select a product to delete")
                
            };
            
            return $result;
            
        } catch (\UnhandledMatchError|\Exception $err) {
            
            http_response_code(400);
            
            exit(json_encode([
                "status" => "failed",
                "result" => $err->getMessage()
            ]));
            
        }
        
    }
}