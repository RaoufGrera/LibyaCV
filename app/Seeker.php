<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Seeker extends Authenticatable
{
    //
 //   use  \Illuminate\Notifications\Notifiable;
    use HasApiTokens,Notifiable;
protected $guard = "users";
    protected $table = "seekers";
    protected $primaryKey ='seeker_id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'user_name', 'email', 'password','gender','fname','lname','confirmation_code','cv_down'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function socialAccounts(){
        return $this->hasMany(SocialAccount::class);
    }
}
