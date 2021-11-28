<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Employer extends Authenticatable
{
    //
    protected $table = "employers";
    protected $primaryKey ='emp_id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'user_name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
