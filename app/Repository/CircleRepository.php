<?php

namespace App\Repository;

use App\Models\Circle;

class CircleRepository
{
    protected $circle;

    public function __construct(Circle $circle)
    {
        $this->circle = $circle;
    }

    public function all()
    {
        return $this->circle->all();
    }

    public function paginate($perPage = 25 , $order = 'asc')
    {
        return $this->circle->paginate($perPage);
    }

    public function find($id)
    {
        return $this->circle->find($id);
    }

    public function create(array $data)
    {
        return $this->circle->create($data);
    }

    public function update($id, array $data)
    {
        $circle = $this->circle->find($id);

        if ($circle) {
            $circle->update($data);
            return $circle;
        }

        return null;
    }

    public function delete($id)
    {
        $circle = $this->circle->find($id);

        if ($circle) {
            $circle->delete();
            return true;
        }

        return false;
    }
}