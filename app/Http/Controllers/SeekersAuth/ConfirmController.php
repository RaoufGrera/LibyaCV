<?php

namespace App\Http\Controllers\SeekersAuth;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ConfirmController extends Controller
{


    public function getConfirm(){
        if (!(Auth::guard('users')->check()))
            return view('seekers.auth.confirm.email');
        else
            return redirect()->to('/profile');
    }
}
