<?php

namespace App\Http\Controllers\Api\Show;

use App\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class CompanyShowController extends Controller
{
    public function showing($user)
    {
        $seeker_id = Auth::user()->seeker_id;


        $myCompany = $company = Helpers::getDataSeeker('seekerCompany', $user, false);


        $company_spec = Helpers::getDataSeeker('spec_company', $company->comp_id, false);


        $myJob = DB::table('job_description')
            ->select('job_description.desc_id', 'job_name', 'companys.comp_id'
                , 'comp_user_name', 'comp_name', 'job_desc', 'job_start', 'job_end'
                , 'job_description.see_it', 'image', 'code_image', 'job_city.city_name', 'job_domain.domain_name')
            ->join('managers', 'managers.manager_id', '=', 'job_description.manager_id')
            ->join('companys', 'companys.comp_id', '=', 'managers.comp_id')
            ->join('job_domain', 'job_domain.domain_id', '=', 'job_description.domain_id')
            ->join('job_city', 'job_city.city_id', '=', 'job_description.city_id')
            ->where('managers.block_admin', 0)
            ->where('job_description.block_admin', 0);
          //  ->where('job_description.job_end', '>=', NOW())
        // if($company->level != "a")
        $myJob = $myJob->where('managers.seeker_id', '=', $seeker_id);
        $myJob = $myJob->where('comp_user_name', '=', $user)
            ->where('managers.block_admin', FALSE)
            ->where('job_description.block_admin', FALSE)
            ->get();


        return view('company.profileCompany')
            ->with('user', $user)
            ->with('myJob', $myJob)
            ->with('myCompany', $myCompany)
            ->with('company_spec', $company_spec)
            ->with('company', $company);
    }

}
