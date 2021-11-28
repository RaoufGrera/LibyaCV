<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desc extends Model
{
    protected $table = "job_description";
    protected $primaryKey ='desc_id';

    protected $fillable = ['desc_id','manager_id','desc_down','job_end','job_start','how_receive','email','phone','website','is_active','domain_id','city_id', 'job_name','job_desc','job_stop'];


}
