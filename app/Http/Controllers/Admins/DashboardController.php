<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;

 use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function showDashBoard(){

        return view('admins.dashboard');
    }
}
