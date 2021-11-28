<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard as Auth;
use Illuminate\Http\RedirectResponse as Redirection;

use App\Http\Requests;
use App\Http\Controllers\Controller;

trait AuthenticatesUsers{

    //
    protected  $guard = 'web_seekers';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function  login(Request $request,Auth $auth)
    {
        $authorized = $auth->attempt($request->only('email','password'));

        if($authorized){
            return redirect()->intended($this->redirectTo);
        }

        return back()
            ->with('authError','Emal no coorec')
            ->withInput($request->except('password'));
    }

    public  function logout(Auth $auth){
        $auth->logout();

        return redirect('/');
    }
}
