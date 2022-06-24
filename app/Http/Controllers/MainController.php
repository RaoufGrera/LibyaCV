<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{

     public function emeyprivacy()
    {
     
        return view('main.emeyprivacy');
    }
    public function policy(){

        return view('main.policy');
    }
    public function donate(){

        return view('main.donate');
    }
    public function terms(){

       return view('main.terms');
    }

    public function dashboard(){


        return view('seekers.dashboard');
    }
}
