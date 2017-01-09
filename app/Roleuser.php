<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Roleuser extends Model
{
    public $table = "role_user";


    public $primaryKey = "user_id";

    protected $fillable = [
        'role_id', 'user_id'
    ];


}
