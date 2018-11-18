<?php

require __DIR__ . '/../autoload.php';

use Service\Container;

$container = new Container($configuration);
$carLoader = $container->getCarLoader();
$car = $carLoader->getOneById($_GET['id']);

?>

<!DOCTYPE html>
<html lang="pl">

<?php include '../widgets/head.php'; ?>

<body>
<?php include '../widgets/header.php'; ?>

<div class="container">

<h1 class="text-center text-uppercase"><?php echo $car->getName(); ?></h1>

</div>

</body>
</html>