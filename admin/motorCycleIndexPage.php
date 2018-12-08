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
$motorCycleLoader = $container->getMotorCycleLoader();
$motorCycles = $motorCycleLoader->getAll();
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
        FlashMessagesService::setFlashMessage('success', $_SESSION['delete']);
        unset($_SESSION['delete']);
    }
    if (isset($_SESSION['validate_success'])) {
        FlashMessagesService::setFlashMessage('success', $_SESSION['validate_success']);
        unset($_SESSION['validate_success']);
    }
    ?>

    <h1 class="text-center text-uppercase">Motorki</h1>

    <?php foreach ($motorCycles as $motorCycle): ?>
        <?php $path = $container->getImageRepository()->findOneByMotorCycleId($motorCycle->getId()); ?>
        <?php if ($firstLetter != $motorCycle->getName()[0]): ?>
            <?php $firstLetter = $motorCycle->getName()[0]; ?>
            <?php echo $motorCycle->getName()[0] . '<br/>' ?>
        <?php endif; ?>
        <a class="btn btn-success" href="../admin/motorCyclePage.php?id=<?php echo $motorCycle->getId(); ?>"><?php echo $motorCycle->getName(); ?></a>
        <img src="<?php echo $path['path']; ?>" alt="Obrazek motorka" class="center" />
        <hr/>
    <?php endforeach; ?>

</div>

<?php require_once '../widgets/scripts.php'; ?>
</body>
</html>