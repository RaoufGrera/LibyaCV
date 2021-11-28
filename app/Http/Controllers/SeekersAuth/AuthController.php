<?php

namespace App\Http\Controllers\SeekersAuth;

use App\Jobs\SendEmailJob;
use App\Jobs\SendEmailNew;
use App\Seeker;
use App\user;
use Illuminate\Support\Facades\Auth;
use DB;
 use Mail;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Input;
use Session;
use Carbon\Carbon;
use App\Helpers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
     use AuthenticatesUsers;

    protected $guard = 'users';

    protected $redirectTo = '/profile/dashboard';
    public function __construct()
    {

        $this->middleware('guest', ['except' =>  ['logout', 'getLogout']]);
    }

    public function showRegister(){
        if (Auth::check()) {

            return redirect('/profile/dashboard');
        }
        return view('seekers.auth.register');
    }
    public function getLogout()
    {
        $seekers = auth()->guard('users');
        Session::flush();

        $seekers->logout();
        return redirect('/login');

    }

    public function showSignUp()
    {

        return view('sign-up');
    }

    public function showRegistrationForm()
    {
        return view('seekers.auth.register');
    }


    public function login_post(Request $request)
    {
        $validator = Validator::make(Input::all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return Redirect::to('login')->withInput()->withErrors($validator);
        }


        $seeker = DB::table('seekers')
            ->select('seekers.email','confirmed')
            ->where('seekers.email', '=', $request->input('email'))->first();


        if($seeker ==null)
            return redirect()->back()->with('error', 'البريد الإلكتروني او كلمة السر غير صحيحة');

        if ($seeker->confirmed == 1) {

            $seekers = auth()->guard('users');

            if ($seekers->attempt(['email' => $request->input('email'), 'password' => $request->input('password'),'confirmed' => 1], true)) {
                DB::table('seekers')
                    ->where('email', $request->input('email'))->update([
                        'last_seen' => date("Y-m-d"),
                    ]);


            $id=    Auth::guard('users')->user()->seeker_id;
             //   $request->session()->put('seeker_id', $seekerArray->seeker_id);
                $job_seeker = Helpers::getDataSeeker('seekers',$id,true);

                return redirect()->intended('/profile/dashboard');
            } else {
                return redirect()->back()->with('error', 'البريد الإلكتروني او كلمة السر غير صحيحة');
            }
        }else{
            return redirect()->back()->with('reset','error');
        }
    }

    public function login_get(){


        if (Auth::guard('admins')->check()) {
            return redirect('/administrator/home');

        } else if (Auth::guard('users')->check()) {

            return redirect('/profile/dashboard');
        }

        return view('seekers.auth.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {


       $this->validate($request, [
              'fname' => 'required',
               'email' => 'required|email|unique:seekers',
              'password' => 'required|min:6|confirmed',
          ]);

          $confiremation_code = str_random(30);
          $intRand = rand(200000,2000000);
          $cv = DB::table('seekers')->min('cv_down');
         $cv = $cv-1;

        $domain_type = Helpers::getDataSeeker('job_domain',null,false);
        $i=0;
        foreach ($domain_type as $item){
            $arrDomain[$i] = $item->domain_id;
            $i++;
        }
        $index = mt_rand(0, count($arrDomain) - 1);
          $seeker = Seeker::create([
               'fname'    =>  $request->input('fname'),
               'lname'    => "",
                'user_name'    =>  $cv,
               'email'    =>  $request->input('email'),
              'email1'    =>  $request->input('email'),

              'gender'    =>  $request->input('sex'),
               'password'    =>  Hash::make($request->input('password')),
               'confirmation_code' => $confiremation_code,
               'cv_down' =>$cv,
               'confirmed' =>1,
              'domain_id' =>$arrDomain[$index],
               'updated_at' =>Carbon::now(),
           ]);


       /*$job = (new SendEmailJob($seeker));
       dispatch($job)->delay(now()->addSecond(60));//onQueue('emails');*/
        SendEmailJob::dispatch($seeker)
            ->delay(now()->addSecond(20));

/*  $to = $seeker->email;
        Mail::send('seekers.auth.emails.verify', ['confirmation_code' =>$seeker->confirmation_code], function ($m) use ($to){
            // $m->from($this->seeker->email, 'Lara Job');
            $m->to($to,'Lara job')->subject('تفعيل الحساب');
        });*/

        $seekers = auth()->guard('users');

        if ($seekers->attempt(['email' => $request->input('email'), 'password' => $request->input('password'),'confirmed' => 1], true)) {
            DB::table('seekers')
                ->where('email', $request->input('email'))->update([
                    'last_seen' => date("Y-m-d"),
                ]);


            $id = Auth::guard('users')->user()->seeker_id;
            //   $request->session()->put('seeker_id', $seekerArray->seeker_id);
            $job_seeker = Helpers::getDataSeeker('seekers', $id, true);

            return redirect()->intended('/profile/dashboard');
        }else{
            return redirect('/register')->with('ok', 'الرجاء تفعيل الحساب عن طريق البريد الإلكتروني');


        }
    }

    public function registerEasy(Request $request)
    {

         $fname = $request->input('fname');
        $lname = " ";//$request->input('lname');
        $email = $request->input('email');

        $password = $request->input('password');

        $validator = Validator::make(Input::all(), [
            'email' => 'required|email|unique:seekers',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return redirect('/register')->with('error', 'خطاء في الإدخال');
        }



        $CheckEmail = DB::table('seekers')->select('confirmed')->where('email',$email)->first();


        if($CheckEmail !=null){
            if($CheckEmail->confirmed ==1){
                return redirect('/register')->with('error', 'البريد الإلكتروني مستخدم من قبل الرجاء تسجيل الدخول');


            }else{

                return redirect('/register')->with('error', 'البريد الإلكتروني مستخدم من قبل ويحتاج الي تفعيل من خلال البريد الإلكتروني');

            }
        }



        $info = "الرجاء تفعيل الحساب عن طريق البريد الإلكتروني";



        $minCV= DB::table('seekers')->min('cv_down');

        $domain_type = Helpers::getDataSeeker('job_domain',null,false);
        $i=0;
        foreach ($domain_type as $item){
            $arrDomain[$i] = $item->domain_id;
            $i++;
        }
        $index = mt_rand(0, count($arrDomain) - 1);
        $confiremation_code = str_random(30);
        $intRand = rand(200000,2000000);
         $cv = $minCV-1;
        $seeker = Seeker::create([
            'fname'    =>  $request->input('fname') . " ".$lname,
            'lname'    =>  "",
            'user_name'    =>  $cv,
            'email'    =>  $request->input('email'),
            'gender'    =>  'm',
            'confirmed' =>1,
            'password'    =>  Hash::make($request->input('password')),
            'confirmation_code' => $confiremation_code,
            'cv_down' =>$cv,
            'domain_id' =>$arrDomain[$index],
            'email1'    =>  $request->input('email'),

            'updated_at' =>Carbon::now(),
        ]);

        $job = (new SendEmailJob($seeker))->delay(40);
        dispatch($job)->delay(now()->addSecond(60));//onQueue('emails');
        $job->delete();
        $seekers = auth()->guard('users');

        if ($seekers->attempt(['email' => $request->input('email'), 'password' => $request->input('password'),'confirmed' => 1], true)) {
            DB::table('seekers')
                ->where('email', $request->input('email'))->update([
                    'last_seen' => date("Y-m-d"),
                ]);


            $id = Auth::guard('users')->user()->seeker_id;
            //   $request->session()->put('seeker_id', $seekerArray->seeker_id);
            $job_seeker = Helpers::getDataSeeker('seekers', $id, true);

            return redirect()->intended('/profile/dashboard');
        }else{
            return redirect('/register')->with('ok', 'الرجاء تفعيل الحساب عن طريق البريد الإلكتروني');


        }


     }


    public function confirm($confirmation_code){
        if(!$confirmation_code){
            return "link is Error ";
        }

        $user =  DB::table('seekers')->where('confirmation_code',$confirmation_code)->first();


        if(!$user){
            return "link is not working";
        }

        DB::table('seekers')->where('confirmation_code',$confirmation_code)->update([
            'confirmed' =>1,
            'confirmation_code'=>null,
        ]);

         return Redirect::to('login')->with('confirm', 'تم تفعيل الحساب بنجاح.');;
    }

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:seekers',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return Seeker::create([
            'user_name' => $data['name'],
            'email' => $data['email'],
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'gender' => $data['sex'],
            'password' => bcrypt($data['password']),        ]);
    }
}
