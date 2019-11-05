<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','created_at', 'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];


    public function domains()
    {
        return $this->hasMany('App\Domain');
    }

    public function records()
    {
        return $this->hasManyThrough('App\RecordType', 'App\Domain');
    }
    public function verifyPasswordOrThrowException($password){
        if (!Hash::check($password, $this->password)) {
            throw new \Exception('Email or password is incorrect');
        }
    }
    public function scopeIsExist($query,$email)
    {
        return $query->where('email', $email);
    }
}
