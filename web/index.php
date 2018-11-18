<?php

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

    <h1 class="text-center text-uppercase">Porównywarka samochodów</h1>

    <?php foreach ($cars as $car): ?>
        <a class="btn btn-success" href="carPage.php?id=<?php echo $car->getId(); ?>"><?php echo $car->getName(); ?></a>
    <?php endforeach; ?>

</div>
</body>
</html>