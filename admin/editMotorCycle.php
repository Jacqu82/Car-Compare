<?php

session_start();

require __DIR__ . '/../autoload.php';

use Service\Container;

if (!isset($_SESSION['admin'])) {
    header('Location: ../web/index.php');
    exit();
}

$container = new Container($configuration);
$motorCycleLoader = $container->getMotorCycleLoader();
$motorCycle = $motorCycleLoader->getOneById($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name'])) {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $numberOfCylinders = filter_input(INPUT_POST, 'cylinder', FILTER_SANITIZE_NUMBER_INT);
        $engineCapacity = filter_input(INPUT_POST, 'capacity', FILTER_SANITIZE_NUMBER_FLOAT);
        $power = filter_input(INPUT_POST, 'power', FILTER_SANITIZE_NUMBER_INT);
        $acceleration = filter_input(INPUT_POST, 'acceleration', FILTER_SANITIZE_STRING);
        $topSpeed = filter_input(INPUT_POST, 'speed', FILTER_SANITIZE_NUMBER_INT);

        $isOk = true;

        if (empty($name)) {
            $_SESSION['e_name'] = 'Nazwa nie może być pusta!';
            $isOk = false;
        }

        if ($isOk) {
            $motorCycle
                ->setName($name)
                ->setNumberOfCylinders($numberOfCylinders)
                ->setEngineCapacity($engineCapacity)
                ->setPower($power)
                ->setAcceleration($acceleration)
                ->setTopSpeed($topSpeed);
            $container->getMotorCycleRepository()->update($motorCycle);

            $_SESSION['edit_success'] = 'Poprawnie edytowano motorek :)';
            header('Location: motorCyclePage.php?id=' . $motorCycle->getId());
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pl">

<?php include '../widgets/head.php'; ?>

<body>
<?php include '../widgets/header.php'; ?>

<div class="container">
    <h1 class="text-center text-uppercase">Edytuj motorek</h1>

    <?php include_once 'editForm.php' ?>
</div>

<?php require_once '../widgets/scripts.php'; ?>

</body>
</html>