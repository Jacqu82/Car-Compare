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
$carLoader = $container->getCarLoader();
$car = $carLoader->getOneById($_GET['id']);
$path = $container->getImageRepository()->findOneByCarId($_GET['id']);
$imageService = new ImageService($container);

//dump($_FILES['image']['error']);die;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] == 'updateImage') {
    if ($_FILES['image']['error'] == 0) {
        $imageService->updateImage($car->getId(), $car->getName());

        $_SESSION['edit_image'] = 'Poprawnie edytowano zdjęcie :)';
        header('Location: carPage.php?id=' . $car->getId());
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

    <img src="<?php echo $path['path']; ?>" alt="Obrazek auta" class="center"/>

    <form action="#" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input type="file" name="image"/>
        </div>
        <input type="hidden" name="action" value="updateImage"/>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Zapisz</button>
        </div>
    </form>
</div>

</body>
</html>