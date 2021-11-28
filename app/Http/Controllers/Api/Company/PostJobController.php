<?php

namespace App\Http\Controllers\Api\Company;

use App\Desc;
use App\Helpers;
use App\Http\Controllers\Controller;
use App\Jobs\NoteAddJob;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;


class PostJobController extends Controller
{
   /* public function index($user)
    {
         //$seeker_id = Auth::user()->seeker_id;

      /*  $manger = DB::table('managers')
            ->select('level')
            ->where('seeker_id', $seeker_id)
            ->where('block_admin', FALSE)
            ->first();

        $myJob = DB::table('job_description')
            ->select('job_description.desc_id', 'job_name',DB::raw('COUNT(DISTINCT job_seeker_req.seeker_id) AS req_count'))
            ->join('managers', 'managers.manager_id', '=', 'job_description.manager_id')
            ->join('companys', 'companys.comp_id', '=', 'managers.comp_id')
            ->leftJoin('job_seeker_req','job_seeker_req.desc_id','=','job_description.desc_id') //error
        ;

       /* if ($manger->level != 'a')
            $myJob = $myJob->where('managers.seeker_id', '=', $seeker_id);


        $myJob = $myJob->where('comp_user_name', '=', $user)
          //  ->where('job_end', '>=', \Carbon\Carbon::now())
            ->where('job_description.block_admin', FALSE)
            ->groupby('job_description.desc_id')

            ->get();

        $arr =   Array();
        $o=0;
        if($myJob !=null){
        foreach ($myJob  as $item){
            $arr[$o] = array(
                "desc_id"=>$item->desc_id,
                "job_name"=>$item->job_name .":" .$item->req_count,
            );

            $o++;
        }
        }



      //  $myCompany = Helpers::getDataSeeker('seekerCompany', $user, false);

        return response()->json($arr, 200);

    }*/
    public function index(){
        $seeker_id = Auth::user()->seeker_id;
        if(!empty($_GET['page'])){ $page = (int) $_GET['page']; }else{ $page =1; }
        $records_at_page = 10;
        $start= ($page -1) * $records_at_page;
        $end = $records_at_page;
        $data['start'] = $start;
        $data['end'] = $end;

        $jobs =   $myJob = DB::table('job_description')
            ->select('job_description.desc_id', 'job_name',DB::raw('COUNT(DISTINCT job_seeker_req.seeker_id) AS req_count'))
            ->join('managers', 'managers.manager_id', '=', 'job_description.manager_id')
            ->join('companys', 'companys.comp_id', '=', 'managers.comp_id')
            ->leftJoin('job_seeker_req','job_seeker_req.desc_id','=','job_description.desc_id') //error
        ;

        $jobs = $jobs->where('managers.seeker_id', '=', $seeker_id)
              ->where('job_end', '>=', \Carbon\Carbon::now())
            ->where('job_description.block_admin', FALSE)
            ->groupby('job_description.desc_id')
            ->take($end)
            ->skip($start)
            ->get();

        $jobsArray = array();
        if($jobs != null) {
            foreach ($jobs as $job) {

                $jobsArray[$job->desc_id] =
                    array(
                        "desc_id"=>$job->desc_id,
                        "job_name"=>$job->job_name ,
                        'see_it' => $job->req_count,
                        'type'=>"movie",
                    );
            }
            $lastjob = array();

            $i =0;
            foreach($jobsArray as $dd){


                $lastjob[]=$dd;
                $i++;
            }
             $jobsArray=$lastjob;
        }
        return response()->json(
            $jobsArray
            ,200,[],JSON_NUMERIC_CHECK);


    }
    public function create()
    {

        $domain = Helpers::getDataSeeker('job_domain', null, false);
        $city = Helpers::getDataSeeker('job_city', null, false);
   //     $company = Helpers::getDataSeeker('seekerCompany', $user, false);


        return response()->json([
             'domain' =>$domain,
            'city' =>$city
            ], 200);


    }

