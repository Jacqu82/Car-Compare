<?php

namespace Service;

use Model\Car;
use Model\Image;

class ImageService
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function saveImage(Car $car, $carId)
    {
        $carName = $car->getName();
        $path = $this->saveFile($carId, $carName);
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
        $image = (new Image())
            ->setCarId($carId)
            ->setPath($path);
        $this->container->getImageRepository()->saveToDB($image);
    }

    public function updateImage($carId, $carName)
    {
        $pathToDelete = $this->container->getImageRepository()->findOneByCarId($carId);
        $this->deleteFile($pathToDelete['path']);

        $path = $this->saveFile($carId, $carName);
        $this->container->getImageRepository()->updatePath($path, $pathToDelete['id']);
    }

    private function saveFile($carId, $carName)
    {
        $filename = $_FILES['image']['name'];
        $filename = $carName . '-' . time() . substr($filename, strpos($filename, '.'));
        $filename = preg_replace('/[\s]/', '-', $filename);
        $path = '../public/content/images/' . $carId . '/';
        if (!file_exists($path)) {
            $oldmask = umask(0);
            mkdir($path, 0777);
            umask($oldmask);
        }
        $path .= $filename;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);

        return $path;
    }

    public function deleteFile($path)
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }

    public function deleteEmptyDirectory($carId)
    {
        $dirToDelete = '../public/content/images/' . $carId;

        if (file_exists($dirToDelete)) {
            rmdir($dirToDelete);
        }
    }
}