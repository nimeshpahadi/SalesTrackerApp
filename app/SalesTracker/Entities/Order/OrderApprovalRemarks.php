<?php

namespace App\SalesTracker\Entities\Order;

use Illuminate\Database\Eloquent\Model;

class OrderApprovalRemarks extends Model
{

    public $table = 'order_approval_remark';
    public $timestamps = false;
    public $fillable = [
        'order_approval_id',
        'user_id',
        'remark',
        'status',
    ];
}
