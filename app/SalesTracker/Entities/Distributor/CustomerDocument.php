<?php

namespace App\SalesTracker\Entities\Distributor;

use Illuminate\Database\Eloquent\Model;

class CustomerDocument extends Model
{
    public $table = 'customer_documents';

    protected $fillable = [
        'customer_id',
        'document_type',
        'document_name',
    ];
}
