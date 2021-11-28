<?php

namespace App\Http\Controllers\SeekersAuth;

use App\Http\Controllers\Controller;
use App\Jobs\EmailPasswordResetJob;
use App\Seeker;
use Illuminate\Http\Request;
use  DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;
    protected $broker = 'seekers';
    protected $guard = 'seekers';
    protected $passwords = 'seekers';
    protected $table = "seekers";
    protected $redirectTo = '/profile';


    public function __construct(Guard $guard,PasswordBroker $passwords)
    {
        $this->auth = auth()->guard('users');
        $this->user = "seekers";

       $this->broker =  'seekers';
        $this->passwords = $passwords;

        $this->subject = 'Your Password Reset Link'; //  < --JUST ADD THIS LINE
        $this->middleware('guest');
    }

    public function getEmail(){
        if (!(Auth::guard('users')->check()))
            return view('seekers.auth.passwords.email');
        else
            return redirect()->to('/profile');
    }

    public function postEmail(Request $request){

        $this->validate($request, ['email' => 'required']);

        $email = $request->input('email');
      /*  $response = $this->passwords->sendResetLink($request->only('email'), function($message)
        {
            $message->subject('Password Reminder');
        });*/

      $IsValid = false;

        $objSeeker = Seeker::where('email',$email)->first();

        if($objSeeker!=null){
        $token_password = str_random(30);

        DB::table('seekers')->where('seeker_id',$objSeeker->seeker_id)
            ->update([
                'remember_token'=>$token_password
            ]);


            $job = (new EmailPasswordResetJob($objSeeker))->delay(100);
            dispatch($job)->delay(now()->addSecond(10));//onQueue('emails');
            //$job->delete();

            $IsValid=true;
        }

        if ($IsValid) {

            return redirect()->back()->with('status', "تم ارسال رابط استعادة كلمة السر الى بريدك الإلكتروني.");
        }else{

             return redirect()->back()->withErrors(['email' => "خطاء،، حاول مرة أخري."]);
        }

    }

    public function getReset($token){
        return view('seekers.auth.passwords.reset')->with('token',$token);
    }

    public function postReset(Request $request){

         $this->validate($request, [
            'token' => 'required',
             'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $IsValid = false;


        $token = $request->input('token');
        $email = $request->input('email');
        $password = $request->input('password');
        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );


        $objSeeker = DB::table('seekers')
            ->select('seeker_id')
            ->where('remember_token',$token)
            ->where('email',$email)
            ->first();

        if($objSeeker != null)
        {
           $passwordHash = Hash::make($password);
           DB::table('seekers')
               ->where('seeker_id',$objSeeker->seeker_id)
               ->update([
                   'password'=>$passwordHash,
                   'remember_token' =>''
               ]);

            $IsValid=true;
         }

        if($IsValid)
            return redirect('/login')->with('confirm', 'تم تغيير كلمة السر بنجاح.');
        else
            return redirect()->back()->with('error', 'خطاء، الرجاء المحاولة مرة أخري...');


    }
}
