<?php

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use App\Search;
use Auth;
use DB;
use App\Helpers;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ServicesController extends Controller
{
    //

    //Show Companyis
    public function showServices(){

        $s = new Search();

        if(!empty($_GET['string'])){ $string = str_replace("-"," ",$_GET['string']); }else{ $string =NULL; }

        if(!empty($_GET['city'])){ $cityName = str_replace("-"," ",$_GET['city']); }else{ $cityName =NULL; }

        if(!empty($_GET['domain'])){ $domainName = str_replace("-"," ",$_GET['domain']); }else{ $domainName =NULL; }



        if(!empty($_GET['page'])){ $page = (int) $_GET['page']; }else{ $page =1; }

        $data = array(
            'select' => 'all',
            'string'    =>  $string,
            'cityName' => $cityName,
            'domainName' => $domainName,

            'page' =>  $page,
            'start' =>  NULL,
            'end' =>  NULL,
        );
        $records_at_page = 10;
        $data['start'] = 0;
        $data['end'] = 10;
        $arr = $s->SearchServices($data);
         $recodes_count = count($arr);
        $jobArr = array();
        foreach ($arr as $val) {
            $jobArr[] = $val;
        }
        $city =    Helpers::getDataSeeker('job_city',null,false);
        $domain =  Helpers::getDataSeeker('job_domain',null,false);
         $page_count = (int) ceil($recodes_count / $records_at_page );

        if($recodes_count <> 0){
            if(($page > $page_count) || ($page <= 0)){
                die('خطاء');
            }}

        $start= ($page -1) * $records_at_page;
        $end = $records_at_page;

        if($end >= $recodes_count)
            $end=$recodes_count;

        $jobsArray = array();
        $jobsArrStars = array();
        $jobIds = array();


        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

        $loopStars =0;
        if(count($jobArr) != 0) {
            for ($t = $start; $t < $end+$start; $t++) {

                if($jobArr[$t]->image == ""  ) {
                    if ($jobArr[$t]->gender == "m")
                        $stringImage = $actual_link."/images/simple/140px_male.png";
                    else
                        $stringImage =$actual_link."/images/simple/140px_female.png";
                }else{
                    $stringImage= $actual_link."/images/seeker/140px_". $jobArr[$t]->code_image ."_". $jobArr[$t]->image;
                }
                $ser  = str_limit($jobArr[$t]->body, $limit = 160, $ends = '...');

                $jobsArray[$jobArr[$t]->services_id] =
                    array(
                        'fname' => $jobArr[$t]->fname,
                        'user_name' => $jobArr[$t]->user_name,
                        'title' => $jobArr[$t]->title,
                        'gender' => $jobArr[$t]->gender,
                        'services_id' =>$jobArr[$t]->services_id,
                        'image' => $stringImage,
                        'about' => $jobArr[$t]->about,
                        'code_image' => $jobArr[$t]->code_image,
                        'domain_name' => $jobArr[$t]->domain_name,
                        'city_name' => $jobArr[$t]->city_name,
                        'body' => $ser,
                       );

            }


        }
        $urls = $s->searchServicesURL($data);




        return view('search.services')
                ->with('companyArray',$jobsArray)
                ->with('city',$city)
                ->with('domain',$domain)
                ->with('urls',$urls)
                ->with('data',$data)
                ->with('page_count',$page_count);


    }
    public  function  showServicesAjax(Request $request){
        $s = new Search();

        if(!empty($_GET['string'])){ $string = str_replace("-"," ",$_GET['string']); }else{ $string =NULL; }

        if(!empty($_GET['city'])){ $cityName = str_replace("-"," ",$_GET['city']); }else{ $cityName =NULL; }

        if(!empty($_GET['domain'])){ $domainName = str_replace("-"," ",$_GET['domain']); }else{ $domainName =NULL; }



        if(!empty($_GET['page'])){ $page = (int) $_GET['page']; }else{ $page =1; }

        $data = array(
            'select' => 'all',
            'string'    =>  $string,
            'cityName' => $cityName,
            'domainName' => $domainName,

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


       // $arrStars= $s->searchCompanyStar($data);
        $data['start'] = NULL;
        $data['end'] = NULL;

        $jobsArray = array();
     //   $jobsArrStars = array();
        $jobsArrayStars = array();
        $jobIds = array();

        /*foreach ($arrStars as $item) {
            $jobsArrStars[] = $item;
        }*/
       // $countStars = count($jobsArrStars);

        $loopStars =0;
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

        if(count($jobs) != 0) {
            foreach ($jobs as $job) {

                $ser  = str_limit($job->body, $limit = 160, $ends = '...');

                if($ser == null)
                    $ser="";
                if($job->image == "" || $job->image_view !=1 ) {
                    if ($job->gender == "m")
                        $stringImage = $actual_link."/images/simple/140px_male.png";
                    else
                        $stringImage =$actual_link."/images/simple/140px_female.png";
                }else{
                    $stringImage= $actual_link."/images/seeker/140px_". $job->code_image ."_". $job->image;
                }
                $jobsArray[$job->services_id] =
                    array(
                        'services_id' =>$job->services_id,

                        'fname' => $job->fname,
                        'user_name' => $job->user_name,
                        'title' => $job->title,
                        'gender' => $job->gender,

                        'image' => $stringImage,
                        'about' => $job->about,
                        'code_image' => $job->code_image,
                        'domain_name' => $job->domain_name,
                        'city_name' => $job->city_name,
                        'body' => $ser,

                    );

            }
        }

        if(count($jobsArray) ==0)
            return response()->json(null,200,[],JSON_UNESCAPED_UNICODE);


        return response()->json([
            'users' => $jobsArray,
        ], 200, [], JSON_UNESCAPED_UNICODE);



    }
}
