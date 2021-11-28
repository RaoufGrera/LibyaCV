<?php

namespace App\Http\Controllers\Company;

use App\Desc;
use App\Jobs\NoteAddJob;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Log;
 use Validator;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Helpers;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostJobController extends Controller
{
    public function index($user)
    {
        $seeker_id = session('seeker_id');

        $manger = DB::table('managers')
            ->select('level')
            ->where('seeker_id', $seeker_id)
            ->where('block_admin', FALSE)
            ->first();

        $myJob = DB::table('job_description')
            ->select('desc_id', 'job_name', 'managers.manager_id', 'level', 'companys.comp_id')
            ->join('managers', 'managers.manager_id', '=', 'job_description.manager_id')
            ->join('companys', 'companys.comp_id', '=', 'managers.comp_id');

        if ($manger->level != 'a')
            $myJob = $myJob->where('managers.seeker_id', '=', $seeker_id);


        $myJob = $myJob->where('comp_user_name', '=', $user)
            ->where('job_end','>=',Carbon::now())

            ->where('managers.block_admin', FALSE)
            ->where('job_description.block_admin', FALSE)
            ->get();


        $myCompany= Helpers::getDataSeeker('seekerCompany',$user,false);



        return view('company.job.my-job')
            ->with('company', $myCompany)

            ->with('myJob', $myJob)
            ->with('user', $user);
    }

    public function create($user)
    {
        $seeker_id = session('seeker_id');

        $domain= Helpers::getDataSeeker('job_domain',null,false);
        $city =Helpers::getDataSeeker('job_city',null,false);


        $company= Helpers::getDataSeeker('seekerCompany',$user,false);

        $ArrayDays = [

            "40 يوم",
            "30 يوم",

            "20 يوم",

            "10 ايام",
            "5 ايام",
        ];

        return view('company.job.post-job')
            ->with('user', $user)
            ->with('days', $ArrayDays)
            ->with('company', $company)
             ->with('domain', $domain)
            ->with('city', $city);
         /*   ->with('type', $type)
            ->with('ed_type', $ed_type)
            ->with('status', $status)
            ->with('nat', $nat) */


    }

    public function store(Request $request, $user)
    {


        $seeker_id = session('seeker_id');

        $i = 0;

        $job_name = trim(strip_tags($request->input('job_name')));
        $job_desc = trim(strip_tags($request->input('job_desc')));
/*        $job_skills = trim(strip_tags($request->input('job_skills')));*/
        $city_id = trim(strip_tags($request->input('city_id')));
        $domain_id = trim(strip_tags($request->input('domain_id')));
        $day = trim(strip_tags($request->input('day')));

         $is_active = trim(strip_tags($request->input('is_active'))); // 0 is active..  1 is not active
         $how_receive = 1; //trim(strip_tags($request->input('how_receive'))); // 0 is active..  1 is not active
        date_default_timezone_set('Africa/Tripoli');


        $email = trim(strip_tags($request->input('email'))); // 0 is active..  1 is not active
        $phone = trim(strip_tags($request->input('phone'))); // 0 is active..  1 is not active
        $website = trim(strip_tags($request->input('website'))); // 0 is active..  1 is not active


        $isNeedMore = false;
        $isOK = false;
        if($how_receive == 1){
            $isNeedMore = true;
            if($email !="" && $email != null){
                 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                      $error = "خطاء في كتابة البريد الإلكتروني، لتجنب الخطاء قم بكتابة البريد الإلكتروني بشكل صحيح او قم بمسح النص داخل الحقل بالكامل.";


                         return redirect('/company-profile/' . $user . '/job/create')
                             ->with('error', $error)
                             ->withInput();


                  //  return redirect('/company-profile/' . $user . '/job/create')   ->with('error', $error);
                }
                $isOK = true;
            }

            if($website !="" && $website != null){
                if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
                    $error = "خطاء في كتابة الموقع الإلكتروني، لتجنب الخطاء قم بكتابة الموقع بشكل صحيح او قم بمسح النص داخل الحقل بالكامل.";
                    return redirect('/company-profile/' . $user . '/job/create')
                        ->with('error', $error)
                        ->withInput();
                 }
                $isOK = true;
            }
            if($phone !="" && $phone != null){
                if (ctype_digit($phone) && (
                        ($phone[0] =="0" && strlen($phone) ==10) ||
                        ($phone[0] !="0" && strlen($phone) ==9)
                    ) ){
                    $isOK = true;

                }else{
                    $error = "خطاء في كتابة رقم الهاتف، لتجنب الخطاء قم بكتابة رقم الهاتف بشكل صحيح او قم بمسح النص داخل الحقل بالكامل.";
                    return redirect('/company-profile/' . $user . '/job/create')
                        ->with('error', $error)
                        ->withInput();
                }

            }

        }


        if($how_receive == 1 && !$isOK){
            $error = "خطاء، الرجاء ادخال طريقة لتقدم علي الوظيفة";
            return redirect('/company-profile/' . $user . '/job/create')
                ->with('error', $error)
                ->withInput();
        }


        $validator = Validator::make(Input::all(), [
            'domain_id' => 'required|exists:job_domain,domain_id',
            'city_id' => 'required|exists:job_city,city_id',
        ]);
        if ($validator->fails()) {
            $error = "خطاء في الإدخال.";
            return redirect('/company-profile/' . $user . '/job/create')
                ->with('error', $error)
                ->withInput();
        }

        if($how_receive == 0){
            $email = "";$phone = ""; $website = "";

        }
        $p=1;

        $myCompany = DB::table('companys')
            ->select('manager_id','comp_name')
            ->join('managers', 'managers.comp_id', '=', 'companys.comp_id')
            ->where('managers.seeker_id', '=', $seeker_id)
            ->where('comp_user_name', '=', $user)
            ->first();
        if($myCompany == null)
            return redirect('/company-profile/' . $user . '/job');


        $job_start = date("Y-m-d");

        $timestamp = Now('Africa/Tripoli');
      //  $job_end = date('Y-m-d', strtotime("+40 days"));

        switch ($day){
            case 0 :
            $job_end = date('Y-m-d', strtotime("+40 days"));
            break;
            case 1 :
                $job_end = date('Y-m-d', strtotime("+30 days"));
                break;
            case 2 :
                $job_end = date('Y-m-d', strtotime("+20 days"));
                break;
            case 3 :
                $job_end = date('Y-m-d', strtotime("+10 days"));
                break;
            case 4 :
                $job_end = date('Y-m-d', strtotime("+5 days"));
                break;
            default :
                $job_end = date('Y-m-d', strtotime("+40 days"));

        }
      //  $job_end = date('Y-m-d', strtotime("+30 days"));
        $minDesc= DB::table('job_description')->min('desc_down');
        $job_stop = rand(58,689);
        $job_stop  = $job_stop + 12;
        if($minDesc == 0)
        $l=99999999999999;
        else
        $l=$minDesc-1;

         $desc = Desc::create([
            'job_name' => $job_name,
            'job_desc' => $job_desc,
/*            'job_skills' => $job_skills,*/
            'city_id' => $city_id,
            'domain_id' => $domain_id,
            'email' => $email,
            'phone' => $phone,
            'website' => $website,
            'job_stop' => $job_stop,

             'is_active' => $is_active,
              'how_receive' => $how_receive,
             'created_at' => $timestamp,
             'job_start' => $job_start,
            'job_end' => $job_end,
            'desc_down' => $l,
            'manager_id' => $myCompany->manager_id,

        ]);


        $desc->comp_name =$myCompany->comp_name ;
        NoteAddJob::dispatch($desc)
            ->delay(now()->addMinutes(1));




        return redirect('/company-profile/' . $user . '/job');
    }

    public function show($id)
    {

    }


    public function edit($user, $id)
    {

        $seeker_id = session('seeker_id');






        $job = DB::table('job_description')
            // ->select('desc_id','job_name','managers.manager_id','level','companys.comp_id')
            ->join('managers', 'managers.manager_id', '=', 'job_description.manager_id')
         //   ->join('companys', 'companys.comp_id', '=', 'managers.comp_id')
            ->leftJoin('job_domain', 'job_domain.domain_id', '=', 'job_description.domain_id')
            ->leftJoin('job_city', 'job_city.city_id', '=', 'job_description.city_id')

            ->where('managers.seeker_id', '=', $seeker_id)
           // ->where('comp_user_name', '=', $user)
            ->where('managers.level', '!=', 'b')
            ->where('desc_id', '=', $id)
            ->first();

        $ArrayDays = [


            "بدون تحديث المدة",
            "40 يوم",
            "30 يوم",

            "20 يوم",

            "10 ايام",
            "5 ايام",
        ];

        $domain= Helpers::getDataSeeker('job_domain',null,false);
        $city =Helpers::getDataSeeker('job_city',null,false);

       /* $type = Helpers::getDataSeeker('job_type',null,false);
        $ed_type=Helpers::getDataSeeker('job_edt',null,false);
        $status =Helpers::getDataSeeker('job_status',null,false);
        $nat =Helpers::getDataSeeker('job_nat',null,false);

*/
        $myCompany = Helpers::getDataSeeker('seekerCompany',$seeker_id,false);

        return view('company.job.edit-job')
            ->with('myCompany', $myCompany)
            ->with('job', $job)
            ->with('days', $ArrayDays)
            ->with('user', $user)
            ->with('domain', $domain)
            ->with('city', $city);
         /*   ->with('type', $type)
            ->with('ed_type', $ed_type)
            ->with('status', $status)
            ->with('nat', $nat) */
    }

    public function update(Request $request, $user, $id)
    {
        $seeker_id = session('seeker_id');

        $job_name = trim(strip_tags($request->input('job_name')));
        $job_desc = trim(strip_tags($request->input('job_desc')));
/*        $job_skills = trim(strip_tags($request->input('job_skills')));*/
        $city_id = trim(strip_tags($request->input('city_id')));
        $domain_id = trim(strip_tags($request->input('domain_id')));

        $is_active = trim(strip_tags($request->input('is_active'))); // 0 is active..  1 is not active
        $how_receive = 1;//trim(strip_tags($request->input('how_receive'))); // 0 is active..  1 is not active
        $day = trim(strip_tags($request->input('day')));

        $email = trim(strip_tags($request->input('email'))); // 0 is active..  1 is not active
        $phone = trim(strip_tags($request->input('phone'))); // 0 is active..  1 is not active
        $website = trim(strip_tags($request->input('website'))); // 0 is active..  1 is not active


        $isNeedMore = false;
        $isOK = false;
        if($how_receive == 1){
            $isNeedMore = true;
            if($email !="" && $email != null){
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error = "خطاء في كتابة البريد الإلكتروني، لتجنب الخطاء قم بكتابة البريد الإلكتروني بشكل صحيح او قم بمسح النص داخل الحقل بالكامل.";


                    return redirect('/company-profile/' . $user . '/job/'. $id .'/edit')
                        ->with('error', $error)
                        ->withInput();


                    //  return redirect('/company-profile/' . $user . '/job/create')   ->with('error', $error);
                }
                $isOK = true;
            }

            if($website !="" && $website != null){
                if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
                    $error = "خطاء في كتابة الموقع الإلكتروني، لتجنب الخطاء قم بكتابة الموقع بشكل صحيح او قم بمسح النص داخل الحقل بالكامل.";
                    return redirect('/company-profile/' . $user . '/job/'. $id .'/edit')
                        ->with('error', $error)
                        ->withInput();
                }
                $isOK = true;
            }
            if($phone !="" && $phone != null){
                if (ctype_digit($phone) && (
                        ($phone[0] =="0" && strlen($phone) ==10) ||
                        ($phone[0] !="0" && strlen($phone) ==9)
                    ) ){
                    $isOK = true;

                }else{
                    $error = "خطاء في كتابة رقم الهاتف، لتجنب الخطاء قم بكتابة رقم الهاتف بشكل صحيح او قم بمسح النص داخل الحقل بالكامل.";
                    return redirect('/company-profile/' . $user . '/job/'. $id .'/edit')
                        ->with('error', $error)
                        ->withInput();
                }

            }

        }

        if($how_receive == 1 && !$isOK){
            $error = "خطاء، الرجاء ادخال طريقة لتقدم علي الوظيفة";
            return redirect('/company-profile/' . $user . '/job/'. $id .'/edit')
                ->with('error', $error)
                ->withInput();
        }

        if($how_receive == 0){
            $email = "";$phone = ""; $website = "";
        }

        $validator = Validator::make(Input::all(), [
            'domain_id' => 'required|exists:job_domain,domain_id',
            'city_id' => 'required|exists:job_city,city_id',
        ]);
        if ($validator->fails()) {
            $error = "خطاء في الإدخال.";
            return redirect('/company-profile/' . $user . '/job/'. $id .'/edit')
                ->with('error', $error)
                ->withInput();
        }
            $thisJob = DB::table('job_description')
            ->select('managers.manager_id', 'desc_id')
            ->join('managers', 'managers.manager_id', '=', 'job_description.manager_id')
             ->where('managers.seeker_id', '=', $seeker_id)

            ->where('desc_id', '=', $id)
            ->first();
        $is_refresh=0;
        $job_end = date('Y-m-d', strtotime("+40 days"));

        if($day != 0){
            switch ($day){

                    case 1 :
                    $job_end = date('Y-m-d', strtotime("+40 days"));
                    break;
                case 2 :
                    $job_end = date('Y-m-d', strtotime("+30 days"));
                    break;
                case 3 :
                    $job_end = date('Y-m-d', strtotime("+20 days"));
                    break;
                case 4 :
                    $job_end = date('Y-m-d', strtotime("+10 days"));
                    break;
                case 5 :
                    $job_end = date('Y-m-d', strtotime("+5 days"));
                    break;
                default :
                    $job_end = date('Y-m-d', strtotime("+40 days"));

            }
            $is_refresh=1;
        }
    if($thisJob !=null){
        if($day != 0) {
            $minDesc= DB::table('job_description')->min('desc_down');

            if($minDesc == 0)
                $l=99999999999999;
            else
                $l=$minDesc-1;
            DB::table('job_description')
                ->where('desc_id', $id)
                ->update([
                    'job_name' => $job_name,
                    'job_desc' => $job_desc,
/*                    'job_skills' => $job_skills,*/
                    'city_id' => $city_id,
                    'domain_id' => $domain_id,
                    'email' => $email,
                    'phone' => $phone,
                    'website' => $website,
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
                    'is_refresh' => $is_refresh,
                    'desc_down' => $l,

                    'job_end' => $job_end,

                    'is_active' => $is_active,
                    'how_receive' => $how_receive,

                ]);
        }else{
            DB::table('job_description')
                ->where('desc_id', $id)
                ->update([
                    'job_name' => $job_name,
                    'job_desc' => $job_desc,
/*                    'job_skills' => $job_skills,*/
                    'city_id' => $city_id,
                    'domain_id' => $domain_id,
                    'email' => $email,
                    'phone' => $phone,
                    'website' => $website,
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

                    'is_active' => $is_active,
                    'how_receive' => $how_receive,

                ]);
        }
}



        return redirect('/company-profile/' . $user . '/job');
    }

    public function destroy($user, $id)
    {

        $seeker_id = session('seeker_id');

        $myJob = DB::table('job_description')
            ->select('desc_id', 'job_name', 'managers.manager_id', 'level', 'companys.comp_id')
            ->join('managers', 'managers.manager_id', '=', 'job_description.manager_id')
            ->join('companys', 'companys.comp_id', '=', 'managers.comp_id')
            ->where('managers.seeker_id', '=', $seeker_id)
            ->where('comp_user_name', '=', $user)
            ->where('managers.level', '!=', 'b')
            ->where('desc_id', '=', $id)
            ->first();


        DB::table('job_description')
            ->where('desc_id', $myJob->desc_id)
            ->where('manager_id', $myJob->manager_id)
            ->delete();

        return redirect('/company-profile/' . $user . '/job/');
    }
}
