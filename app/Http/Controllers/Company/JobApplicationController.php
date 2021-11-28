<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Search;
use App\Helpers;
use Auth;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class JobApplicationController extends Controller
{
    //job application طلبات التوظيف لشركة
    public function index($user){
        $seeker_id = session('seeker_id');

        $myJob = DB::table('job_description')
            ->select('seekers.seeker_id','job_description.is_active','job_description.desc_id','job_name','managers.manager_id','managers.level','companys.comp_id',
                DB::raw('COUNT(DISTINCT job_seeker_req.seeker_id) AS req_count'),'job_description.see_it',
                'fname','lname','user_name','seekers.image')
            ->join('managers','managers.manager_id','=','job_description.manager_id')
            ->join('job_seeker_req','job_seeker_req.desc_id','=','job_description.desc_id')
            ->join('companys','companys.comp_id','=','managers.comp_id')
            ->join('seekers','seekers.seeker_id','=','managers.seeker_id')
            //->where('managers.seeker_id','=',$seeker_id)
            ->where('comp_user_name','=',$user)
            ->groupby('job_description.desc_id')
            ->orderby('job_description.desc_down')
            ->get();




        return view('company.jobapp.myjob')
            ->with('myJob',$myJob)
            ->with('user',$user);
    }

    public function show($user,$jobid){
        $seeker_id = session('seeker_id');

        $role = false;
        $objDesc = DB::table('job_description')
            ->select('job_description.desc_id')
            ->join('managers','managers.manager_id','=','job_description.manager_id')
             ->where('managers.seeker_id',$seeker_id)
            ->where('desc_id',$jobid)
            ->first();

        if($objDesc)
            $role=true;

        $desc_id = $jobid;
        $s = new Search();

        if(!empty($_GET['page'])){ $page = (int) $_GET['page']; }else{ $page =1; }

        $spec = $id = NULL;
        $data = array(
            'select' => 'all',
            'desc_id'    =>  $desc_id,

            'id' => $id,
            'page' =>  $page,
            'start' =>  NULL,
            'end' =>  NULL,
        );
        $records_at_page = 30;
        $arr = array();


        $time_start = microtime(true);
        $data['start'] = 0;
        $data['end'] = 30;
        $queryCount =$arr= $s->searchApp($data);
        $seekerArr = array();
        $arrNat = array();

        $recodes_count = count($queryCount);
        foreach ($arr as $val) {
            $seekerArr[] = $val;
        }

        $arrCity =  $arrDomain =  $arrUniv=$arrEdu=null;


        $cityArray = Helpers::getDataSeeker('job_city',null,false);
        foreach ($cityArray as $item){
            $arrCity[$item->city_id]=$item->city_name;
        }
        $DoaminArray = Helpers::getDataSeeker('job_domain',null,false);
        foreach ($DoaminArray as $item){
            $arrDomain[$item->domain_id]=$item->domain_name;
        }
        $edtArray = Helpers::getDataSeeker('job_edt',null,false);
        foreach ($edtArray as $item){
            $arrEdu[$item->edt_id]=$item->edt_name;
        }
        $univArray = Helpers::getDataSeeker('univ',null,false);
        foreach ($univArray as $item){
            $arrUniv[$item->univ_id]=$item->univ_name;
        }


        $data['start'] = NULL;
        $data['end'] = NULL;

        $page_count = (int) ceil($recodes_count / $records_at_page );

        if($recodes_count <> 0){
            if(($page > $page_count) || ($page <= 0)){
                die('خطاء');
            }}

        $start= ($page -1) * $records_at_page;
        $end = $records_at_page;
        if($end >= $recodes_count)
            $end=$recodes_count;

        $data['start'] = NULL;
        $data['end'] = NULL;

        $seekersArray = array();
        $SeekersIds = array();

        if($seekerArr != null) {
            for ($t = $start; $t < $end+$start; $t++) {
                $edt_tt=$seekerArr[$t]->edt_id;
                $edt_name = $arrEdu[$edt_tt];
                $dateArabic = Helpers::arabic_date_format(strtotime($seekerArr[$t]->updated_at));


                $seekersArray[$seekerArr[$t]->seeker_id] =
                    array(
                        'fname' => $seekerArr[$t]->fname,
                        'seeker_id' => $seekerArr[$t]->seeker_id,
                        'req_id' => $seekerArr[$t]->req_id,
                        'lname' => $seekerArr[$t]->lname,
                        'about' => $seekerArr[$t]->about,
                        'user_name' => $seekerArr[$t]->user_name,
                        'gender' => $seekerArr[$t]->gender,
                        'image' => $seekerArr[$t]->image,
                        'last_seen' => $seekerArr[$t]->last_seen,
                        'edt_name' => $edt_name,
                        'code_image' => $seekerArr[$t]->code_image,
                        'age' => $seekerArr[$t]->age,
                         'req_event' => $seekerArr[$t]->req_event,
                        'sum_exp' => 55,
                        'seeker_count' => $seekerArr[$t]->match."%",
                        'domain_name' => $arrDomain[$seekerArr[$t]->domain_id],
                        'city_name' => $arrCity[$seekerArr[$t]->city_id],
                        'address' => $seekerArr[$t]->address,
                        'match' => $seekerArr[$t]->see_it,
                        'hide_cv' => $seekerArr[$t]->hide_cv,
                        'updated_at' => $dateArabic,
                        'spec' => array());


                $SeekersIds[]=$seekerArr[$t]->seeker_id;

            }
            $SeekerSpecs = DB::select("SELECT `spec_seeker`.`seeker_id`,`spec_seeker`.`spec_seeker_id`,`spec_name`,COUNT(`firend_spec`.`firend_spec_id`) AS spec_count
                    FROM `spec_seeker` 
                    JOIN `spec` ON `spec`.`spec_id` = `spec_seeker`.`spec_id`
                    LEFT JOIN `firend_spec` ON `spec_seeker`.`spec_seeker_id` = `firend_spec`.`firend_spec_id`
                    WHERE `spec_seeker`.`seeker_id` IN (".implode(',',$SeekersIds).") group by `spec`.`spec_name`, `spec_seeker`.`seeker_id`,`spec_seeker`.`spec_seeker_id`");


            foreach ($SeekerSpecs as $item){

                foreach ($SeekersIds as $Ids){
                    if($item->seeker_id == $Ids){
                        $seekersArray[$Ids]['spec'][$item->spec_name] = $item->spec_count."-".$item->spec_seeker_id;
                        break;
                    }
                }
            }

        }





        $urls = $s->searchAppURL($data);



        return view('company.jobapp.show')
            ->with('user',$user)
            ->with('jobid',$jobid)
             ->with('role',$role)

             ->with('seekersArray',$seekersArray)

             ->with('data',$data)
            ->with('page_count',$page_count);
    }

    public function showAjax($user,$jobid){
        $seeker_id = session('seeker_id');

        $role = false;
        $objDesc = DB::table('job_description')
            ->select('job_description.desc_id')
            ->join('managers','managers.manager_id','=','job_description.manager_id')
             ->where('managers.seeker_id',$seeker_id)
            ->where('desc_id',$jobid)
            ->first();

        if($objDesc)
            $role=true;

        $desc_id = $jobid;
        $s = new Search();

        if(!empty($_GET['page'])){ $page = (int) $_GET['page']; }else{ $page =1; }

        $spec = $id = NULL;
        $data = array(
            'select' => 'all',
            'desc_id'    =>  $desc_id,

            'id' => $id,
            'page' =>  $page,
            'start' =>  NULL,
            'end' =>  NULL,
        );
        $records_at_page = 30;
        $arrDomain = array();
        $arrCity = array();
        $arrEdu = array();

        $cityArray = Helpers::getDataSeeker('job_city',null,false);
        foreach ($cityArray as $item){
            $arrCity[$item->city_id]=$item->city_name;
        }
        $DoaminArray = Helpers::getDataSeeker('job_domain',null,false);
        foreach ($DoaminArray as $item){
            $arrDomain[$item->domain_id]=$item->domain_name;
        }
        $edtArray = Helpers::getDataSeeker('job_edt',null,false);
        foreach ($edtArray as $item){
            $arrEdu[$item->edt_id]=$item->edt_name;
        }


         $start= ($page -1) * $records_at_page;
        $end = $records_at_page;


        $data['start'] = $start;
        $data['end'] = $end;
        $seekers = $s->searchApp($data);


        $seekersArray = array();
        $SeekersIds = array();
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

         if(count($seekers) != null) {
            foreach ($seekers as $seeker) {

                $beforEdt = $arrEdu[$seeker->edt_id];
                $city = $arrCity[$seeker->city_id];
                $doamin = $arrDomain[$seeker->domain_id];
                $edt_name = str_replace("/", "/", $beforEdt);

                if($seeker->image == "") {
                    if ($seeker->gender == "m")
                        $stringImage = $actual_link."/images/simple/140px_male.png";
                    else
                        $stringImage =$actual_link."/images/simple/140px_female.png";
                }else{
                    $stringImage= $actual_link."/images/seeker/140px_". $seeker->code_image ."_". $seeker->image;
                }

                if($seeker->hide_cv == 0 )
                    $hideString= "icon-eye a";
                else
                    $hideString= "icon-eye-off a";

                $address=$about="";
                if($seeker->address !="")
                    $address = "- ".$seeker->address;
                $dateArabic = Helpers::arabic_date_format(strtotime($seeker->updated_at));


                if($seeker->about !=null)
                    $about = $seeker->about;
                $seekersArray[$seeker->seeker_id] =
                    array(
                        'fname' => $seeker->fname,
                        'seeker_id' => $seeker->seeker_id,
                        'req_id' => $seeker->req_id,
                        'lname' => $seeker->lname,
                        'about' => $about,
                        'user_name' => $seeker->user_name,
                        'gender' => $seeker->gender,
                        'image' =>$stringImage,
                        'last_seen' => $seeker->last_seen,
                        'edt_name' => $edt_name,
                        'code_image' => $seeker->code_image,
                        'age' => $seeker->age,
                        'sum_exp' => 55,
                        'seeker_count' => $seeker->match."%",
                        'domain_name' =>$doamin,
                        'city_name' => $city,
                        'address' => $address,
                        'match' => $seeker->see_it,
                        'hide_cv' => $hideString,
                        'updated_at' => $dateArabic,
                        'spec' => array());

                $SeekersIds[]=$seeker->seeker_id;


            }

            $SeekerSpecs = DB::select("SELECT `spec_seeker`.`seeker_id`,`spec_seeker`.`spec_seeker_id`,`spec_name`,COUNT(`firend_spec`.`firend_spec_id`) AS spec_count
                    FROM `spec_seeker` 
                    JOIN `spec` ON `spec`.`spec_id` = `spec_seeker`.`spec_id`
                    LEFT JOIN `firend_spec` ON `spec_seeker`.`spec_seeker_id` = `firend_spec`.`firend_spec_id`
                    WHERE `spec_seeker`.`seeker_id` IN (".implode(',',$SeekersIds).") group by   `spec`.`spec_name`, `spec_seeker`.`seeker_id`,`spec_seeker`.`spec_seeker_id`");

            foreach ($SeekerSpecs as $item){

                foreach ($SeekersIds as $Ids){
                    if($item->seeker_id == $Ids){
                        $seekersArray[$Ids]['spec'][$item->spec_name] = $item->spec_count."-".$item->spec_seeker_id;
                        break;
                    }
                }
            }
        }


        return response()->json([
            'users' => $seekersArray,
            'role' => $role,

        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function addAccept($user,$jobid,$req_id,$seek_id){

        $seeker_id = session('seeker_id');

        $desciption =DB::table('job_description')
            ->select('desc_id','job_name')
            ->join('managers','managers.manager_id','=','job_description.manager_id')
            ->where('managers.seeker_id','=',$seeker_id)
            ->where('desc_id','=',$jobid)
            ->first();

        if($desciption == null)
            return response()->json(['check' =>false]);

                DB::table('job_seeker_req')
                    ->where('desc_id','=',$desciption->desc_id)
                    ->where('req_id',$req_id)
                    ->update([
                        'req_event'=> 1
                    ]);

                $content = "تهانينا، تم قبولك مبدائيًا لوظيفة: ".$desciption->job_name.". ";//".$good_one;
                 Helpers::AddNote($seek_id,$content,3,0);

              return response()->json(['check' =>true]);

    }

    public function removeSeeker($user,$jobid,$req_id,$seek_id){

        $seeker_id = session('seeker_id');

        $desciption =DB::table('job_description')
            ->select('desc_id','job_name')
            ->join('managers','managers.manager_id','=','job_description.manager_id')
            ->where('managers.seeker_id','=',$seeker_id)
            ->where('desc_id','=',$jobid)
            ->first();


        if($desciption !=null) {
                 DB::table('job_seeker_req')
                    ->where('desc_id',$desciption->desc_id)
                    ->where('req_id',$req_id)
                    ->update([
                        'req_event'=> 2
                    ]);
          /*  $good_words =array(
                "نتأسف","حظ اوفر المره القادمة","لاتترد في التقدم مرة أخري","شكراً على المشاركة","نصيبات"
                );
            $good_one = $good_words[rand(0,count($good_words)-1)];*/

            $content = "نتأسف، تم رفض قبولك لوظيفة: ".$desciption->job_name.". ";//.$good_one;
            Helpers::AddNote($seek_id,$content,3,0);

            return response()->json([
                'check' =>true,
            ]);
        }

        return response()->json([
            'check' =>false,
        ]);

    }


}
