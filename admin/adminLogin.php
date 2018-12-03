<?php

session_start();

require __DIR__ . '/../autoload.php';

use Service\Container;

$container = new Container($configuration);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login']) || isset($_POST['password'])) {
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $admin = $container->getAdminRepository()->findOneByLogin($login);
        if (!$admin) {
            $_SESSION['error'] = 'Niepoprawny login lub hasło!';
            header('Location: adminLoginForm.php');
        }
        if ($password === $admin->getPassword()) {
            $_SESSION['admin'] = true;
            $_SESSION['adminId'] = $admin->getId();
            unset($_SESSION['error']);
            header('Location: adminPanel.php');
        } else {
            $_SESSION['error'] = 'Niepoprawny login lub hasło!';
            header('Location: adminLoginForm.php');
        }
    } else {
        header('Location: ../web/index.php');
        exit();
    }
}
