<?php

use Service\FlashMessagesService;

session_start();

require __DIR__ . '/../autoload.php';

?>

<!DOCTYPE html>
<html lang="pl">

<?php include '../widgets/head.php'; ?>

<body>
<?php include '../widgets/header.php'; ?>

<div class="container">
    <?php
    if (isset($_SESSION['error'])) {
        FlashMessagesService::setFlashMessage('danger', $_SESSION['error']);
        unset($_SESSION['error']);
    }
    ?>
    <h2>Zaloguj się jako Administrator</h2>
    <hr/>
    <form method="POST" action="adminLogin.php">
        <div class="form-group">
            <label for="login">Login</label>
            <input type="text" name="login" id="login" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="password">Hasło</label>
            <input type="password" name="password" id="password" class="form-control"/>
        </div>
        <div>
            <button type="submit" class="btn btn-success">Zaloguj się</button>
        </div>
    </form>
</div>

<?php require_once '../widgets/scripts.php'; ?>

</body>
</html>