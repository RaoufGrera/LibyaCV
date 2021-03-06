<?php

namespace App\Http\Controllers\Api\Search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Search;
use Illuminate\Support\Facades\Auth;
use App\Helpers;

use DB;

class ServicesSearchController extends Controller
{
    public function searchServices(){



        $s = new Search();

        if(!empty($_GET['string'])){ $string = str_replace("-"," ",$_GET['string']); }else{ $string =NULL; }

        if(!empty($_GET['city'])){ $cityName = str_replace("-"," ",$_GET['city']); }else{ $cityName =NULL; }

        if(!empty($_GET['domain'])){ $domainName = str_replace("-"," ",$_GET['domain']); }else{ $domainName =NULL; }
        /*    موظف متعاقد متطوع متدرب */
    //    if(!empty($_GET['type'])){ $typeName = str_replace("-"," ",$_GET['type']); }else{ $typeName =NULL; }



   //     if(!empty($_GET['status'])){ $statusName = str_replace("-"," ",$_GET['status']); }else{ $statusName =NULL; }



        if(!empty($_GET['page'])){ $page = (int) $_GET['page']; }else{ $page =1; }

        $data = array(
            'select' => 'all',
            'id' => NULL,
            'string'    =>  $string,
            'cityName' => $cityName,
            'domainName' => $domainName,
        //    'typeName' => $typeName,

          //  'statusName' => $statusName,

            'page' =>  $page,
            'start' =>  NULL,
            'end' =>  NULL,
        );
        $records_at_page = 10;



        $start= ($page -1) * $records_at_page;
        $end = $records_at_page;

        $data['start'] = $start;
        $data['end'] = $end;

        $jobs = $s->SearchServices($data);

        $arrStars = array();


        $jobsArray = array();
        $jobsArrStars = array();
       // $jobsArrayStars = array();
       // $jobIds = array();


        $actual_link ="https://www.libyacv.com";

        foreach ($arrStars as $item) {
            $jobsArrStars[] = $item;
        }
      //  $countStars = count($jobsArrStars);

      //  $loopStars =0;



        if($jobs != null) {
            foreach ($jobs as $job) {




                $job_desc  = str_limit($job->body, $limit = 80, $ends = '...');


                if($job->image == "" ) {
                    if ($job->gender == "m")
                        $stringImage = $actual_link."/images/simple/140px_male.png";
                    else
                        $stringImage =$actual_link."/images/simple/140px_female.png";
                }else{
                    $stringImage= $actual_link."/images/seeker/140px_". $job->code_image ."_". $job->image;
                }



                $jobsArray[$job->services_id] =
                    array(




                        'job_name' => $job->title,
                        'comp_id' => $job->seeker_id,
                        'desc_id' => $job->services_id,
                        'comp_name' =>$job->user_name,
                        'job_desc' =>$job_desc,
                        'isstar' => 0,

                        'image' => $stringImage,

                        'comp_user_name' => "",
                        'domain_name' => $job->domain_name,
                        'city_name' => $job->city_name,
                        // 'req_count' => $jobArr[$t]->req_count,
                        'see_it' => $job->see_it,
                        'url' => "",
                        'type'=>"movie",
                        'job_end' =>"",
                        'job_start' => $job->fname );
            }
            $lastjob = array();

            $i =0;
            foreach($jobsArray as $dd){
                if($i == 8 )
                $lastjob[]=array('type'=>"ads");

                $lastjob[]=$dd;
                $i++;
            }
          //  $lastjob[count($lastjob)] =    array('type'=>"ads");
            $jobsArray=$lastjob;

        }



        return response()->json(
            $jobsArray
            ,200,[],JSON_NUMERIC_CHECK);


    }
    /*

     */
    public function showJob($desc_id){

        //$seeker_id =Auth::user()->seeker_id;

        $job = DB::table("services")
            ->select('services_id','seekers.seeker_id','gender','phone','email','services.see_it','about','title','body','user_name','fname','city_name','image','code_image', 'domain_name',
                'address' )
            ->join('seekers','seekers.seeker_id','=','services.seeker_id')
            ->join('job_city','job_city.city_id','=','services.city_id')
            ->join('job_domain','job_domain.domain_id','=','services.domain_id')
            ->where('services.services_id','=',$desc_id)
            ->first();


        if($job == null)
             return response()->json(  null ,200,[],JSON_NUMERIC_CHECK);


            DB::table('services')
                ->where('services_id', $desc_id)
                ->update(['see_it' => DB::raw('see_it+1')]);


        $actual_link ="https://www.libyacv.com";
        if($job->image == "") {
            if($job->gender =="f")
                $stringImage= $actual_link."/images/simple/140px_female.png";
            else
                $stringImage= $actual_link."/images/simple/140px_male.png";


        }else{
            $stringImage= $actual_link."/images/seeker/140px_". $job->code_image ."_". $job->image;
        }

        $jobsArray = array(
            "comp_id" =>$job->seeker_id,
            "comp_name" =>$job->title,
            "compt_name" =>$job->fname,


            "see_it" =>$job->see_it,
            "image" =>$stringImage,
             "city_name" =>$job->city_name,
            "domain_name" =>$job->domain_name,
             //"job_skills" =>$job->job_skills,
            "services" =>$job->body,
            "comp_user_name" =>$job->user_name,


            "email" =>$job->email,
            "phone" =>$job->phone,


        );

        return response()->json(
            $jobsArray
            ,200,[],JSON_NUMERIC_CHECK);

    }

