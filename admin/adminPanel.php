<?php

session_start();

require __DIR__ . '/../autoload.php';

use Service\Container;
use Service\FlashMessagesService;

if (!isset($_SESSION['admin'])) {
    header('Location: ../web/index.php');
    exit();
}
$admin = $container->loggedAdmin();

?>

<!DOCTYPE html>
<html lang="pl">

<?php include '../widgets/head.php'; ?>

<body>
<?php include '../widgets/header.php'; ?>

<div class="container">

    <h1 class="text-center text-uppercase">Witaj <?php echo $admin['login'] ?>!</h1>

    <a class="btn btn-success" href="carIndexPage.php">Autka</a>
    <a class="btn btn-success" href="motorCycleIndexPage.php">Motorki</a>

</div>

<?php require_once '../widgets/scripts.php'; ?>
</body>
</html>