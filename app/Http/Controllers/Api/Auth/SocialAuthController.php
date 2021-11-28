<?php

namespace App\Http\Controllers\Api\Auth;

use App\Seeker;
use App\Helpers;
use App\SocialAccount;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Laravel\Passport\Client;
use DB;
use Hash;


class SocialAuthController extends Controller
{

    use IssueTokenTrait;

    private  $client;

    public function  __construct()
    {
    $this->client=Client::find(2);
    }

    public function socialAuth(Request $request){

        $this->validate($request,[
            'name' => 'required',
            'email' =>'nullable',
            'provider' => 'required|in:facebook,twitter,google',
            'provider_seeker_id' => 'required'
        ]);



        $socialAccount = SocialAccount::where('provider',$request->provider)->where('provider_seeker_id', $request->provider_seeker_id)->first();

        if($socialAccount){

            return $this->issueToken($request,'social');
        }

        $user = User::where('email',$request->email)->first();

        if($user){

            $this->addSocialAccountToUser($request,$user);
        }else{

            try{

                $this->createUserAccount($request);
            }catch (\Exception $e){
                return response("Error, Entry leater",422);
            }
        }

        return $this->issueToken($request,'social');
    }


    private function addSocialAccountToUser(Request $request,User $user){

        $result = DB::table('social_accounts')->where('provider',$request->provider)
            ->where('provider_seeker_id',$request->provider_seeker_id)
            ->where('seeker_seeker_id',$user->seeker_id)
            ->first();
       /* $this->validate($request,[
            'provider' => ['required',Rule::unique('social_accounts')->where(function ($query) use ($user){
                return $query->where('seeker_seeker_id',$user->seeker_id);
            })],
        ]);*/

        if($result ==null) {
            $user->socialAccounts()->create([
                'provider' => $request->provider,
                'provider_seeker_id' => $request->provider_seeker_id
            ]);
        }


    }

    private function createUserAccount(Request $request){
        DB::transaction(function() use($request){
        $gender = "m";
             $i=0;

            $cv = DB::table('seekers')->min('cv_down');
            $cv = $cv-1;
            $user = User::create([
                'user_name' =>$request->provider_seeker_id,
                'email' =>$request->email,
                'fname' =>$request->name,
                'email1' => $request->email,

                'password' =>  Hash::make('back!!upload!!back'),
                'gender' =>$gender,
                 'lname'=>"",
                 'confirmed'=>1,
                'cv_down' =>$cv,
                'updated_at' =>Carbon::now()->subDays(15),
            ]);




            $this->addSocialAccountToUser($request,$user);
        });


    }
}
