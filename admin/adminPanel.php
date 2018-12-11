<?php

session_start();

require __DIR__ . '/../autoload.php';

use Service\Container;

if (!isset($_SESSION['admin'])) {
    header('Location: ../web/index.php');
    exit();
}
$container = new Container($configuration);
$admin = $container->loggedAdmin();

?>

<!DOCTYPE html>
<html lang="pl">

<?php include '../widgets/head.php'; ?>

<body>
<?php include '../widgets/header.php'; ?>

<div class="container text-center">

    <h1 class="text-uppercase">Witaj <?php echo $admin['login'] ?>!</h1>

    <a href="carIndexPage.php" class="btn btn-primary">Autka</a>
    <a href="motorCycleIndexPage.php" class="btn btn-success">Motorki</a>
    <a href="../admin/createMotorCycle.php" class="btn btn-warning">Dodaj motor do bazy</a>
    <a href="../admin/createCar.php" class="btn btn-danger">Dodaj samochód do bazy</a>

</div>

<?php require_once '../widgets/scripts.php'; ?>
</body>
</html>