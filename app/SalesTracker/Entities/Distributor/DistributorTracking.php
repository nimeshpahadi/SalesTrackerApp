<?php

namespace App\SalesTracker\Entities\Distributor;

use Illuminate\Database\Eloquent\Model;

class DistributorTracking extends Model
{
    public $table = 'distributor_trackings';
    public $timestamps = false;
    public $fillable = [

        'distributor_id',
        'stage',
        'business_probability',
        'activity',
        'loss_reason',
        'is_our_customer',
        'latitude',
        'longitude',
        'user_id',
        'remark'

    ];
}