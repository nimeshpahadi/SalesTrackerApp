<?php

namespace App\SalesTracker\Entities\Distributor;

use Illuminate\Database\Eloquent\Model;

class DistributorGuarantee extends Model
{
    public $table = 'distributor_guarantees';
    public $timestamps = false;


    public $fillable = [

        'distributor_id',
        'type',
        'amount',
        'bank_name',
        'cheque_no'

    ];
    public $primaryKey = 'distributor_id';
}
