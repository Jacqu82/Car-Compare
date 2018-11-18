<?php

namespace Service;

use Model\Car;
use PDO;

class CarRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function saveToDb(Car $car)
    {
        $name = $car->getName();
        $numberOfCylinders = $car->getNumberOfCylinders();
        $engineCapacity = $car->getEngineCapacity();
        $power = $car->getPower();
        $acceleration = $car->getAcceleration();
        $topSpeed = $car->getTopSpeed();

        $sql = "INSERT INTO cars (name, number_of_cylinders, engine_capacity, power, acceleration, top_speed)
                    VALUES (:name, :number_of_cylinders, :engine_capacity, :power, :acceleration, :top_speed)";

        $pdo = $this->pdo;
        $result = $pdo->prepare($sql);
        $result->bindParam('name', $name, PDO::PARAM_STR);
        $result->bindParam('number_of_cylinders', $numberOfCylinders, PDO::PARAM_INT);
        $result->bindParam('engine_capacity', $engineCapacity, PDO::PARAM_INT);
        $result->bindParam('power', $power, PDO::PARAM_INT);
        $result->bindParam('acceleration', $acceleration, PDO::PARAM_STR);
        $result->bindParam('top_speed', $topSpeed, PDO::PARAM_INT);

        $result->execute();

        return true;
    }

    public function update(Car $car)
    {
        $id = $car->getId();
        $name = $car->getName();
        $numberOfCylinders = $car->getNumberOfCylinders();
        $engineCapacity = $car->getEngineCapacity();
        $power = $car->getPower();
        $acceleration = $car->getAcceleration();
        $topSpeed = $car->getTopSpeed();

        $sql = "UPDATE cars SET name = :name,
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
        $result = $this->pdo->prepare('SELECT * FROM cars ORDER BY name');
        $result->execute();
        $cars = $result->fetchAll(PDO::FETCH_ASSOC);

        return $cars;
    }

    public function findOneById($id)
    {
        $result = $this->pdo->prepare('SELECT * FROM cars WHERE id = :id');
        $result->bindParam('id', $id, PDO::PARAM_INT);
        $result->execute();
        $car = $result->fetch(PDO::FETCH_ASSOC);

        if (!$car) {
            return null;
        }

        return $car;
    }

    public function delete($id)
    {
        $result = $this->pdo->prepare("DELETE FROM cars WHERE id = :id");
        $result->bindParam('id', $id, PDO::PARAM_INT);
        $result->execute();

        return true;
    }
}
