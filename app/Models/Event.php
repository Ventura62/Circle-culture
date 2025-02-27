<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function groups()
    {
        return $this->hasMany(Group::class, 'event_id' );
    }

    public function status()
    {
        return $this->hasOne(EventUpdate::class , 'event_id')->where('user_id', auth()->user()->id);
    }
}
