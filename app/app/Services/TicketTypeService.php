<?php

namespace App\Services;

use App\Models\TicketType;

class TicketTypeService
{

    private $model;

    public function __construct(TicketType $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }
}
