<?php

namespace App\SalesTracker\Entities;

use Illuminate\Database\Eloquent\Model;

class CustomerApproval extends Model
{
    public $table = 'customer_approvals';
    public $fillable = [

        'distributor_id',
        'approval_status',
        'salesmanager',
        'admin',
        'sales_approval',
        'admin_approval',
        'sale_remark',
        'admin_remark',
    ];
}