    public function store(Request $request)
    {


        $seeker_id =Auth::user()->seeker_id;

        $i = 0;

        $job_name = trim(strip_tags($request->input('job_name')));
        $job_desc = trim(strip_tags($request->input('job_desc')));
        //$job_skills = trim(strip_tags($request->input('job_skills')));
        $city_name = trim(strip_tags($request->input('city_id')));
        $domain_name = trim(strip_tags($request->input('domain_id')));
        $how_receive = trim(strip_tags($request->input('how_receive'))); // 0 is active..  1 is not active

        $email = trim(strip_tags($request->input('email'))); // 0 is active..  1 is not active
        $phone = trim(strip_tags($request->input('phone'))); // 0 is active..  1 is not active
        $website = trim(strip_tags($request->input('website'))); // 0 is active..  1 is not active

     //   $is_active = trim(strip_tags($request->input('is_active'))); // 0 is active..  1 is not active



      /*  $validator = Validator::make(Input::all(), [
            'domain_name' => 'required|exists:job_domain,domain_name',
            'city_name' => 'required|exists:job_city,city_name',
        ]);
        if ($validator->fails()) {
            return response()->json(['message'=>Helpers::getMessage("error")]
                , 200);
        }
*/

        $domainTable = Helpers::getDataSeeker('job_domain',null,false);
        $domain_id = "";
        foreach( $domainTable as $obj ) {
            if (  $obj->domain_name == $domain_name  ) {
                $domain_id = $obj->domain_id;
                break;
            }
        }

        $edtTable = Helpers::getDataSeeker('job_city',null,false);
        $city_id = "";
        foreach( $edtTable as $obj ) {
            if (  $obj->city_name == $city_name  ) {
                $city_id = $obj->city_id;
                break;
            }
        }


        $myCompany = DB::table('companys')
            ->select('manager_id')
            ->join('managers', 'managers.comp_id', '=', 'companys.comp_id')
            ->where('managers.seeker_id', '=', $seeker_id)

            ->first();

        $job_start = date("Y-m-d");

        $job_end = date('Y-m-d', strtotime("+30 days"));
        //$minDesc = DB::table('job_description')->min('desc_down');
        $minDesc= DB::table('job_description')->min('desc_down');
         $timestamp = Now('Africa/Tripoli');
        $job_stop = rand(77,489);
        $desc = Desc::create([
            'manager_id' => $myCompany->manager_id,
            'job_name' => $job_name,
            'job_desc' => $job_desc,
         //   'job_skills' => $job_skills,
            'city_id' => $city_id,
            'domain_id' => $domain_id,
            'email' => $email,
            'phone' => $phone,
            'website' => $website,
            'job_stop' => $job_stop,
            /*  'status_id' => $status_id,
            'type_id' => $type_id,
            'job_num' => $job_num,
            'specialty' => $specialty,
            'edt_id' => $ed_name,
            'exp_min' => $exp_min,
            'exp_max' => $exp_max,
            'age_min' => $age_min,
            'age_max' => $age_max,
            'job_gender' => $sex,
            'nat_id' => $nat_id,*/
            'how_receive' => $how_receive,

            'is_active' => 1,
            'created_at' => $timestamp,
            'job_start' => $job_start,
            'job_end' => $job_end,
            'desc_down' => $minDesc - 1,

        ]);
        NoteAddJob::dispatch($desc)
            ->delay(now()->addSecond(60));



        return response()->json(['message'=>Helpers::getMessage("saved")], 200);

    }

    public function show($id)
    {

    }


    public function edit( $id)
    {

        $seeker_id =Auth::user()->seeker_id;


        $job = DB::table('job_description')
      ->select('job_description.desc_id','job_name','email','website','phone','how_receive','job_city.city_name','job_domain.domain_name','job_desc')
            ->join('managers', 'managers.manager_id', '=', 'job_description.manager_id')
         //   ->join('companys', 'companys.comp_id', '=', 'managers.comp_id')
            ->join('job_domain', 'job_domain.domain_id', '=', 'job_description.domain_id')
            ->join('job_city', 'job_city.city_id', '=', 'job_description.city_id')
//    ->leftJoin('job_type', 'job_type.type_id', '=', 'job_description.type_id')
//  ->leftJoin('job_edt', 'job_edt.edt_id', '=', 'job_description.edt_id')
//      ->leftJoin('job_status', 'job_status.status_id', '=', 'job_description.status_id')
//      ->leftJoin('job_nat', 'job_nat.nat_id', '=', 'job_description.nat_id')
//     ->leftJoin('job_salary', 'job_salary.salary_id', '=', 'job_description.salary_id')
            ->where('managers.seeker_id', '=', $seeker_id)
      //     ->where('comp_user_name', '=', $user)
       //     ->where('managers.level', '!=', 'b')
            ->where('desc_id', '=', $id)
            ->first();


        $domain = Helpers::getDataSeeker('job_domain', null, false);
        $city = Helpers::getDataSeeker('job_city', null, false);

        /* $type = Helpers::getDataSeeker('job_type',null,false);
        $ed_type=Helpers::getDataSeeker('job_edt',null,false);
        $status =Helpers::getDataSeeker('job_status',null,false);
        $nat =Helpers::getDataSeeker('job_nat',null,false);

        */
       // $myCompany = Helpers::getDataSeeker('seekerCompany', $seeker_id, false);

        return response()->json([
            'job' =>$job,
            'domain' =>$domain,
            'city' =>$city
        ], 200);
        /*   ->with('type', $type)
        ->with('ed_type', $ed_type)
        ->with('status', $status)
        ->with('nat', $nat) */
    }

