<?php

namespace App\Services;

use App\Models\AirlineCompany;

class AirlineCompanyService
{

    private $model;

    public function __construct(AirlineCompany $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }
}
