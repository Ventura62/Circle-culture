<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function event()
    {
        return $this->belongsTo(Event::class , 'event_id');
    }

    public function restaurant()
    {
        return $this->belongsTo(Resturant::class, 'restaurant_id' );
    }

    public function users()
    {
        return User::whereIn('email', json_decode($this->users, true))->get();
    }
}
