<?php

session_start();

require __DIR__ . '/../autoload.php';

use Model\Car;
use Service\Container;

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
            $car = new Car();
            $car
                ->setName($name)
                ->setNumberOfCylinders($numberOfCylinders)
                ->setEngineCapacity($engineCapacity)
                ->setPower($power)
                ->setAcceleration($acceleration)
                ->setTopSpeed($topSpeed);

            $container = new Container($configuration);
            $container->getCarRepository()->saveToDb($car);

            header('Location: index.php');

            $_SESSION['validate_success'] = 'Poprawnie dodano samochód do bazy :)';
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
    <h1 class="text-center text-uppercase">Dodaj samochód</h1>

    <form action="#" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Nazwa</label>
            <input type="text" id="name" class="form-control" name="name">
        </div>
        <?php
        if (isset($_SESSION['e_name'])) {
            echo '<div class="alert alert-warning flash-message">';
            echo '<strong>' . $_SESSION['e_name'] . '</strong>';
            echo '</div>';
            unset($_SESSION['e_name']);
        }
        ?>
        <div class="form-group">
            <label for="cylinder">Liczba cylindrów</label>
            <input type="number" id="cylinder" class="form-control" name="cylinder">
        </div>
        <div class="form-group">
            <label for="capacity">Pojemność silnika</label>
            <input type="number" id="capacity" class="form-control" name="capacity">
        </div>
        <div class="form-group">
            <label for="power">Moc</label>
            <input type="number" id="power" class="form-control" name="power">
        </div>
        <div class="form-group">
            <label for="acceleration">Przyspieszenie</label>
            <input type="text" id="acceleration" class="form-control" name="acceleration">
        </div>
        <div class="form-group">
            <label for="speed">Prędkość maksymalna</label>
            <input type="number" id="speed" class="form-control" name="speed">
        </div>
        <div class="form-group">
            <input type="file" name="image"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Zapisz</button>
        </div>
    </form>
</div>

<?php require_once '../widgets/scripts.php'; ?>

</body>
</html>