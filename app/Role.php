<?php namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    public $table = "roles";


    protected $fillable = [
        'name', 'display_name', 'description'
    ];

}