<?php

namespace Service;

use Model\Car;

class VehicleCompare
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function compareCylinders(Car $car1, Car $car2)
    {
        if ($car1->getNumberOfCylinders() > $car2->getNumberOfCylinders()) {
            return 'green';
        } elseif ($car1->getNumberOfCylinders() < $car2->getNumberOfCylinders()) {
            return 'red';
        } else {
            return '';
        }
    }

    public function compareEngineCapacity(Car $car1, Car $car2)
    {
        if ($car1->getEngineCapacity() > $car2->getEngineCapacity()) {
            return 'green';
        } elseif ($car1->getEngineCapacity() < $car2->getEngineCapacity()) {
            return 'red';
        } else {
            return '';
        }
    }

    public function comparePower(Car $car1, Car $car2)
    {
        if ($car1->getPower() > $car2->getPower()) {
            return 'green';
        } elseif ($car1->getPower() < $car2->getPower()) {
            return 'red';
        } else {
            return '';
        }
    }

    public function compareAcceleration(Car $car1, Car $car2)
    {
        if ($car1->getAcceleration() > $car2->getAcceleration()) {
            return 'red';
        } elseif ($car1->getAcceleration() < $car2->getAcceleration()) {
            return 'green';
        } else {
            return '';
        }
    }

    public function compareSpeed(Car $car1, Car $car2)
    {
        if ($car1->getTopSpeed() > $car2->getTopSpeed()) {
            return 'green';
        } elseif ($car1->getTopSpeed() < $car2->getTopSpeed()) {
            return 'red';
        } else {
            return '';
        }
    }
}
