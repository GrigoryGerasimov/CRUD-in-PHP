<?php

namespace PHPCRUD\CRUD\view;

use PHPCRUD\CRUD\Router\Router;

require_once __DIR__."/../../vendor/autoload.php";

require_once __DIR__."/../utils/protectData.php";


$id = $_GET["id"];

parse_str(file_get_contents("php://input"), $putData);

$dataProtected = array_walk_recursive($putData, "PHPCRUD\CRUD\utils\protectData");

if ($dataProtected) $updateData = $putData;

$router = new Router();

$productData = json_decode($router->getController()->readOne($id));

if ($productData->status === "success") {
    
    foreach($productData->result as $product) {

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" href="../assets/css/index.css" />
</head>
<body>
<section>

<form action=<?= "update.php?id=$id" ?> method="POST">
<h3>Update product</h3>
<div>
<input type="hidden" name="id" value="<?= $product->id ?>"/>
</div>
<div>
<label for="title">Title</label>
<input id="title" type="text" name="title" value="<?= $product->title ?>"/>
</div>
<div>
<label for="price">Price</label>
<input id="price" type="number" name="price" value="<?= $product->price ?>">
</div>
<div>
<label for="description">Description</label>
<textarea id="description" name="description" rows="4" cols="50"><?= $product->description ?></textarea>
</div>
<div>
<div>
<button type="submit">Submit</button>
</div>
<div><a href="../index.php" class="back back-form-link">Back</a></div>
</div>

</form>

</section>

<?php 

    }
    
} else exit("Product data fetching failed: $productData->result");

if (!empty($updateData)) {
    
    $router->getController()->update($id, $updateData);
    
    header("Location: /");
}

?>

</body>
</html>