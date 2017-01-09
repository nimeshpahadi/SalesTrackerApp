<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/18/16
 * Time: 2:21 PM
 */

namespace App\SalesTracker\Entities\User;


use Illuminate\Database\Eloquent\Model;

class UserTrack extends Model
{
    public $table = "user_track";

    protected $fillable = [
        'user_id',
        'token',
        'loggedin_date',
        'expired_date',
        'remember_token'
    ];

}