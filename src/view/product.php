<?php

namespace PHPCRUD\CRUD\view;

use PHPCRUD\CRUD\Router\Router;

require_once __DIR__."/../../vendor/autoload.php";

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8"/>
<meta name="viewpoint" content="width=device-width, initicial-scale=1.0"/>
<link rel="stylesheet" href="../assets/css/index.css"/>
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

$id = $_GET["id"];

$router = new Router();

$productData = json_decode($router->getController()->readOne($id));

if ($productData->status === "success") {

    foreach($productData->result as $product) {

?>

<tr>
<td><?= $product->id ?></td>
<td><?= $product->title ?></td>
<td><?= $product->price ?></td>
<td><?= $product->description ?></td>
<td class="back"><a href="../index.php">Back</a></td>

<?php 

    }
    
} else exit("Product data fetching failed: $productData->result");

?>

</tr>

</tbody>
</table>
</section>

</body>
</html>