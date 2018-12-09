<?php

session_start();

require __DIR__ . '/../autoload.php';

use Service\Container;
use Service\FlashMessagesService;
use Service\ImageService;

$container = new Container($configuration);
$motorCycleLoader = $container->getMotorCycleLoader();
$motorCycle = $motorCycleLoader->getOneById($_GET['id']);
$path = $container->getImageRepository()->findOneByMotorCycleId($_GET['id']);
$imageService = new ImageService($container);

?>

<!DOCTYPE html>
<html lang="pl">

<?php include '../widgets/head.php'; ?>

<body>
<?php include '../widgets/header.php'; ?>

<div class="container text-center">

    <div class="col-md-12">
        <img src="<?php echo $path['path']; ?>" alt="Obrazek motorka" class="center"/>
        <h3 class="text-uppercase"><?php echo $motorCycle->getName(); ?></h3>
        <div class="col-md-6">
            <h5>Cylindry:</h5>
            <h5>Pojemność silnika:</h5>
            <h5>Moc:</h5>
            <h5>Przyspieszenie 0-100 km/h:</h5>
            <h5>Prędkość max.:</h5>
        </div>
        <div class="col-md-6">
            <h5><?php echo $motorCycle->getNumberOfCylinders(); ?></h5>
            <h5><?php echo $motorCycle->getEngineCapacity(); ?> cml</h5>
            <h5><?php echo $motorCycle->getPower(); ?> KM</h5>
            <h5><?php echo $motorCycle->getAcceleration(); ?> s.</h5>
            <h5><?php echo $motorCycle->getTopSpeed(); ?> km/h</h5>
        </div>
    </div>

</div>
<?php require_once '../widgets/scripts.php'; ?>
</body>
</html>