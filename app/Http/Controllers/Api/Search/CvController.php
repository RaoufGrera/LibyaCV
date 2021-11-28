<?php

namespace App\Http\Controllers\Api\Search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Search;
use Illuminate\Support\Facades\Auth;
use App\Helpers;

use DB;
//use PhpParser\Node\Expr\Array_;

class CvController extends Controller
{

    public function searchCV(){
        $s = new Search();

        $domainID=$edtID=$cityID=$cityRandom=$cityName=null;
        $domainRandom =$domainName=$edtName=$edtRandom=null;
        if (!empty($_GET['string'])) {
            $string = str_replace("-", " ", $_GET['string']);
        } else {
            $string = NULL;
        }

        if (!empty($_GET['city'])) {
            $cityName = str_replace("-", " ", $_GET['city']);
        } else {
            $cityName = NULL;
        }

        if (!empty($_GET['domain'])) {
            $domainName = str_replace("-", " ", $_GET['domain']);
        } else {
            $domainName = NULL;
        }



        if (!empty($_GET['page'])) {
            $page = (int)$_GET['page'];
        } else {
            $page = 1;
        }

        $cityArray = Helpers::getDataSeeker('job_city',null,false);
        foreach ($cityArray as $item){
            $arrCity[$item->city_id]=$item->city_name;
            if($cityName == $item->city_name) $cityID=$item->city_id;
        }
        $DoaminArray = Helpers::getDataSeeker('job_domain',null,false);
        foreach ($DoaminArray as $item){
            $arrDomain[$item->domain_id]=$item->domain_name;
            if($domainName == $item->domain_name) $domainID=$item->domain_id;

        }
        $edtArray = Helpers::getDataSeeker('job_edt',null,false);
        foreach ($edtArray as $item){
            $arrEdu[$item->edt_id]=$item->edt_name;
            if($edtName == $item->edt_name) $edtID=$item->edt_id;

        }

        $data = array(
             'select' => 'all',
            'string'    =>  $string,
            'cityName' => $cityName,
             /*     'cityRandom' => $cityRandom,*/
            'cityID' => $cityID,
            'domainName' => $domainName,
            'domainID' => $domainID,
            /*  'domainRandom' => $domainRandom,*/
            'edtName' => $edtName,
            /* 'edtRandom' => $edtRandom,*/
            'edtID' => $edtID,
            'id' => null,
            'page' =>  $page,
            'start' =>  NULL,
            'end' =>  NULL,

        );
        $records_at_page = 10;
        $arr = array();

        $start= ($page -1) * $records_at_page;
        $end = $records_at_page;

        $data['start'] = $start;
        $data['end'] = $end;
        $queryCount =$arr= $s->searchCv($data);
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




        $data['start'] = NULL;
        $data['end'] = NULL;

        $seekersArray = array();
        $jobsArray = array();
        $actual_link ="https://www.libyacv.com";
        // $actual_link ="httpس://192.168.1.6:8081/libyacv/public";

        if($seekerArr != null) {
            foreach ($seekerArr as $item) {
                $edt_tt=$item->edt_id;
                $edt_name = $arrEdu[$edt_tt];
                $pos = strpos($edt_name, "/");
                if ($pos !== FALSE) {
                    $edt_name = substr($edt_name, 0, $pos );
                }


                if($item->image == "") {
                    if($item->gender =="f")
                        $stringImage= $actual_link."/images/simple/140px_female.png";
                    else
                        $stringImage= $actual_link."/images/simple/140px_male.png";


                }else{
                    $stringImage= $actual_link."/images/seeker/140px_". $item->code_image ."_". $item->image;
                }

                if($item->exp_sum !=null)
                    $exp =  floor($item->exp_sum/12) . ' سنة و' .$item->exp_sum%12 . ' شهر.';
                else
                    $exp = "بدون خبرة";


                $about ="";
                if($item->about ==""){
                    $about=$item->goal_text;
                }else{
                    $about=$item->about;

                }
                $seekersArray[$item->seeker_id] =
                    array(
                        'fname' => $item->fname." ",
                        'seeker_id' => $item->seeker_id,
                     //   'req_id' => $item->req_id,
                        'lname' => $item->lname,
                        'about' => $about,
                        'user_name' => $item->user_name,
                        'see_it' => $item->see_it,
                        'image' => $stringImage,
                        //   'last_seen' => $item->last_seen,
                        'edt_name' => $edt_name,
                        //   'age' => $item->age,
                       // 'req_event' => $item->req_event,
                        //  'sum_exp' => 55,
                       'match' => $item->match,
                        'type'=>"movie",


                        // 'seeker_coujobsArraynt' => $item->match."%",
                        'domain_name' => $arrDomain[$item->domain_id],
                        'exp' =>$exp,
                        "spec"=>"",
                        'city_name' => $arrCity[$item->city_id],);



                $SeekersIds[]=$item->seeker_id;

            }

            $SeekerSpecs = DB::select("SELECT `spec_seeker`.`seeker_id`,`spec_seeker`.`spec_seeker_id`,`spec_name`
                    FROM `spec_seeker` 
                    JOIN `spec` ON `spec`.`spec_id` = `spec_seeker`.`spec_id`
                    WHERE `spec_seeker`.`seeker_id` IN (".implode(',',$SeekersIds).") group by `spec`.`spec_name`, `spec_seeker`.`seeker_id`,`spec_seeker`.`spec_seeker_id`");

            $statment = "";
            $s=" . ";
            $d=0;
            foreach ($SeekerSpecs as $item){



                foreach ($SeekersIds as $Ids){
                    if($item->seeker_id == $Ids) {


                        if($seekersArray[$Ids]['spec']== "")
                                $seekersArray[$Ids]['spec'] = $seekersArray[$Ids]['spec']  . $item->spec_name;
                        else
                            $seekersArray[$Ids]['spec'] = $seekersArray[$Ids]['spec'] . $s . $item->spec_name;



                    }
                }
            }


            $lastjob = array();

            $i =0;
            foreach($seekersArray as $dd){
                if($i == 8 )
                    $lastjob[]=array('type'=>"ads");

                $lastjob[]=$dd;
                $i++;
            }
            //$lastjob[count($lastjob)] =    array('type'=>"ads");
            $jobsArray=$lastjob;

        }
        return response()->json($jobsArray ,200,[],JSON_NUMERIC_CHECK);

    }


}
