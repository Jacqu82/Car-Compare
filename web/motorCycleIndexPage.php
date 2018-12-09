<?php

session_start();

require __DIR__ . '/../autoload.php';

use Service\Container;

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

    <h1 class="text-center text-uppercase">Motorki</h1>

    <?php foreach ($motorCycles as $motorCycle): ?>
        <?php $path = $container->getImageRepository()->findOneByMotorCycleId($motorCycle->getId()); ?>
        <?php if ($firstLetter != $motorCycle->getName()[0]): ?>
            <?php $firstLetter = $motorCycle->getName()[0]; ?>
            <?php echo $motorCycle->getName()[0] . '<br/>' ?>
        <?php endif; ?>
        <a class="btn btn-success"
           href="motorCyclePage.php?id=<?php echo $motorCycle->getId(); ?>"><?php echo $motorCycle->getName(); ?></a>
        <img src="<?php echo $path['path']; ?>" alt="Obrazek motorka" class="center"/>
        <hr/>
    <?php endforeach; ?>

</div>

<?php require_once '../widgets/scripts.php'; ?>
</body>
</html>