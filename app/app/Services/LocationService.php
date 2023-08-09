<?php

namespace App\Services;

use App\Models\location;

class LocationService
{

    private $model;

    public function __construct(Location $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }
}
