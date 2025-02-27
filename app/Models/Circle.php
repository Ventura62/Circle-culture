<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circle extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany(CircleComment::class, 'circle_id');
    } 
    
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
