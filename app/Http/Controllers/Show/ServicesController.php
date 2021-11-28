<?php

namespace App\Http\Controllers\Show;

use Auth;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

use App\Helpers;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ServicesController extends Controller
{

    public function index($company_name)
    {

        $services = DB::table("services")
            ->join('seekers','seekers.seeker_id','=','services.seeker_id')
            ->join('job_city','job_city.city_id','=','services.city_id')
            ->join('job_domain','job_domain.domain_id','=','services.domain_id')
            ->where('services.services_id','=',$company_name)
            ->first();


        return view('show.services')
            ->with('services', $services);
    }



}
