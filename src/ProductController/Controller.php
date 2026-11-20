<?php

namespace PHPCRUD\CRUD\ProductController;


abstract class Controller implements ControllerInterface
{
    public function create(array $data): string {}
    
    public function readAll(): string {}
    
    public function readOne(string $id): string {}
    
    public function update(string $id, array $data): string {}
    
    public function delete(string $id): string {}
}