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
    <h1 class="text-center text-uppercase">Autka</h1>

    <?php foreach ($cars as $car): ?>
        <?php $path = $container->getImageRepository()->findOneByCarId($car->getId()); ?>
        <?php if ($firstLetter != $car->getName()[0]): ?>
            <?php $firstLetter = $car->getName()[0]; ?>
            <?php echo $car->getName()[0] . '<br/>' ?>
        <?php endif; ?>
        <a class="btn btn-success"
           href="carPage.php?id=<?php echo $car->getId(); ?>"><?php echo $car->getName(); ?></a>
        <img src="<?php echo $path['path']; ?>" alt="Obrazek auta" class="center"/>
        <hr/>
    <?php endforeach; ?>

</div>

<?php require_once '../widgets/scripts.php'; ?>
</body>
</html>