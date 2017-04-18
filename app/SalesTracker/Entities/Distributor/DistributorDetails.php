<?php

namespace App\SalesTracker\Entities\Distributor;

use Illuminate\Database\Eloquent\Model;

class DistributorDetails extends Model
{
    public $table = 'distributor_details';
    public $timestamps = false;

    public $fillable = [

        'company_name',
        'contact_name',
        'email',
        'mobile',
        'phone',
        'zone',
        'district',
        'latitude',
        'longitude',
        'lead_source',
        'type',
        'open_date',
        'status',
        'vat_no',
        'area_id',
    ];

    public function customerArea()
    {
        return $this->hasOne('App\SalesTracker\Entities\Distributor\CustomerArea', 'id', 'area_id');
    }
}