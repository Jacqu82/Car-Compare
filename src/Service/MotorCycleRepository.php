<?php

namespace Service;

use Model\Vehicle;
use PDO;

class MotorCycleRepository implements RepositoryInterface
{
    private $pdo;
    private $container;

    public function __construct(PDO $pdo, Container $container)
    {
        $this->pdo = $pdo;
        $this->container = $container;
    }

    public function saveToDb(Vehicle $object)
    {
        $name = $object->getName();
        $numberOfCylinders = $object->getNumberOfCylinders();
        $engineCapacity = $object->getEngineCapacity();
        $power = $object->getPower();
        $acceleration = $object->getAcceleration();
        $topSpeed = $object->getTopSpeed();

        $sql = "INSERT INTO motorcycles (name, number_of_cylinders, engine_capacity, power, acceleration, top_speed)
                    VALUES (:name, :number_of_cylinders, :engine_capacity, :power, :acceleration, :top_speed)";

        $result = $this->pdo->prepare($sql);
        $result->bindParam('name', $name, PDO::PARAM_STR);
        $result->bindParam('number_of_cylinders', $numberOfCylinders, PDO::PARAM_INT);
        $result->bindParam('engine_capacity', $engineCapacity, PDO::PARAM_INT);
        $result->bindParam('power', $power, PDO::PARAM_INT);
        $result->bindParam('acceleration', $acceleration, PDO::PARAM_STR);
        $result->bindParam('top_speed', $topSpeed, PDO::PARAM_INT);
        $result->execute();

        $this->container->getImageService()->saveFile($object, $this->pdo->lastInsertId());
        $this->container->getImageService()->saveImage($object, $this->pdo->lastInsertId());

        return true;
    }

    public function update(Vehicle $object)
    {
        $id = $object->getId();
        $name = $object->getName();
        $numberOfCylinders = $object->getNumberOfCylinders();
        $engineCapacity = $object->getEngineCapacity();
        $power = $object->getPower();
        $acceleration = $object->getAcceleration();
        $topSpeed = $object->getTopSpeed();

        $sql = "UPDATE motorcycles SET name = :name,
                                number_of_cylinders = :number_of_cylinders,
                                engine_capacity = :engine_capacity,
                                power = :power,
                                acceleration = :acceleration,
                                top_speed = :top_speed
                                WHERE id = :id
                                ";

        $result = $this->pdo->prepare($sql);
        $result->bindParam('id', $id, PDO::PARAM_INT);
        $result->bindParam('name', $name, PDO::PARAM_STR);
        $result->bindParam('number_of_cylinders', $numberOfCylinders, PDO::PARAM_INT);
        $result->bindParam('engine_capacity', $engineCapacity, PDO::PARAM_INT);
        $result->bindParam('power', $power, PDO::PARAM_INT);
        $result->bindParam('acceleration', $acceleration, PDO::PARAM_STR);
        $result->bindParam('top_speed', $topSpeed, PDO::PARAM_INT);
        $result->execute();

        return true;
    }

    public function findAll()
    {
        $result = $this->pdo->prepare('SELECT * FROM motorcycles ORDER BY name');
        $result->execute();
        $cars = $result->fetchAll(PDO::FETCH_ASSOC);

        return $cars;
    }

    public function findOneById($id)
    {
        $result = $this->pdo->prepare('SELECT * FROM motorcycles WHERE id = :id');
        $result->bindParam('id', $id, PDO::PARAM_INT);
        $result->execute();
        $motorCycle = $result->fetch(PDO::FETCH_ASSOC);

        if (!$motorCycle) {
            return null;
        }

        return $motorCycle;
    }

    public function delete($id)
    {
        $result = $this->pdo->prepare("DELETE FROM motorcycles WHERE id = :id");
        $result->bindParam('id', $id, PDO::PARAM_INT);
        $result->execute();

        return true;
    }
}
