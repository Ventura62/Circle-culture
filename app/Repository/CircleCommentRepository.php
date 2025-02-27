<?php

namespace App\Repository;

use App\Models\CircleComment;

class CircleCommentRepository
{
    protected $circleComment;

    public function __construct(CircleComment $circleComment)
    {
        $this->circleComment = $circleComment;
    }

    public function all()
    {
        return $this->circleComment->all();
    }

    public function paginate($circle_id, $perPage = 25 , $order = 'asc')
    {
        return $this->circleComment->where('circle_id' , $circle_id)->paginate($perPage);
    }

    public function find($id)
    {
        return $this->circleComment->find($id);
    }

    public function create(array $data)
    {
        return $this->circleComment->create($data);
    }

    public function update($id, array $data)
    {
        $circleComment = $this->circleComment->find($id);

        if ($circleComment) {
            $circleComment->update($data);
            return $circleComment;
        }

        return null;
    }

    public function delete($id)
    {
        $circleComment = $this->circleComment->find($id);

        if ($circleComment) {
            $circleComment->delete();
            return true;
        }

        return false;
    }
}