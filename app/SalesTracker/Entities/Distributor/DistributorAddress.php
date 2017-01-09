<?php

namespace App\SalesTracker\Entities\Distributor;

use Illuminate\Database\Eloquent\Model;

class DistributorAddress extends Model
{
    public $table = 'distributor_addresses';
    public $timestamps = false;

    public $fillable = [

        'type',
        'zone',
        'district',
        'city',
        'latitude',
        'longitude',
        'phone',
        'mobile',
        'fax',
        'distributor_id',

    ];
}