<?php

namespace Service;

interface LoaderInterface
{
    public function getAll();
    public function getOneById($id);
}
