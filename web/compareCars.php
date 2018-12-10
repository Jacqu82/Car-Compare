<?php

session_start();

require __DIR__ . '/../autoload.php';

use Service\Container;

$container = new Container($configuration);
$carLoader = $container->getCarLoader();
$vehicleCompare = $container->getVehicleCompare();

$car1Id = isset($_POST['car1']) ? $_POST['car1'] : null;
$car2Id = isset($_POST['car2']) ? $_POST['car2'] : null;

if ($car1Id === $car2Id) {
    header('Location: selectCars.php?error=same_car');
}

if (!$car1Id || !$car2Id) {
    header('Location: selectCars.php?error=missing_data');
}

$car1 = $carLoader->getOneById($car1Id);
$car2 = $carLoader->getOneById($car2Id);
$car1Image = $container->getImageRepository()->findOneByCarId($car1Id);
$car2Image = $container->getImageRepository()->findOneByCarId($car2Id);
$car1Cylinders = $vehicleCompare->compareCylinders($car1, $car2);
$car2Cylinders = $vehicleCompare->compareCylinders($car2, $car1);
$car1Engine = $vehicleCompare->compareEngineCapacity($car1, $car2);
$car2Engine = $vehicleCompare->compareEngineCapacity($car2, $car1);
$car1Power = $vehicleCompare->comparePower($car1, $car2);
$car2Power = $vehicleCompare->comparePower($car2, $car1);
$car1Acceleration = $vehicleCompare->compareAcceleration($car1, $car2);
$car2Acceleration = $vehicleCompare->compareAcceleration($car2, $car1);
$car1Speed = $vehicleCompare->compareSpeed($car1, $car2);
$car2Speed = $vehicleCompare->compareSpeed($car2, $car1);

?>

<!DOCTYPE html>
<html lang="pl">

<?php include '../widgets/head.php'; ?>

<body>
<?php include '../widgets/header.php'; ?>

<div class="container text-center">
    <div class="col-md-6">
        <img src="<?php echo $car1Image['path']; ?>" alt="Obrazek auta" class="center"/>
        <h3><?php echo $car1->getName(); ?></h3>
        <h5 style="color: <?php echo $car1Cylinders; ?>">Cylindry: <?php echo $car1->getNumberOfCylinders(); ?></h5>
        <h5 style="color: <?php echo $car1Engine; ?>">Pojemność silnika: <?php echo $car1->getEngineCapacity(); ?> cml</h5>
        <h5 style="color: <?php echo $car1Power; ?>">Moc: <?php echo $car1->getPower(); ?> KM</h5>
        <h5 style="color: <?php echo $car1Acceleration; ?>">Przyspieszenie 0-100 km/h: <?php echo $car1->getAcceleration(); ?> s.</h5>
        <h5 style="color: <?php echo $car1Speed; ?>">Prędkość max.: <?php echo $car1->getTopSpeed(); ?> km/h</h5>
    </div>
    <div class="col-md-6">
        <img src="<?php echo $car2Image['path']; ?>" alt="Obrazek auta" class="center"/>
        <h3><?php echo $car2->getName(); ?></h3>
        <h5 style="color: <?php echo $car2Cylinders; ?>">Cylindry: <?php echo $car2->getNumberOfCylinders(); ?></h5>
        <h5 style="color: <?php echo $car2Engine; ?>">Pojemność silnika: <?php echo $car2->getEngineCapacity(); ?> cml</h5>
        <h5 style="color: <?php echo $car2Power; ?>">Moc: <?php echo $car2->getPower(); ?> KM</h5>
        <h5 style="color: <?php echo $car2Acceleration; ?>">Przyspieszenie 0-100 km/h: <?php echo $car2->getAcceleration(); ?> s.</h5>
        <h5 style="color: <?php echo $car2Speed; ?>">Prędkość max.: <?php echo $car2->getTopSpeed(); ?> km/h</h5>
    </div>
</div>

<?php require_once '../widgets/scripts.php'; ?>
</body>
</html>