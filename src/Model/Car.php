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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Car
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Car
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumberOfCylinders()
    {
        return $this->numberOfCylinders;
    }

    /**
     * @param mixed $numberOfCylinders
     * @return Car
     */
    public function setNumberOfCylinders($numberOfCylinders)
    {
        $this->numberOfCylinders = $numberOfCylinders;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEngineCapacity()
    {
        return $this->engineCapacity;
    }

    /**
     * @param mixed $engineCapacity
     * @return Car
     */
    public function setEngineCapacity($engineCapacity)
    {
        $this->engineCapacity = $engineCapacity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * @param mixed $power
     * @return Car
     */
    public function setPower($power)
    {
        $this->power = $power;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAcceleration()
    {
        return $this->acceleration;
    }

    /**
     * @param mixed $acceleration
     * @return Car
     */
    public function setAcceleration($acceleration)
    {
        $this->acceleration = $acceleration;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTopSpeed()
    {
        return $this->topSpeed;
    }

    /**
     * @param mixed $topSpeed
     * @return Car
     */
    public function setTopSpeed($topSpeed)
    {
        $this->topSpeed = $topSpeed;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     * @return Car
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
