<?php

namespace Model;


class Image
{
    private $id;

    private $carId;

    private $motorCycleId;

    private $path;

    private $createdAt;

    public function getId()
    {
        return $this->id;
    }

    public function getCarId()
    {
        return $this->carId;
    }

    public function setCarId($carId)
    {
        $this->carId = $carId;

        return $this;
    }

    public function getMotorCycleId()
    {
        return $this->motorCycleId;
    }

    public function setMotorCycleId($motorCycleId)
    {
        $this->motorCycleId = $motorCycleId;

        return $this;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;

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
