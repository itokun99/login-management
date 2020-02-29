<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientCredential extends Model
{
    protected $table = 'client_credentials';
    protected $fillable = [
        'type',
        'appId',
        'credential'
    ];
}
