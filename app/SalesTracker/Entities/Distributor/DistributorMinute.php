<?php

namespace App\SalesTracker\Entities\Distributor;

use Illuminate\Database\Eloquent\Model;

class DistributorMinute extends Model
{
    public $table = 'distributor_minutes';
    public $timestamps = false;

    public $fillable = [

        'report',
        'distributor_id',
        'user_id',
        'latitude',
        'longitude'

    ];
}