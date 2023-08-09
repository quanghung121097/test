<?php

namespace App\Services;

use App\Models\Ticket;

class TicketService
{

    private $model;

    public function __construct(Ticket $model)
    {
        $this->model = $model;
    }


    public function search($data)
    {
        $query = $this->model;
        if (isset($data['with']) && count($data['with']) > 0) {
            $query = $query->with($data['with']);
        }
        if (isset($data['select']) && count($data['select']) > 0) {
            $query = $query->select($data['select']);
        }
        if (isset($data['conditions']) && count($data['conditions']) > 0) {
            $conditions = $data['conditions'];
            foreach ($conditions as $condition) {
                $operation = isset($condition['operation']) ? $condition['operation'] : '=';
                switch ($operation) {
                    case 'like':
                        $query = $query->where($condition['key'], 'like', '%' . $condition['value'] . '%');
                        break;
                    case 'in':
                        $query = $query->whereIn($condition['key'], $condition['value']);
                        break;
                    case 'between':
                        $query = $query->whereBetween($condition['key'], [(int)$condition['value']['start'], (int)$condition['value']['end']]);
                        break;
                    case '=':
                        $query = $query->where($condition['key'], $condition['value']);
                        break;
                    default:
                        $query = $query->where($condition['key'], $operation, $condition['value']);
                }
            }
        }
        if (isset($data['sortBy']) && $data['sortBy'] != '') {
            $query = $query->orderBy($data['sortBy'], isset($data['sortOrder']) ? $data['sortOrder'] : 'DESC');
        }
        if ($data['paginate'] ?? false) {
            $data = $query->paginate(isset($data['limit']) ? (int)$data['limit'] : config('const.item_count'));
        } else {
            $data = $query->limit(isset($data['limit']) ? (int)$data['limit'] : config('const.item_count'))->get();
        }
        return $data;
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

    public function first($data)
    {
        $query = $this->model;
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $query = $query->whereIn($key, $value);
            } else {
                $query = $query->where($key, $value);
            }
        }
        $data = $query->first();
        return $data;
    }

    public function edit($model, $data)
    {
        foreach ($data as $key => $value) {
            $model->$key = $value;
        }
        $model->save();
        return $model;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }
}
