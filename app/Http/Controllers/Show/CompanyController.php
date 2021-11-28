<?php

namespace App\Http\Controllers\Show;

use Auth;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

use App\Helpers;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    //
    public function index($company_name)
    {

        $seeker_id = session('seeker_id');
        $company_name = str_replace("_", "-", $company_name);

        $myCompany=$company =  DB::table('companys')
            ->select('companys.comp_id','comp_name', 'comp_user_name','services','managers.block_admin'
                ,'level','image','code_image','cover','code_cover','see_it',
                'facebook',  'twitter',  'linkedin','website','url','comp_desc'
                ,'lng','lat','address','email','comp_desc','domain_id','city_id','compt_id',
                'phone','managers.seeker_id','domain_name','compt_name','city_name')
            ->join('managers', 'managers.comp_id', '=', 'companys.comp_id')
            ->where('companys.comp_user_name', '=', $company_name)
            ->first();

            if($myCompany == null){
                $company_name = str_replace("-", "_", $company_name);
                $myCompany=$company =  DB::table('companys')
                ->select('companys.comp_id','comp_name', 'comp_user_name','services','managers.block_admin'
                    ,'level','image','code_image','cover','code_cover','see_it',
                    'facebook',  'twitter',  'linkedin','website','url','comp_desc'
                    ,'lng','lat','address','email','comp_desc','domain_id','city_id','compt_id',
                    'phone','managers.seeker_id','domain_name','compt_name','city_name')
                ->join('managers', 'managers.comp_id', '=', 'companys.comp_id')
                ->where('companys.comp_user_name', '=', $company_name)
                ->first();
            }

        if($myCompany == null )
            return view('errors.404');

         $company_spec = Helpers::getDataSeeker('spec_company', $company->comp_id, false);


        $myJob = DB::table('job_description')
            ->select('job_description.desc_id','job_name','companys.comp_id','desc_down'
                ,'comp_user_name','comp_name','job_desc','job_start','job_end'
                ,'job_description.see_it','image','code_image','job_city.city_name','job_domain.domain_name')
            ->join('managers', 'managers.manager_id', '=', 'job_description.manager_id')
            ->join('companys', 'companys.comp_id', '=', 'managers.comp_id')
            ->join('job_domain', 'job_domain.domain_id', '=', 'job_description.domain_id')
            ->join('job_city', 'job_city.city_id', '=', 'job_description.city_id')
            ->where('comp_user_name','=',$company_name)
            ->where('managers.block_admin',0)
            ->where('job_description.block_admin',0)
          //  ->where('job_description.job_end', '>=', NOW())
              ->orderby('desc_down')
            ->take(10)
            ->get();
        $jobColor['طرابلس'] = "greencity";
        $jobColor['بنغازي'] = "bluecity";
        $jobColor['مصراته'] = "redcity";
        $jobColor['الزاوية'] = "blackcity";
        $jobColor['الخمس'] = "blackcity";
        $jobColor['زليتن'] = "blackcity";
        $jobColor['سبها'] = "blackcity";
        $jobColor['ترهونة'] = "blackcity";
        $jobColor['غريان'] = "blackcity";
        $jobColor['البيضاء'] = "blackcity";

        $jobsArray = array();
        if($myJob!= null){
        foreach ($myJob as $item){
            $jobsArray[$item->desc_id] =
                array(
                    'job_name' => $item->job_name,
                    'desc_id' => $item->desc_id,
                    'comp_name' => $item->comp_name,
                    'city_color' => $jobColor[$item->city_name],

                    'image' => $item->image,
                    'code_image' => $item->code_image,
                    'comp_user_name' => $item->comp_user_name,
                    'domain_name' => $item->domain_name,
                    'city_name' => $item->city_name,
                    // 'req_count' => $jobArr[$t]->req_count,
                    'see_it' => $item->see_it,
                    'job_end' => $item->job_end,
                    'job_start' => $item->job_start
                );
        }
        }

       // $followers = Helpers::followers('followers_company',$company->comp_id,$seeker_id);

     /*   $status = 0;
        if($followers != "empty")
            $status = 1;
        $followers_count = Helpers::followers('followers_company',$company->comp_id,null);
*/

   
            DB::table('companys')
                ->where('comp_user_name', '=', $company_name)
                ->update(['see_it' => DB::raw('see_it+1')]);
   

        return view('show.company')
            ->with('myCompany', $myCompany)
            //->with('status', $status)
            ->with('myJob', $jobsArray)
            ->with('company_spec', $company_spec)
            ->with('company_name',$company_name)
          //  ->with('followers_count',$followers_count)
            ->with('company', $company);
    }

    public function update(Request $request, $company_name)
    {
        $seeker_id = session('seeker_id');

          $company = Helpers::getDataSeeker('seekerCompany',$company_name,false);
        $isDelete = false;
        $isAdd= false;

        $followers = Helpers::followers('followers_company',$company->comp_id,$seeker_id);

        if($followers == "empty") {
            DB::table('followers_company')->insert([
                'seeker_id' => $seeker_id,
                'comp_id' => $company->comp_id,
                'created_at' => \Carbon\Carbon::now(),
            ]);
            $isAdd = true;
            Helpers::setFollowers('followers_company', $company->comp_id, $seeker_id);

        }else{
            DB::table('followers_company')
                ->where('comp_id',  $company->comp_id)
                ->where('seeker_id', $seeker_id)
                ->delete();
            Helpers::removeFollowers('followers_company', $company->comp_id, $seeker_id);


        }
        $followers_count = Helpers::followers('followers_company',$company->comp_id,null);



        return response()->json([
             'check' => $isAdd,
             'followers' =>count($followers_count),
        ]);


     }

    public function destroy($id)
    {
        $seeker_id = session('seeker_id');
        DB::table('job_seeker_req')
            ->where('desc_id', $id)
            ->where('seeker_id', $seeker_id)
            ->delete();
        return redirect('/job/' . $id);
    }

}
