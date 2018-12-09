<?php

session_start();

require __DIR__ . '/../autoload.php';

use Service\Container;
use Service\FlashMessagesService;
use Service\ImageService;

$container = new Container($configuration);
$carLoader = $container->getCarLoader();
$car = $carLoader->getOneById($_GET['id']);
$path = $container->getImageRepository()->findOneByCarId($_GET['id']);
$imageService = new ImageService($container);

?>

<!DOCTYPE html>
<html lang="pl">

<?php include '../widgets/head.php'; ?>

<body>
<?php include '../widgets/header.php'; ?>

<div class="container text-center">

    <div class="col-md-12">
        <img src="<?php echo $path['path']; ?>" alt="Obrazek auta" class="center"/>
        <h3 class="text-center text-uppercase"><?php echo $car->getName(); ?></h3>
        <div class="col-md-6">
            <h5>Cylindry:</h5>
            <h5>Pojemność silnika:</h5>
            <h5>Moc:</h5>
            <h5>Przyspieszenie 0-100 km/h:</h5>
            <h5>Prędkość max.:</h5>
        </div>
        <div class="col-md-6">
            <h5><?php echo $car->getNumberOfCylinders(); ?></h5>
            <h5><?php echo $car->getEngineCapacity(); ?> cml</h5>
            <h5><?php echo $car->getPower(); ?> KM</h5>
            <h5><?php echo $car->getAcceleration(); ?> s.</h5>
            <h5><?php echo $car->getTopSpeed(); ?> km/h</h5>
        </div>

    </div>

</div>
<?php require_once '../widgets/scripts.php'; ?>
</body>
</html>