    public function update(Request $request, $id)
    {
        $seeker_id =Auth::user()->seeker_id;

        $job_name = trim(strip_tags($request->input('job_name')));
        $job_desc = trim(strip_tags($request->input('job_desc')));
       // $job_skills = trim(strip_tags($request->input('job_skills')));
        $city_name = trim(strip_tags($request->input('city_id')));
        $domain_name = trim(strip_tags($request->input('domain_id')));
        $how_receive = trim(strip_tags($request->input('how_receive'))); // 0 is active..  1 is not active

        $email = trim(strip_tags($request->input('email'))); // 0 is active..  1 is not active
        $phone = trim(strip_tags($request->input('phone'))); // 0 is active..  1 is not active
        $website = trim(strip_tags($request->input('website'))); // 0 is active..  1 is not active

        /*   $status_id = trim(strip_tags($request->input('status_id')));
        $type_id = trim(strip_tags($request->input('type_id')));
        $job_num = trim(strip_tags($request->input('job_num')));
        $specialty = trim(strip_tags($request->input('specialty')));
        $ed_name = trim(strip_tags($request->input('ed_name')));
        $exp_min = trim(strip_tags($request->input('exp_min')));
        $exp_max = trim(strip_tags($request->input('exp_max')));
        $age_min = trim(strip_tags($request->input('age_min')));
        $age_max = trim(strip_tags($request->input('age_max')));
        $sex = trim(strip_tags($request->input('sex')));
        $nat_id = trim(strip_tags($request->input('nat_id')));*/
       // $is_active = trim(strip_tags($request->input('is_active'))); // 0 is active..  1 is not active

        /* if($sex !="m" && $sex !="f") $sex='n';
        if(!is_int($age_max)) $age_max=null;
        if(!is_int($age_min)) $age_min=null;
        if(!is_int($exp_max)) $exp_max=null;
        if(!is_int($exp_min)) $exp_min=null;
        if(!is_int($is_active)) $is_active=0;



        $check = DB::table('job_status')
        ->where('status_id', $status_id)->first();
        if (empty($check))
        $status_id = null;

        $check = DB::table('job_edt')
        ->where('edt_id', $ed_name)->first();
        if (empty($check))
        $ed_name = null;

        $check = DB::table('job_type')
        ->where('type_id', $type_id)->first();
        if (empty($check))
        $type_id = null;
        */

        $domainTable = Helpers::getDataSeeker('job_domain',null,false);
        $domain_id = "";
        foreach( $domainTable as $obj ) {
            if (  $obj->domain_name == $domain_name  ) {
                $domain_id = $obj->domain_id;
                break;
            }
        }

        $edtTable = Helpers::getDataSeeker('job_city',null,false);
        $city_id = "";
        foreach( $edtTable as $obj ) {
            if (  $obj->city_name == $city_name  ) {
                $city_id = $obj->city_id;
                break;
            }
        }

        $thisJob = DB::table('job_description')
            ->select('managers.manager_id', 'desc_id')
            ->join('managers', 'managers.manager_id', '=', 'job_description.manager_id')
            ->where('managers.seeker_id', '=', $seeker_id)
            ->where('desc_id', '=', $id)
            ->first();

        if ($thisJob != null) {


            DB::table('job_description')
                ->where('desc_id', $id)
                ->update([
                    'job_name' => $job_name,
                    'job_desc' => $job_desc,
                   // 'job_skills' => $job_skills,
                    'city_id' => $city_id,
                    'domain_id' => $domain_id,
                    'email' => $email,
                    'phone' => $phone,
                    'website' => $website,
                    /* 'status_id' => $status_id,
                    'type_id' => $type_id,
                    'job_num' => $job_num,
                    'specialty' => $specialty,
                    'edt_id' => $ed_name,
                    'updated_at' => Now(),
                    'exp_min' => $exp_min,
                    'exp_max' => $exp_max,
                    'age_min' => $age_min,
                    'age_max' => $age_max,
                    'job_gender' => $sex,
                    'nat_id' => $nat_id,*/
                   // 'is_active' => $is_active,
                    'how_receive' => $how_receive,

                ]);
        }


       // return redirect('/company-profile/' . $user . '/job');
        return response()->json(['message'=>Helpers::getMessage("saved")], 200);

    }

    public function destroy( $id)
    {

        $seeker_id =Auth::user()->seeker_id;

        $myJob = DB::table('job_description')
            ->select('desc_id', 'job_name', 'managers.manager_id', 'level', 'companys.comp_id')
            ->join('managers', 'managers.manager_id', '=', 'job_description.manager_id')
            ->join('companys', 'companys.comp_id', '=', 'managers.comp_id')
            ->where('managers.seeker_id', '=', $seeker_id)

            //->where('managers.level', '!=', 'b')
            ->where('desc_id', '=', $id)
            ->first();


        DB::table('job_description')
            ->where('desc_id', $myJob->desc_id)
            ->where('manager_id', $myJob->manager_id)
            ->delete();

        return response()->json(['message'=>Helpers::getMessage("saved")], 200);
    }
}