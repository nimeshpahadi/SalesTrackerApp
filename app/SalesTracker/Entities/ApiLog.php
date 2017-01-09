<?php

namespace App\SalesTracker\Entities;

use Illuminate\Database\Eloquent\Model;

class ApiLog extends Model
{
    public $table = 'api_logs';

    public $fillable = [
        'data',
        'api_token'
    ];
}