    public function showParaSearchJob(){
        $city = Helpers::getDataSeeker('job_city',null,false);
        $domain = Helpers::getDataSeeker('job_domain',null,false);
    //    $type = Helpers::getDataSeeker('job_type',null,false);
     //   $Status = Helpers::getDataSeeker('job_status',null,false);


        return response()->json([
            'city' => $city,
            'domain'=>$domain,
          //  'type' => $type,
           // 'status'=>$Status,
        ], 200);

    }

    public function postJob($id){

        $seeker_id =Auth::user()->seeker_id;

        $lastReq = DB::table('job_seeker_req')
            ->where('seeker_id', $seeker_id)
            ->where('desc_id', $id)
            ->count();
        if($lastReq == 0) {
            DB::table('job_seeker_req')->insert([
                'seeker_id' => $seeker_id,
                'desc_id' => $id,
                'req_date' => date("Y-m-d"),
                'match' => 0,
                'created_at' => \Carbon\Carbon::now(),
            ]);

        }

        return response()->json(['message'=>Helpers::getMessage("saved")]
            , 200);

    }

    public function deleteJob($id){

        $seeker_id =Auth::user()->seeker_id;

        $lastReq = DB::table('job_seeker_req')
            ->where('seeker_id', $seeker_id)
            ->where('desc_id', $id)
            ->count();
        if($lastReq == 1) {
            DB::table('job_seeker_req')
                ->where('seeker_id', $seeker_id)
                ->where('desc_id', $id)
                ->delete();

        }

        return response()->json(['message'=>Helpers::getMessage("saved")]
            , 200);

    }

    public function myJob(){
        $seeker_id =Auth::user()->seeker_id;


        $myjobs = DB::table('job_description')
            ->select('job_seeker_req.seeker_id', 'job_description.desc_id',
                'job_name', 'managers.manager_id','job_seeker_req.req_event', 'companys.comp_id', 'req_date', 'comp_name', 'comp_user_name')
            ->join('job_seeker_req', 'job_seeker_req.desc_id', '=', 'job_description.desc_id')
            ->join('managers', 'managers.manager_id', '=', 'job_description.manager_id')
            ->join('companys', 'companys.comp_id', '=', 'managers.comp_id')
            ->where('job_seeker_req.seeker_id', '=', $seeker_id)
            ->get();

        $stateArr= array(
            0=> "قيد المراجعة",
            1=> "مقبول مبدئيا",
            2=> "مرفوض",
        );
        $jobsArray =  array();
        foreach ($myjobs as $job){
            $jobsArray[] =
                array(
                    'job_name' => $job->job_name .":".$stateArr[$job->req_event],
                    'desc_id' => $job->desc_id,
                );
        }
        return response()->json(["jobsArray"=>$jobsArray]

            ,200,[],JSON_NUMERIC_CHECK);


    }
}
