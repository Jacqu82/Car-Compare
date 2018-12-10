<?php

session_start();

require __DIR__ . '/../autoload.php';

use Service\Container;
use Service\FlashMessagesService;

$container = new Container($configuration);
$carLoader = $container->getCarLoader();
$cars = $carLoader->getAll();

$errorMessage = '';
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'same_car':
            $errorMessage = 'Wybierz dwa różne auta!';
            break;
        case 'missing_data':
            $errorMessage = 'Obydwa pola wyboru muszą zostać wybrane!';
            break;
        default:
            $errorMessage = 'There was a disturbance in the force. Try again.';
    }
}

?>


<!DOCTYPE html>
<html lang="pl">

<?php include '../widgets/head.php'; ?>

<body>
<?php include '../widgets/header.php'; ?>

<div class="container text-center">
    <?php if ($errorMessage): ?>
        <div>
            <?php FlashMessagesService::setFlashMessage('danger', $errorMessage); ?>
        </div>
    <?php endif; ?>
    <form method="POST" action="compareCars.php">
        <select class="selects" name="car1">
            <option value="">Wybierz autko</option>
            <?php foreach ($cars as $car): ?>
                <option value="<?php echo $car->getId(); ?>"><?php echo $car->getName(); ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <p class="text-center">porównaj z </p>
        <select class="selects" name="car2">
            <option value="">Wybierz autko</option>
            <?php foreach ($cars as $car): ?>
                <option value="<?php echo $car->getId(); ?>"><?php echo $car->getName(); ?></option>
            <?php endforeach; ?>
        </select>
        <br/>
        <button class="btn btn-md btn-primary center-block" type="submit">Wyślij</button>
    </form>
</div>

<?php require_once '../widgets/scripts.php'; ?>
</body>
</html>