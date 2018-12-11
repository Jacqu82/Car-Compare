<?php

session_start();

require __DIR__ . '/../autoload.php';

use Service\Container;

$container = new Container($configuration);
$motorCycleLoader = $container->getMotorCycleLoader();
$vehicleCompare = $container->getVehicleCompare();

$motorCycle1Id = isset($_POST['motorCycle1']) ? $_POST['motorCycle1'] : null;
$motorCycle2Id = isset($_POST['motorCycle2']) ? $_POST['motorCycle2'] : null;

if ($motorCycle1Id === $motorCycle2Id) {
    header('Location: selectMotorCycles.php?error=same_motorCycle');
}

if (!$motorCycle1Id || !$motorCycle2Id) {
    header('Location: selectMotorCycles.php?error=missing_data');
}

$motorCycle1 = $motorCycleLoader->getOneById($motorCycle1Id);
$motorCycle2 = $motorCycleLoader->getOneById($motorCycle2Id);
$motorCycle1Image = $container->getImageRepository()->findOneBymotorCycleId($motorCycle1Id);
$motorCycle2Image = $container->getImageRepository()->findOneBymotorCycleId($motorCycle2Id);
$motorCycle1Cylinders = $vehicleCompare->compareCylinders($motorCycle1, $motorCycle2);
$motorCycle2Cylinders = $vehicleCompare->compareCylinders($motorCycle2, $motorCycle1);
$motorCycle1Engine = $vehicleCompare->compareEngineCapacity($motorCycle1, $motorCycle2);
$motorCycle2Engine = $vehicleCompare->compareEngineCapacity($motorCycle2, $motorCycle1);
$motorCycle1Power = $vehicleCompare->comparePower($motorCycle1, $motorCycle2);
$motorCycle2Power = $vehicleCompare->comparePower($motorCycle2, $motorCycle1);
$motorCycle1Acceleration = $vehicleCompare->compareAcceleration($motorCycle1, $motorCycle2);
$motorCycle2Acceleration = $vehicleCompare->compareAcceleration($motorCycle2, $motorCycle1);
$motorCycle1Speed = $vehicleCompare->compareSpeed($motorCycle1, $motorCycle2);
$motorCycle2Speed = $vehicleCompare->compareSpeed($motorCycle2, $motorCycle1);

?>

<!DOCTYPE html>
<html lang="pl">

<?php include '../widgets/head.php'; ?>

<body>
<?php include '../widgets/header.php'; ?>

<div class="container text-center">
    <div class="col-md-6">
        <img src="<?php echo $motorCycle1Image['path']; ?>" alt="Obrazek auta" class="center"/>
        <h3><?php echo $motorCycle1->getName(); ?></h3>
        <h5 style="color: <?php echo $motorCycle1Cylinders; ?>">
            Cylindry: <?php echo $motorCycle1->getNumberOfCylinders(); ?></h5>
        <h5 style="color: <?php echo $motorCycle1Engine; ?>">Pojemność
            silnika: <?php echo $motorCycle1->getEngineCapacity(); ?> cml</h5>
        <h5 style="color: <?php echo $motorCycle1Power; ?>">Moc: <?php echo $motorCycle1->getPower(); ?> KM</h5>
        <h5 style="color: <?php echo $motorCycle1Acceleration; ?>">Przyspieszenie 0-100
            km/h: <?php echo $motorCycle1->getAcceleration(); ?> s.</h5>
        <h5 style="color: <?php echo $motorCycle1Speed; ?>">Prędkość max.: <?php echo $motorCycle1->getTopSpeed(); ?>
            km/h</h5>
    </div>
    <div class="col-md-6">
        <img src="<?php echo $motorCycle2Image['path']; ?>" alt="Obrazek auta" class="center"/>
        <h3><?php echo $motorCycle2->getName(); ?></h3>
        <h5 style="color: <?php echo $motorCycle2Cylinders; ?>">
            Cylindry: <?php echo $motorCycle2->getNumberOfCylinders(); ?></h5>
        <h5 style="color: <?php echo $motorCycle2Engine; ?>">Pojemność
            silnika: <?php echo $motorCycle2->getEngineCapacity(); ?> cml</h5>
        <h5 style="color: <?php echo $motorCycle2Power; ?>">Moc: <?php echo $motorCycle2->getPower(); ?> KM</h5>
        <h5 style="color: <?php echo $motorCycle2Acceleration; ?>">Przyspieszenie 0-100
            km/h: <?php echo $motorCycle2->getAcceleration(); ?> s.</h5>
        <h5 style="color: <?php echo $motorCycle2Speed; ?>">Prędkość max.: <?php echo $motorCycle2->getTopSpeed(); ?>
            km/h</h5>
    </div>
</div>

<?php require_once '../widgets/scripts.php'; ?>
</body>
</html>