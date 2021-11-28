<?php

namespace App\Http\Controllers\Api\Seeker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helpers;
use DB;

class ExperienceController extends Controller
{

    public function show(){
        $seekers_id =Auth::user()->seeker_id;

        $job_seeker = Helpers::getDataSeeker('seekers',$seekers_id,false);
        return response()->json(['gola' => $job_seeker], 200);


    }

    public function save(){

    }
}