<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers;
use App\Jobs\SendEmailJob;
use App\Seeker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;
use Hash;
use Validator;
//vvv
class SeekerAuthController extends Controller
{

    use IssueTokenTrait;

    private $client;

    public function __construct()
    {
        $this->client= Client::find(2);
    }

    
    public function  register2(Request $request){
        $validatedDataEmail = Validator::make($request->all(), [

            'email' => 'required|unique:seekers',

        ]);
        $validatedData =Validator::make($request->all(), [
           
            'password' => 'required|min:6',
        ]);


        if($validatedData->fails())
            return response()->json(['AccessToken'=>"خطاء في ادخال البيانات."],201,[],JSON_NUMERIC_CHECK);

        if($validatedDataEmail->fails())
            return response()->json(['AccessToken'=>"البريد الإلكتروني او رقم الهاتف مستخدم من قبل."],201,[],JSON_NUMERIC_CHECK);


        $domain_type = Helpers::getDataSeeker('job_domain',null,false);
        $i=0;
        foreach ($domain_type as $item){
            $arrDomain[$i] = $item->domain_id;
            $i++;
        }
        $index = mt_rand(0, count($arrDomain) - 1);
        $confiremation_code = str_random(30);
        $intRand = rand(200000,2000000);
        $cv = DB::table('seekers')->min('cv_down');
        $cv = $cv-1;
        $seeker = Seeker::create([
             'lname' => "",
            'fname' => "مستخدم جديد",
            'user_name'    =>   $cv,

            'email' => request('email'),
            'email1' => request('email'),

            'password' => Hash::make(request('password')),
            'confirmed'=>1,

            'confirmation_code' => $confiremation_code,
               'cv_down' =>$cv,
               'domain_id' =>$arrDomain[$index],
               'updated_at' =>Carbon::now()->subDays(15),
        ]);

        SendEmailJob::dispatch($seeker)
            ->delay(now()->addSecond(20));

            return $this->issueToken($request,'password');

      //  return response()->json(['message'=>"تم انشاء حساب بنجاح، الرجاء تسجيل الدخول."],200,[],JSON_NUMERIC_CHECK);


      // return $this->issueToken($request,'password');


     }
    public function  register(Request $request){
        $validatedDataEmail = Validator::make($request->all(), [

            'email' => 'required|email|unique:seekers',

        ]);
        $validatedData =Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required|min:6',
        ]);


        if($validatedData->fails())
            return response()->json(['message'=>"خطاء في ادخال البيانات."],200,[],JSON_NUMERIC_CHECK);

        if($validatedDataEmail->fails())
            return response()->json(['message'=>"البريد الإلكتروني مستخدم من قبل."],200,[],JSON_NUMERIC_CHECK);


        $domain_type = Helpers::getDataSeeker('job_domain',null,false);
        $i=0;
        foreach ($domain_type as $item){
            $arrDomain[$i] = $item->domain_id;
            $i++;
        }
        $index = mt_rand(0, count($arrDomain) - 1);
        $confiremation_code = str_random(30);
        $intRand = rand(200000,2000000);
        $cv = DB::table('seekers')->min('cv_down');
        $cv = $cv-1;
        $seeker = Seeker::create([
             'lname' => "",
            'fname' => request('name'),
            'user_name'    =>   $cv,

            'email' => request('email'),
            'email1' => request('email'),

            'password' => Hash::make(request('password')),
            'confirmed'=>1,

            'confirmation_code' => $confiremation_code,
               'cv_down' =>$cv,
               'domain_id' =>$arrDomain[$index],
               'updated_at' =>Carbon::now()->subDays(15),
        ]);

        SendEmailJob::dispatch($seeker)
            ->delay(now()->addSecond(20));

          //  return $this->issueToken($request,'password');

        return response()->json(['message'=>"تم انشاء حساب بنجاح، الرجاء تسجيل الدخول."],200,[],JSON_NUMERIC_CHECK);


      // return $this->issueToken($request,'password');


     }


    public function login(Request $request){

        $this->validate($request,[

            'username' => 'required',

        ]);

        return $this->issueToken($request,'password');

    }

    public function refresh(Request $request){

        $this->validate($request,[

            'refresh_token' => 'required',

        ]);
        return $this->issueToken($request,'refresh_token');


    }

    public function logout(Request $request){


        $accessToken = Auth::guard('api')->user()->token();

        DB::table('oauth_access_tokens')
            ->where('id',$accessToken->id)
            ->update(['revoked' => true]);

        $accessToken->revoke();

        return response()->json([],204);
/* if (Auth::check()) {
            Auth::guard('api')->user->AauthAcessToken()->delete();
        }
        return response()->json([],204);*/

    }
}
