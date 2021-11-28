<?php

namespace App\Http\Controllers\SocialiteAuth;

use App\Helpers;
use App\Http\Controllers\Controller;
use App\SocialAccount;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

     //
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function redirectToProviderGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {

        return $this->providerLogin('facebook');
    }
    public function handleProviderCallbackGoogle()
    {

        return $this->providerLogin('google');
    }
    private function providerLogin($userProvider){
        if($userProvider== 'google')
             $user = Socialite::driver($userProvider)->stateless()->user();
        else
            $user = Socialite::driver($userProvider)->stateless()->user();

       // dd($user);


        $email = $user->email;
        $name = $user->name;
        $providerID = $user->id;
        $socialAccount = SocialAccount::where('provider',$userProvider)->where('provider_seeker_id', $providerID)->first();


        if($socialAccount ==null){
            $userFromDB = User::where('email',$email)->first();

            if($userFromDB){

                $this->addSocialAccountToUser($user,$userFromDB,$userProvider);
            }else{
                $this->createUserAccount($user,$userProvider);

                try{

                }catch (\Exception $e){
                    return response("Error, Entry leater",422);
                }
            }

            $socialAccount = SocialAccount::where('provider',$userProvider)->where('provider_seeker_id', $providerID)->first();


        }

        if ($socialAccount !=null) {

            $seekers = auth()->guard('users');
            $user = User::find($socialAccount->seeker_seeker_id);

           // $s= Auth::loginUsingId($socialAccount->seeker_seeker_id);
          //  $seekers->login($user);
            Auth::guard('users')->login($user);

          /*  if (Auth::guard('users')->attempt($user)) {
                return redirect()->intended('/profile');

            }
           // $s= Auth::loginUsingId($socialAccount->seeker_seeker_id,true);*/
            $seekers = auth()->guard('users');


            $id=   Auth::guard('users')->user()->seeker_id;
           Helpers::getDataSeeker('seekers',$id,true);

            return redirect()->intended('/profile/dashboard');


         //   $id=   $seekers->seeker_id;


            //   $request->session()->put('seeker_id', $seekerArray->seeker_id);


         //   $job_seeker = Helpers::getDataSeeker('seekers',$id,true);

        //    return redirect()->intended('/profile/dashboard');
          /*  if ($seekers->attempt(['email' =>$email, 'password' => "back!!upload!!back",'confirmed' => 1], true)) {
                DB::table('seekers')
                    ->where('email', $email)->update([
                        'last_seen' => date("Y-m-d"),
                    ]);


                $id=    Auth::guard('users')->user()->seeker_id;
                //   $request->session()->put('seeker_id', $seekerArray->seeker_id);


                $job_seeker = Helpers::getDataSeeker('seekers',$id,true);

                return redirect()->intended('/profile');
            } else {
                return redirect()->back()->with('error', 'البريد الإلكتروني او كلمة السر غير صحيحة');
            }*/
        }else{
            return redirect()->back()->with('reset','error');
        }

      //  return $user->name;

    }

    private function addSocialAccountToUser($request,User $user,$provider){

        /*$this->validate($request,[
            'provider' => ['required',Rule::unique('social_accounts')->where(function ($query) use ($user){
                return $query->where('seeker_seeker_id',$user->seeker_id);
            })],
        ]);
*/

        $result = DB::table('social_accounts')->where('provider',$provider)
             ->where('provider_seeker_id',$request->id)
            ->where('seeker_seeker_id',$user->seeker_id)
            ->first();

        /*  DB::table('social_accounts')->insert([
                'provider_seeker_id' => $request->id,
                'seeker_seeker_id' => $user->seeker_id,
                'provider' => $request->provider,
                'created_at' =>Carbon::now(),
                'updated_at' =>Carbon::now(),
            ]);*/
        if($result ==null){

        $user->socialAccounts()->create([
            'provider' => $provider,
            'provider_seeker_id' => $request->id
        ]);
        }


    }

    private function createUserAccount( $request,$provider){




        DB::transaction(function() use($request,$provider){
            $userProvider = $provider;
            $email = ($request->email !=null) ?$request->email :$request->id;
            if($request->gender ="male")
                $gender = "m";
                    else
                        $gender="f";
            $cv = DB::table('seekers')->min('cv_down');
            $cv = $cv-1;
            $user = User::create([
                'user_name' =>$cv,
                'email' =>$email,
                'email1'    =>  $email,

                'password' =>  Hash::make('back!!upload!!back'),
                'fname' =>$request->name,
                'gender' =>$gender,
                'lname'=>"",
                'confirmed'=>1,

                'cv_down' =>$cv,
                'updated_at' =>Carbon::now()->subDays(15),
            ]);

            $this->addSocialAccountToUser($request,$user,$userProvider);
        });
    }

}
