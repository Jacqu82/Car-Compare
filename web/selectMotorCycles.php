<?php

session_start();

require __DIR__ . '/../autoload.php';

use Service\Container;
use Service\FlashMessagesService;

$container = new Container($configuration);
$motorCycleLoader = $container->getMotorCycleLoader();
$motorCycles = $motorCycleLoader->getAll();

$errorMessage = '';
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'same_motorCycle':
            $errorMessage = 'Wybierz dwa różne motorki!';
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
    <form method="POST" action="compareMotorCycles.php">
        <select class="selects" name="motorCycle1">
            <option value="">Wybierz motorek</option>
            <?php foreach ($motorCycles as $motorCycle): ?>
                <option value="<?php echo $motorCycle->getId(); ?>"><?php echo $motorCycle->getName(); ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <p class="text-center">porównaj z </p>
        <select class="selects" name="motorCycle2">
            <option value="">Wybierz motorek</option>
            <?php foreach ($motorCycles as $motorCycle): ?>
                <option value="<?php echo $motorCycle->getId(); ?>"><?php echo $motorCycle->getName(); ?></option>
            <?php endforeach; ?>
        </select>
        <br/>
        <button class="btn btn-md btn-primary center-block" type="submit">Wyślij</button>
    </form>
</div>

<?php require_once '../widgets/scripts.php'; ?>
</body>
</html>