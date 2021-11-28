<?php

namespace App;



use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\SocialAccount;
use Illuminate\Foundation\Auth\User as Authenticatable;
use NotificationChannels\WebPush\HasPushSubscriptions;

class User extends Authenticatable
{
    use  HasApiTokens,Notifiable;
    use HasPushSubscriptions;


    protected $guard = "users";
    protected $table = "seekers";
    protected $primaryKey ='seeker_id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'seeker_id','user_name', 'email', 'password','gender','fname','lname','confirmed','confirmation_code','cv_down'
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
        return $this->hasMany(SocialAccount::class, 'seeker_seeker_id', 'seeker_id');
    }


}
