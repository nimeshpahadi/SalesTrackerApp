<?php

namespace App\SalesTracker\Entities\Distributor;

use Illuminate\Database\Eloquent\Model;

class CustomerArea extends Model
{
    public $table = 'customer_areas';

    protected $fillable = [
        'district',
        'area_name',
        'places',
    ];
}
