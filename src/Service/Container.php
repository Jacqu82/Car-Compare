<?php

namespace Service;

use PDO;

class Container
{
    private $configuration;

    private $pdo;

    private $carLoader;

    private $carRepository;

    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @return PDO
     */
    public function getPDO()
    {
        if ($this->pdo === null) {
            $this->pdo = new PDO(
                $this->configuration['db_dsn'],
                $this->configuration['db_user'],
                $this->configuration['db_pass']
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $this->pdo;
    }

    /**
     * @return CarLoader
     */
    public function getCarLoader()
    {
        if ($this->carLoader === null) {
            $this->carLoader = new CarLoader($this->getCarRepository());
        }

        return $this->carLoader;
    }

    /**
     * @return CarRepository
     */
    public function getCarRepository()
    {
        if ($this->carRepository === null) {
            $this->carRepository = new CarRepository($this->getPDO());
        }

        return $this->carRepository;
    }
}