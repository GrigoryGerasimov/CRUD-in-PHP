<?php

namespace PHPCRUD\CRUD\Router;

use PHPCRUD\CRUD\DBController\MYSQLController;
use PHPCRUD\CRUD\ProductController\ProductController;


class Router
{
    private ?string $path = null;
    
    private ?string $method = null;
    
    private ?array $postData = null;
    
    private ?array $updateData = null;
    
    private ?ProductController $controller = null;
    
    
    public function __construct()
    {
        $connection = MYSQLController::getDBInstance()->getConnection();
        
        $this->controller = new ProductController($connection);
        
        $this->path = !empty($_GET) ? $_GET["q"] : null;
        
        $this->method = $_SERVER["REQUEST_METHOD"];
        
        $this->postData = $_POST;
        
        parse_str(file_get_contents("php://input"), $output);

        $this->updateData = $output;
        
    }
    
    public function getPath(): int|string|null
    {
        if (isset ($this->path)) {
            
            $splitPath = explode("/", $this->path);
            
            return $splitPath[count($splitPath) - 1];
        
        } else return null;

    }
    
    public function getMethod(): ?string
    {
        return isset($this->method) ? $this->method : null;
        
    }
    
    public function route()
    {
        try {
            
            $result = match($this->getMethod()) {
                
                "GET" => (int) $this->getPath() ? $this->controller->readOne($this->getPath()) : $this->controller->readAll(),
                "POST" => $this->getPath() === "products" ? $this->controller->create($this->postData) : throw new \Exception("To create a new product please return to product list"),
                "PATCH" => (int) $this->getPath() ? $this->controller->update($this->getPath(), $this->updateData) : throw new \Exception("Please select a product to update"),
                "DELETE" => (int) $this->getPath() ? $this->controller->delete($this->getPath()) : throw new \Exception("Please select a product to delete")
                
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