<?php

namespace App\Http\Controllers\Seekers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PasswordController extends Controller
{
    //
    use ResetsPasswords;
    protected  $guard = 'seekers';
    protected $redirectTo = '/profile';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('seeker');
    }

    public function getEmail()
    {
        return view('seekers.auth.passwords.email');
    }
}
