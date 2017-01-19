<?php

namespace App\SalesTracker\Entities ;

use Illuminate\Database\Eloquent\Model;

class CustomerApprovalRemarks extends Model
{
    public $table = 'customer_approval_remarks';
    public $fillable = [

        'customer_approval_id',
        'user_id',
        'status',
        'remarks',
    ];
}
