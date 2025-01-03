<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role','gender','birth','phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function roles()
    {
        return $this->hasMany(Role::class,'id', 'role');
    }

    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->where('name', 'like', '%' . $key . '%')
                ->orWhere('email', 'like', '%' . $key . '%')
                ->orWhere('phone', 'like', '%' . $key . '%')
                ->orWhere('gender', 'like', '%' . $key . '%')
                ->orWhereHas('roles', function ($query) use ($key) {
                    $query->where('name', 'like', '%' . $key . '%');
                });
        }
        return $query;
    }

}
