<?php

namespace Service;

use Model\Admin;
use PDO;

class AdminRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findOneById($id)
    {
        $result = $this->pdo->prepare('SELECT * FROM admin WHERE id = :id');
        $result->bindParam('id', $id, PDO::PARAM_INT);
        $result->execute();
        $admin = $result->fetch(PDO::FETCH_ASSOC);

        if (!$admin) {
            return null;
        }

        return $admin;
    }

    public function findOneByLogin($login)
    {
        $sql = "SELECT * FROM admin WHERE login = :login";

        $result = $this->pdo->prepare($sql);
        $result->bindParam('login', $login, PDO::PARAM_STR);
        $result->execute();

        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            $admin = new Admin();
            $admin
                ->setId($row['id'])
                ->setLogin($row['login'])
                ->setPassword($row['password'])
                ->setCreatedAt($row['created_at']);

            return $admin;
        }

        return false;
    }
}
