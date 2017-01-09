<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/29/16
 * Time: 12:57 PM
 */

namespace App\SalesTracker\Entities\User;

use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    public $table    = 'user_locations';

    public $fillable = [

        'user_id',
        'latitude',
        'longitude'

    ];
}