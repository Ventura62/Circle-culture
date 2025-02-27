<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable , Billable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'has_submitted',
        'has_paid',
        'city',
        'profile_pic'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function group()
    {
        $group =  Group::whereJsonContains('users', $this->email)->orderby('id' , 'desc')->first();

        if(auth()->user()->type == "client" && isset($group->event) && $group->event->time == auth()->user()->submission->booking_date){
            return $group;
        }

        return null;
    }

    public function submission()
    {
        return $this->hasOne(Submission::class , 'user_id');
    }

    public function subscribed()
    {
        if(auth()->user()->subscription('default') && auth()->user()->subscription('default')->valid())
        {
            return true;
        }

        return false;
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class , 'user_id')->where('is_read', 0);
    }

    /**
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
