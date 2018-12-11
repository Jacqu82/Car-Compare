<?php

namespace Service;

use Model\Vehicle;

class VehicleCompare
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param Vehicle $vehicle1
     * @param Vehicle $vehicle2
     * @return string
     */
    public function compareCylinders($vehicle1, $vehicle2)
    {
        if ($vehicle1->getNumberOfCylinders() > $vehicle2->getNumberOfCylinders()) {
            return 'green';
        } elseif ($vehicle1->getNumberOfCylinders() < $vehicle2->getNumberOfCylinders()) {
            return 'red';
        } else {
            return '';
        }
    }

    /**
     * @param Vehicle $vehicle1
     * @param Vehicle $vehicle2
     * @return string
     */
    public function compareEngineCapacity($vehicle1, $vehicle2)
    {
        if ($vehicle1->getEngineCapacity() > $vehicle2->getEngineCapacity()) {
            return 'green';
        } elseif ($vehicle1->getEngineCapacity() < $vehicle2->getEngineCapacity()) {
            return 'red';
        } else {
            return '';
        }
    }

    /**
     * @param Vehicle $vehicle1
     * @param Vehicle $vehicle2
     * @return string
     */
    public function comparePower($vehicle1, $vehicle2)
    {
        if ($vehicle1->getPower() > $vehicle2->getPower()) {
            return 'green';
        } elseif ($vehicle1->getPower() < $vehicle2->getPower()) {
            return 'red';
        } else {
            return '';
        }
    }

    /**
     * @param Vehicle $vehicle1
     * @param Vehicle $vehicle2
     * @return string
     */
    public function compareAcceleration($vehicle1, $vehicle2)
    {
        if ($vehicle1->getAcceleration() > $vehicle2->getAcceleration()) {
            return 'red';
        } elseif ($vehicle1->getAcceleration() < $vehicle2->getAcceleration()) {
            return 'green';
        } else {
            return '';
        }
    }

    /**
     * @param Vehicle $vehicle1
     * @param Vehicle $vehicle2
     * @return string
     */
    public function compareSpeed($vehicle1, $vehicle2)
    {
        if ($vehicle1->getTopSpeed() > $vehicle2->getTopSpeed()) {
            return 'green';
        } elseif ($vehicle1->getTopSpeed() < $vehicle2->getTopSpeed()) {
            return 'red';
        } else {
            return '';
        }
    }
}
