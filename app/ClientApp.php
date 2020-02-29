<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientApp extends Model
{
    protected $table = 'client_apps';
    protected $fillable = [
        'appId',
        'appName',
        'appEmail',
        'appKey'
    ];

    protected $hidden = [
        'appPassword'
    ];

}
