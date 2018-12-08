<?php

session_start();

require __DIR__ . '/../autoload.php';

use Service\Container;
use Service\ImageService;

if (!isset($_SESSION['admin'])) {
    header('Location: ../web/index.php');
    exit();
}

$container = new Container($configuration);
$motorCycleLoader = $container->getMotorCycleLoader();
$motorCycle = $motorCycleLoader->getOneById($_GET['id']);
$path = $container->getImageRepository()->findOneByMotorCycleId($_GET['id']);
$imageService = new ImageService($container);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] == 'updateImage') {
    if ($_FILES['image']['error'] == 0) {
        $imageService->updateImage($motorCycle, $motorCycle->getId());

        $_SESSION['edit_image'] = 'Poprawnie edytowano zdjęcie :)';
        header('Location: motorCyclePage.php?id=' . $motorCycle->getId());
    }
}

?>

<!DOCTYPE html>
<html lang="pl">

<?php include '../widgets/head.php'; ?>

<body>
<?php include '../widgets/header.php'; ?>

<div class="container">
    <h1 class="text-center">Edytuj zdjęcie</h1>

    <img src="<?php echo $path['path']; ?>" alt="Obrazek motorka" class="center"/>

    <?php include_once 'editImageForm.html'; ?>
</div>

</body>
</html>