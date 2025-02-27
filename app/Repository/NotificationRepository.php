<?php

namespace App\Repository;


use App\Models\Notification;

class NotificationRepository
{
    protected $notification;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    public function all()
    {
        return $this->notification->all();
    }

    public function paginate($perPage = 25 , $order = 'desc')
    {
        return $this->notification->where('user_id', auth()->user()->id)->orderby('id' , $order)->paginate($perPage);
    }

    public function find($id)
    {
        return $this->notification->find($id);
    }

    public function create(array $data)
    {
        return $this->notification->create($data);
    }

    public function update($id, array $data)
    {
        $notification = $this->notification->find($id);

        if ($notification) {
            $notification->update($data);
            return $notification;
        }

        return null;
    }

    public function delete($id)
    {
        $notification = $this->notification->find($id);

        if ($notification) {
            $notification->delete();
            return true;
        }

        return false;
    }
}