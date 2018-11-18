<?php

session_start();

require __DIR__ . '/../autoload.php';

use Service\Container;

$container = new Container($configuration);
$carLoader = $container->getCarLoader();
$cars = $carLoader->getAll();

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
    ?>

    <h1 class="text-center text-uppercase">Porównywarka samochodów</h1>

    <?php foreach ($cars as $car): ?>
        <?php echo $car->getName()[0] . '<br/>' ?>
        <a class="btn btn-success" href="carPage.php?id=<?php echo $car->getId(); ?>"><?php echo $car->getName(); ?></a>
        <hr/>
    <?php endforeach; ?>

</div>

<?php require_once '../widgets/scripts.php'; ?>
</body>
</html>