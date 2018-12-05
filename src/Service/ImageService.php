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

    public function getDirectory($object, $objectId)
    {
        if ($object instanceof Car) {
            return sprintf('../public/content/images/cars/%d/', $objectId);
        } else if ($object instanceof MotorCycle) {
            return sprintf('../public/content/images/motorcycles/%d/', $objectId);
        }

        return false;
    }

    public function saveImage($object, $objectId)
    {
        $path = $this->saveFile($object, $objectId);
        $image = (new Image())
            ->setPath($path);
        if ($object instanceof Car) {
            $image
                ->setCarId($objectId);
        } else if ($object instanceof MotorCycle) {
            $image
                ->setMotorCycleId($objectId);
        }
        $this->container->getImageRepository()->saveToDB($image);
    }

    public function updateImage($carId, $carName)
    {
        $pathToDelete = $this->container->getImageRepository()->findOneByCarId($carId);
        $this->deleteFile($pathToDelete['path']);
        $path = $this->saveFile($carId, $carName);
        $this->container->getImageRepository()->updatePath($path, $pathToDelete['id']);
    }
    public function saveFile($object, $objectId)
    {
        $filename = $_FILES['image']['name'];
        $filename = $object->getName() . '-' . time() . substr($filename, strpos($filename, '.'));
        $filename = preg_replace('/[\s]/', '-', $filename);
        $path = $this->getDirectory($object, $objectId);
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