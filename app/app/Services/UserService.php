<?php

namespace App\Services;

use App\Models\User;

class UserService
{

    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function edit($model, $data)
    {
        foreach ($data as $key => $value) {
            $model->$key = $value;
        }
        $model->save();
        return $model;
    }

    public function create($data)
    {
        $model = $this->model;
        foreach ($data as $key => $value) {
            $model->$key = $value;
        }
        $model->save();
        return $model;
    }
}
