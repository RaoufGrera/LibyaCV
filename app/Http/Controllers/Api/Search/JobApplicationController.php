<?php

namespace App\Http\Controllers\Api\Search;

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

    public function show($user,$jobid){
        $seeker_id =Auth::user()->seeker_id;

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


         $data['start'] = 0;
        $data['end'] = 30;
        $queryCount =$arr= $s->searchApp($data);
        $seekerArr = array();

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
  /*      $univArray = Helpers::getDataSeeker('univ',null,false);
        foreach ($univArray as $item){
            $arrUniv[$item->univ_id]=$item->univ_name;
        }*/


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
        $actual_link ="https://www.libyacv.com";
       // $actual_link ="httpس://192.168.1.6:8081/libyacv/public";

        if($seekerArr != null) {
            for ($t = $start; $t < $end+$start; $t++) {
                $edt_tt=$seekerArr[$t]->edt_id;
                $edt_name = $arrEdu[$edt_tt];



                if($seekerArr[$t]->image == "") {
                    if($seekerArr[$t]->gender =="f")
                    $stringImage= $actual_link."/images/simple/140px_female.png";
                    else
                      $stringImage= $actual_link."/images/simple/140px_male.png";


                }else{
                    $stringImage= $actual_link."/images/seeker/140px_". $seekerArr[$t]->code_image ."_". $seekerArr[$t]->image;
                }

                if($seekerArr[$t]->exp_sum !=null)
                $exp =  floor($seekerArr[$t]->exp_sum/12) . ' سنة و' .$seekerArr[$t]->exp_sum%12 . ' شهر.';
                else
                $exp = "بدون خبرة";
                $seekersArray[$t] =
                    array(
                        'fname' => $seekerArr[$t]->fname." ",
                        'seeker_id' => $seekerArr[$t]->seeker_id,
                        'req_id' => $seekerArr[$t]->req_id,
                        'lname' => $seekerArr[$t]->lname,
                        'about' => $seekerArr[$t]->about,
                        'user_name' => $seekerArr[$t]->user_name,
                         'image' => $stringImage,
                     //   'last_seen' => $seekerArr[$t]->last_seen,
                        'edt_name' => $edt_name,
                      //   'age' => $seekerArr[$t]->age,
                         'req_event' => $seekerArr[$t]->req_event,
                      //  'sum_exp' => 55,
                        'match' => $seekerArr[$t]->match,

                       // 'seeker_count' => $seekerArr[$t]->match."%",
                        'domain_name' => $arrDomain[$seekerArr[$t]->domain_id],
                        'exp' =>$exp,
                        'city_name' => $arrCity[$seekerArr[$t]->city_id],);


            }


        }
        return response()->json($seekersArray , 200);

    }


    public function addAccept($jobid,$seek_id){

        $seeker_id =Auth::user()->seeker_id;

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
                    ->where('seeker_id',$seek_id)
                    ->update([
                        'req_event'=> 1
                    ]);

                $content = "تهانينا، تم قبولك مبدائيًا لوظيفة: ".$desciption->job_name.". ";//".$good_one;
                 Helpers::AddNote($seek_id,$content,3,0);

              return response()->json(['message' => Helpers::getMessage("saved")],200);

    }

    public function removeSeeker($jobid,$seek_id){

        $seeker_id =Auth::user()->seeker_id;

        $desciption =DB::table('job_description')
            ->select('desc_id','job_name')
            ->join('managers','managers.manager_id','=','job_description.manager_id')
            ->where('managers.seeker_id','=',$seeker_id)
            ->where('desc_id','=',$jobid)
            ->first();


        if($desciption !=null) {
                 DB::table('job_seeker_req')
                    ->where('desc_id',$desciption->desc_id)
                    ->where('seeker_id',$seek_id)
                    ->update([
                        'req_event'=> 2
                    ]);
          /*  $good_words =array(
                "نتأسف","حظ اوفر المره القادمة","لاتترد في التقدم مرة أخري","شكراً على المشاركة","نصيبات"
                );
            $good_one = $good_words[rand(0,count($good_words)-1)];*/

            $content = "نتأسف، تم رفض قبولك لوظيفة: ".$desciption->job_name.". ";//.$good_one;
            Helpers::AddNote($seek_id,$content,3,0);

            return response()->json(['message' => "تم حذف المتقدم"],200);
        }

        return response()->json(['message' => " تم حذف المتقدم"],200);


    }


}
