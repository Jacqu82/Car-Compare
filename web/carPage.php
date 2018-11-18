<?php

session_start();

require __DIR__ . '/../autoload.php';

use Service\Container;

$container = new Container($configuration);
$carLoader = $container->getCarLoader();
$car = $carLoader->getOneById($_GET['id']);

if (isset($_POST['delete'])) {
    $carRepository = $container->getCarRepository();
    $carRepository->delete($_GET['id']);

    $_SESSION['delete'] = "Poprawnie usunołeś {$car->getName()}!";
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="pl">

<?php include '../widgets/head.php'; ?>

<body>
<?php include '../widgets/header.php'; ?>

<div class="container">

    <h1 class="text-center text-uppercase"><?php echo $car->getName(); ?></h1>

    <table class="table">
        <thead>
        <tr>
            <th>Marka i model</th>
            <th>Liczba cylindrów</th>
            <th>Pojemność silnika</th>
            <th>Moc</th>
            <th>Przyspieszenie</th>
            <th>Prędkość max.</th>
            <th>Akcje</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $car->getName(); ?></td>
            <td><?php echo $car->getNumberOfCylinders(); ?></td>
            <td><?php echo $car->getEngineCapacity(); ?></td>
            <td><?php echo $car->getPower(); ?></td>
            <td><?php echo $car->getAcceleration(); ?></td>
            <td><?php echo $car->getTopSpeed(); ?></td>
            <td>
                <a href="editCar.php?id=<?php echo $car->getId(); ?>" class="btn btn-warning">Edytuj</a>
                <form method="post" action="#">
                    <button type="submit" class="btn btn-danger" name="delete">Usuń</button>
                </form>
            </td>
        </tr>
        </tbody>
    </table>

</div>

</body>
</html>