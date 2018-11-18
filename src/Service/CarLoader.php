<?php

namespace Service;

use Model\Car;

class CarLoader
{
    private $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    /**
     * @return Car[]
     */
    public function getAll()
    {
        try {
            $carsData = $this->carRepository->findAll();
        } catch (\PDOException $exception) {
            trigger_error('Database Exception! ' . $exception->getMessage());
            $carsData = [];
        }

        $cars = array();

        foreach ($carsData as $carData) {
            $cars[] = $this->createCarObjectFromData($carData);
        }

        return $cars;
    }

    /**
     * @param $id
     * @return null|Car
     */
    public function getOneById($id)
    {
        $car = $this->carRepository->findOneById($id);

        return $this->createCarObjectFromData($car);
    }

    private function createCarObjectFromData(array $carData)
    {
        $car = (new Car())
                ->setId($carData['id'])
                ->setName($carData['name'])
                ->setNumberOfCylinders($carData['number_of_cylinders'])
                ->setEngineCapacity($carData['engine_capacity'])
                ->setPower($carData['power'])
                ->setAcceleration($carData['acceleration'])
                ->setTopSpeed($carData['top_speed'])
                ->setCreatedAt($carData['created_at'])
        ;

        return $car;
    }
}
