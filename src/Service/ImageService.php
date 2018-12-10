<?php

namespace Service;

use Model\Car;
use Model\Image;
use Model\MotorCycle;

class ImageService
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    private function getDirectory($object, $objectId)
    {
        switch (true) {
            case $object instanceof Car:
                return sprintf('../public/content/images/cars/%d/', $objectId);

            case $object instanceof MotorCycle:
                return sprintf('../public/content/images/motorcycles/%d/', $objectId);

            default:
                return false;
        }
    }

    private function getFile($object)
    {
        $filename = $_FILES['image']['name'];
        $filename = $object->getName() . '-' . time() . substr($filename, strpos($filename, '.'));
        $filename = preg_replace('/[\s]/', '-', $filename);

        return $filename;
    }

    private function getFullPath($object, $objectId)
    {
        $filename = $this->getFile($object);
        $path = $this->getDirectory($object, $objectId);
        if (!file_exists($path)) {
            $oldmask = umask(0);
            mkdir($path, 0755);
            umask($oldmask);
        }
        $path .= $filename;

        return $path;
    }

    public function saveImage($object, $objectId)
    {
        $path = $this->getFullPath($object, $objectId);
        $image = (new Image())
            ->setPath($path);

        switch (true) {
            case $object instanceof Car:
                $image->setCarId($objectId);
                break;

            case $object instanceof MotorCycle:
                $image->setMotorCycleId($objectId);
                break;
        }
        $this->container->getImageRepository()->saveToDB($image);
    }

    public function updateImage($object, $objectId)
    {
        $pathToDelete = $this->getPathToDelete($object, $objectId);
        $this->deleteFile($pathToDelete['path']);
        $this->saveFile($object, $objectId);
        $pathDB = $this->getFullPath($object, $objectId);
        $this->container->getImageRepository()->updatePath($pathDB, $pathToDelete['id']);
    }

    public function saveFile($object, $objectId)
    {
        $path = $this->getFullPath($object, $objectId);
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
    }

    private function getPathToDelete($object, $objectId)
    {
        switch (true) {
            case $object instanceof Car:
                $pathToDelete = $this->container->getImageRepository()->findOneByCarId($objectId);
                break;
            case $object instanceof MotorCycle:
                $pathToDelete = $this->container->getImageRepository()->findOneByMotorCycleId($objectId);
                break;

            default:
                return false;
        }

        return $pathToDelete;
    }

    public function deleteFile($path)
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }

    public function deleteEmptyDirectory($object, $objectId)
    {
        $dirToDelete = $this->getDirectory($object, $objectId);
        if (file_exists($dirToDelete)) {
            rmdir($dirToDelete);
        }
    }
}
