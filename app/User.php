<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'userId',
        'appId',
        'name',
        'email',
        'password',
        'status',
        'token',
        'googleId',
        'facebookId',
        'isLogin',
        'photo'
    ];

    protected $hidden = [
        'password',
        'appId'
    ];
}
