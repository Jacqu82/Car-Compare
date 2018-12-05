<?php

session_start();

require __DIR__ . '/../autoload.php';

use Service\Container;
use Service\FlashMessagesService;
use Service\ImageService;

if (!isset($_SESSION['admin'])) {
    header('Location: ../web/index.php');
    exit();
}

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

<div class="container">
    <?php
    if (isset($_POST['delete'])) {
        $carRepository = $container->getCarRepository();
        $carRepository->delete($_GET['id']);
        $pathToDelete = $path['path'];
        $imageService->deleteFile($pathToDelete);
        $imageService->deleteEmptyDirectory($car->getId());

        $_SESSION['delete'] = "Poprawnie usunołeś {$car->getName()}!";
        header('Location: adminPanel.php');
    }
    if (isset($_SESSION['edit_success'])) {
        FlashMessagesService::setFlashMessage('success', $_SESSION['edit_success']);
        unset($_SESSION['edit_success']);
    }
    if (isset($_SESSION['edit_image'])) {
        FlashMessagesService::setFlashMessage('success', $_SESSION['edit_image']);
        unset($_SESSION['edit_image']);
    }
    ?>
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
    <img src="<?php echo $path['path']; ?>" alt="Obrazek auta" class="center"/>
    <a href="editImageCar.php?id=<?php echo $car->getId(); ?>" class="btn btn-warning">Edytuj zdjęcie</a>
</div>
<?php require_once '../widgets/scripts.php'; ?>
</body>
</html>