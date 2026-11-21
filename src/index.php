<?php

namespace PHPCRUD\CRUD;

use PHPCRUD\CRUD\Router\Router;

require_once __DIR__."/../vendor/autoload.php";

require_once __DIR__."/utils/protectData.php";

//header("Content-type: application/json");

$router = new Router();

//var_dump($router->route());

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" href="assets/css/index.css" />
</head>
<body>
<section>
<table>
<thead>
<tr>
<th>ID</th>
<th>Title</th>
<th>Price</th>
<th>Description</th>
<tr>
</thead>
<tbody>

<?php 

if (!empty($_POST)) {
    
    $postDataProtected = array_walk_recursive($_POST, __NAMESPACE__."\utils\protectData");
    
    if ($postDataProtected) $router->getController()->create($_POST);
    
}

$products = json_decode($router->getController()->readAll());

if ($products->status === "success") {
    
foreach($products->result as $productValue) {
    
?>

<tr>
<td><?= $productValue->id ?></td>
<td><?= $productValue->title ?></td>
<td><?= $productValue->price ?></td>
<td><?= $productValue->description ?></td>
<td class="view"><a href=<?= "/view/product.php?id=".$productValue->id ?>>View</a></td>
<td class="edit"><a href=<?= "/view/update.php?id=".$productValue->id ?>>Edit</a></td>
<td class="delete"><a href=<?= "/view/delete.php?id=".$productValue->id ?>>Delete</a></td>
</tr>

<?php

    }

} else exit("Products data fetching failed: $products->result");

?>

</tbody>
</table>
</section>

<section>

<form action="index.php" method="POST">
<h3>Add new product</h3>
<div>
<label for="title">Title</label>
<input id="title" type="text" name="title"/>
</div>
<div>
<label for="price">Price</label>
<input id="price" type="number" name="price"/>
</div>
<div>
<label for="description">Description</label>
<textarea id="description" name="description" rows="4" cols="50"></textarea>
</div>
<div>
<button type="submit">Submit</button>
</div>

</form>

</section>

</body>
</html>