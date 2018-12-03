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

<div class="container">

    <?php
    if (isset($_SESSION['delete'])) {
        echo '<div class="alert alert-success flash-message">';
        echo '<strong>' . $_SESSION['delete'] . '</strong>';
        echo '</div>';
        unset($_SESSION['delete']);
    }

    if (isset($_SESSION['validate_success'])) {
        echo '<div class="alert alert-success flash-message">';
        echo '<strong>' . $_SESSION['validate_success'] . '</strong>';
        echo '</div>';
        unset($_SESSION['validate_success']);
    }
    ?>

    <h1 class="text-center text-uppercase">Porównywarka samochodów</h1>


    <?php foreach ($cars as $car): ?>
        <?php $path = $container->getImageRepository()->findOneByCarId($car->getId()); ?>
        <?php if ($firstLetter != $car->getName()[0]): ?>
            <?php $firstLetter = $car->getName()[0]; ?>
            <?php echo $car->getName()[0] . '<br/>' ?>
        <?php endif; ?>
        <a class="btn btn-success" href="carPage.php?id=<?php echo $car->getId(); ?>"><?php echo $car->getName(); ?></a>
        <img src="<?php echo $path['path']; ?>" alt="Obrazek auta" class="center" />
        <hr/>
    <?php endforeach; ?>

</div>

<?php require_once '../widgets/scripts.php'; ?>
</body>
</html>