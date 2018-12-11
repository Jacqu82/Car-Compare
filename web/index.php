<?php

session_start();

require __DIR__ . '/../autoload.php';

?>


<!DOCTYPE html>
<html lang="pl">

<?php include '../widgets/head.php'; ?>

<body>
<?php include '../widgets/header.php'; ?>

<div class="container text-center">

    <h1 class="text-uppercase">Porównywarka samochodów</h1>
    <a href="carIndexPage.php" class="btn btn-primary">Autka</a>
    <a href="motorCycleIndexPage.php" class="btn btn-success">Motorki</a>
    <a href="selectCars.php" class="btn btn-warning">Porównaj autka</a>
    <a href="selectMotorCycles.php" class="btn btn-danger">Porównaj motorki</a>

</div>

<?php require_once '../widgets/scripts.php'; ?>
</body>
</html>