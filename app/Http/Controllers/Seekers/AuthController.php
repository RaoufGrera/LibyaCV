<?php

namespace App\Http\Controllers\Seekers;

use Illuminate\Http\Request;
use App\Http\Controllers\AuthenticatesUsers;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    //
    use AuthenticatesUsers;
    protected  $guard = 'web_seekers';
    protected $redirectTo = 'profile';

    public function index()
    {
        return view('seeker');
    }
}
