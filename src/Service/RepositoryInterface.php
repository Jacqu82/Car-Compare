<?php

namespace Service;

use Model\Vehicle;

interface RepositoryInterface
{
    public function saveToDb(Vehicle $object);
    public function update(Vehicle $object);
    public function findAll();
    public function findOneById($id);
    public function delete($id);
}
