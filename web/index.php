<?php

session_start();

require __DIR__ . '/../autoload.php';

use Service\Container;

$container = new Container($configuration);
$carLoader = $container->getCarLoader();
$cars = $carLoader->getAll();
$firstLetter = '';

?>


<!DOCTYPE html>
<html lang="pl">

<?php include '../widgets/head.php'; ?>

<body>
<?php include '../widgets/header.php'; ?>

<div class="container text-center">

    <h1 class="text-uppercase">Porównywarka samochodów</h1>
    <a href="carIndexPage.php" class="btn btn-success">Autka</a>
    <a href="motorCycleIndexPage.php" class="btn btn-success">Motorki</a>

</div>

<?php require_once '../widgets/scripts.php'; ?>
</body>
</html>