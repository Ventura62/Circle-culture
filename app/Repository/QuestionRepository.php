<?php

namespace App\Repository;

use App\Models\Question;

class QuestionRepository
{
    protected $question;

    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    public function all()
    {
        return $this->question->all();
    }

    public function paginate($perPage = 25 , $order = 'asc')
    {
        return $this->question->orderby('field_order' , $order)->paginate($perPage);
    }

    public function find($id)
    {
        return $this->question->find($id);
    }

    public function create(array $data)
    {
        return $this->question->create($data);
    }

    public function update($id, array $data)
    {
        $question = $this->question->find($id);

        if ($question) {
            $question->update($data);
            return $question;
        }

        return null;
    }

    public function delete($id)
    {
        $question = $this->question->find($id);

        if ($question) {
            $question->delete();
            return true;
        }

        return false;
    }
}