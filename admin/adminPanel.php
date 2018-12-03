<?php

session_start();

require __DIR__ . '/../autoload.php';

use Service\Container;
use Service\FlashMessagesService;

if (!isset($_SESSION['admin'])) {
    header('Location: ../web/index.php');
    exit();
}

$container = new Container($configuration);
$carLoader = $container->getCarLoader();
$cars = $carLoader->getAll();
$firstLetter = '';
$admin = $container->loggedAdmin();

?>

<!DOCTYPE html>
<html lang="pl">

<?php include '../widgets/head.php'; ?>

<body>
<?php include '../widgets/header.php'; ?>

<div class="container">

    <?php
    if (isset($_SESSION['delete'])) {
        FlashMessagesService::setFlashMessage('success', $_SESSION['delete']);
        unset($_SESSION['delete']);
    }
    if (isset($_SESSION['validate_success'])) {
        FlashMessagesService::setFlashMessage('success', $_SESSION['validate_success']);
        unset($_SESSION['validate_success']);
    }
    ?>

    <h1 class="text-center text-uppercase">Witaj <?php echo $admin['login'] ?>!</h1>

    <?php foreach ($cars as $car): ?>
        <?php $path = $container->getImageRepository()->findOneByCarId($car->getId()); ?>
        <?php if ($firstLetter != $car->getName()[0]): ?>
            <?php $firstLetter = $car->getName()[0]; ?>
            <?php echo $car->getName()[0] . '<br/>' ?>
        <?php endif; ?>
        <a class="btn btn-success" href="../admin/carPage.php?id=<?php echo $car->getId(); ?>"><?php echo $car->getName(); ?></a>
        <img src="<?php echo $path['path']; ?>" alt="Obrazek auta" class="center" />
        <hr/>
    <?php endforeach; ?>

</div>

<?php require_once '../widgets/scripts.php'; ?>
</body>
</html>