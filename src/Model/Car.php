<?php

namespace Model;


class Car
{
    private $id;

    private $name;

    private $numberOfCylinders;

    private $engineCapacity;

    private $power;

    private $acceleration;

    private $topSpeed;

    private $createdAt;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getNumberOfCylinders()
    {
        return $this->numberOfCylinders;
    }

    public function setNumberOfCylinders($numberOfCylinders)
    {
        $this->numberOfCylinders = $numberOfCylinders;

        return $this;
    }

    public function getEngineCapacity()
    {
        return $this->engineCapacity;
    }

    public function setEngineCapacity($engineCapacity)
    {
        $this->engineCapacity = $engineCapacity;

        return $this;
    }

    public function getPower()
    {
        return $this->power;
    }

    public function setPower($power)
    {
        $this->power = $power;

        return $this;
    }

    public function getAcceleration()
    {
        return $this->acceleration;
    }

    public function setAcceleration($acceleration)
    {
        $this->acceleration = $acceleration;

        return $this;
    }

    public function getTopSpeed()
    {
        return $this->topSpeed;
    }

    public function setTopSpeed($topSpeed)
    {
        $this->topSpeed = $topSpeed;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
