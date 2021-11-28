<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Admin;
use App\user;
use Illuminate\Support\Facades\Auth;
use DB;
use Mail;
use Hash;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Input;

class AuthController extends Controller
{

    use AuthenticatesUsers; //, ThrottlesLogins;

    protected $guard = 'admins';

    protected $redirectTo = '/administrator';
    public function __construct()
    {
        $this->middleware('guest', ['except' =>  ['logout', 'getLogout']]);
    }

    public function getLogout()
    {
        $admins = auth()->guard('admins');
        $admins->logout();
        return redirect('/administrator/login');

    }

    public function showLoginForm_2()
    {
        return view('admins.auth.login_2');
    }
    public function showLoginForm()
    {
        return view('admins.auth.login');
    }
    public function showRegistrationForm()
    {
        return view('admins.auth.register');
    }


    public function login_post(Request $request)
    {
        $validator = Validator::make(Input::all(), [
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return Redirect::to('/administrator/login')->withInput()->withErrors($validator);
        }



            $admins = auth()->guard('admins');

            if ($admins->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true)) {
                DB::table('admins')
                    ->where('email', $request->input('email'))->update([
                        'last_seen' => date("Y-m-d"),
                    ]);
                return redirect()->intended('/administrator/dashboard');
            } else {
                return redirect()->back()->with('error', 'كلمة السر غير صحيحة.');
            }

    }

    protected function create(array $data)
    {
        return Admin::create([
            'user_name' => $data['name'],
            'email' => $data['email'],

            'password' => bcrypt($data['password']),        ]);
    }
}
