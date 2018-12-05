<?php

namespace Service;

use Model\MotorCycle;
use PDO;

class MotorCycleRepository
{
    private $pdo;
    private $container;

    public function __construct(PDO $pdo, Container $container)
    {
        $this->pdo = $pdo;
        $this->container = $container;
    }

    public function saveToDb(MotorCycle $motorCycle)
    {
        $name = $motorCycle->getName();
        $numberOfCylinders = $motorCycle->getNumberOfCylinders();
        $engineCapacity = $motorCycle->getEngineCapacity();
        $power = $motorCycle->getPower();
        $acceleration = $motorCycle->getAcceleration();
        $topSpeed = $motorCycle->getTopSpeed();

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

        $this->container->getImageService()->saveFile($motorCycle, $this->pdo->lastInsertId());
        $this->container->getImageService()->saveImage($motorCycle, $this->pdo->lastInsertId());

        return true;
    }

    public function update(MotorCycle $motorCycle)
    {
        $id = $motorCycle->getId();
        $name = $motorCycle->getName();
        $numberOfCylinders = $motorCycle->getNumberOfCylinders();
        $engineCapacity = $motorCycle->getEngineCapacity();
        $power = $motorCycle->getPower();
        $acceleration = $motorCycle->getAcceleration();
        $topSpeed = $motorCycle->getTopSpeed();

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
