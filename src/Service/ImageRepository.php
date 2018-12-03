<?php

namespace Service;

use Model\Image;
use PDO;

class ImageRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function saveToDB(Image $image)
    {
        $carId = $image->getCarId();
        $path = $image->getPath();

        $sql = "INSERT INTO images (car_id, path) VALUES (:car_id, :path)";
        $result = $this->pdo->prepare($sql);

        $result->bindParam('car_id', $carId, PDO::PARAM_INT);
        $result->bindParam('path', $path, PDO::PARAM_STR);
        $result->execute();

        return true;
    }

    public function updatePath($imagePath, $imageId)
    {
        $sql = "UPDATE images SET path = :path WHERE id = :image_id";
        $result = $this->pdo->prepare($sql);

        $result->bindParam('image_id', $imageId, PDO::PARAM_INT);
        $result->bindParam('path', $imagePath, PDO::PARAM_STR);
        $result->execute();

        return true;
    }

    public function findOneByCarId($id)
    {
        $result = $this->pdo->prepare('SELECT id, path FROM images WHERE car_id = :id');
        $result->bindParam('id', $id, PDO::PARAM_INT);
        $result->execute();
        $path = $result->fetch(PDO::FETCH_ASSOC);

        if (!$path) {
            return null;
        }

        return $path;
    }
}
