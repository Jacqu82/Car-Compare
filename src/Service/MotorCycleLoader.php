<?php

namespace Service;

use Model\MotorCycle;

class MotorCycleLoader
{
    private $motorCycleRepository;

    public function __construct(MotorCycleRepository $motorCycleRepository)
    {
        $this->motorCycleRepository = $motorCycleRepository;
    }

    /**
     * @return MotorCycle[]
     */
    public function getAll()
    {
        try {
            $motorCyclesData = $this->motorCycleRepository->findAll();
        } catch (\PDOException $exception) {
            trigger_error('Database Exception! ' . $exception->getMessage());
            $motorCyclesData = [];
        }

        $motorCycles = array();

        foreach ($motorCyclesData as $motorCycleData) {
            $motorCycles[] = $this->createObjectFromData($motorCycleData);
        }

        return $motorCycles;
    }

    /**
     * @param $id
     * @return null|MotorCycle
     */
    public function getOneById($id)
    {
        $motorCycle = $this->motorCycleRepository->findOneById($id);

        return $this->createObjectFromData($motorCycle);
    }

    private function createObjectFromData(array $motorCycleData)
    {
        $motorCycle = (new MotorCycle())
            ->setId($motorCycleData['id'])
            ->setName($motorCycleData['name'])
            ->setNumberOfCylinders($motorCycleData['number_of_cylinders'])
            ->setEngineCapacity($motorCycleData['engine_capacity'])
            ->setPower($motorCycleData['power'])
            ->setAcceleration($motorCycleData['acceleration'])
            ->setTopSpeed($motorCycleData['top_speed'])
            ->setCreatedAt($motorCycleData['created_at']);

        return $motorCycle;
    }
}
