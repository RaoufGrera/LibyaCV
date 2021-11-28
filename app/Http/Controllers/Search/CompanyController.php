<?php

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use App\Search;
use Auth;
use DB;
use App\Helpers;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    //

    //Show Companyis
    public function showCompany(){

        $s = new Search();

        if(!empty($_GET['string'])){ $string = str_replace("-"," ",$_GET['string']); }else{ $string =NULL; }

        if(!empty($_GET['city'])){ $cityName = str_replace("-"," ",$_GET['city']); }else{ $cityName =NULL; }

        if(!empty($_GET['domain'])){ $domainName = str_replace("-"," ",$_GET['domain']); }else{ $domainName =NULL; }

        if(!empty($_GET['type'])){ $typeName = str_replace("-"," ",$_GET['type']); }else{ $typeName =NULL; }


        if(!empty($_GET['page'])){ $page = (int) $_GET['page']; }else{ $page =1; }

        $data = array(
            'select' => 'all',
            'string'    =>  $string,
            'cityName' => $cityName,
            'domainName' => $domainName,
            'typeName' => $typeName,

            'page' =>  $page,
            'start' =>  NULL,
            'end' =>  NULL,
        );
        $records_at_page = 10;
        $data['start'] = 0;
        $data['end'] = 10;
        $arr = $s->searchCompany($data);
        $arrStars= $s->searchCompanyStar($data);
        $recodes_count = count($arr);
        $jobArr = array();
        foreach ($arr as $val) {
            $jobArr[] = $val;
        }
        $city =    Helpers::getDataSeeker('job_city',null,false);
        $domain =  Helpers::getDataSeeker('job_domain',null,false);
        $type = Helpers::getDataSeeker('job_comp_type',null,false);;
        $page_count = (int) ceil($recodes_count / $records_at_page );
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

        foreach ($arrStars as $item) {
            $jobsArrStars[] = $item;
        }
        $countStars = count($jobsArrStars);

        $loopStars =0;
        if(count($jobArr) != 0) {
            for ($t = $start; $t < $end+$start; $t++) {
              /*  if( $countStars !=0 && $loopStars < 3){
                    $loopStars++;
                    $randNum = rand(0,$countStars -1);
                    $ser  = str_limit($jobsArrStars[$randNum]->services, $limit = 160, $ends = '...');

                    $jobsArray[$jobsArrStars[$randNum]->comp_id] =
                        array(
                            'comp_name' => $jobsArrStars[$randNum]->comp_name,
                            'comp_id' => $jobsArrStars[$randNum]->comp_id,
                            'comp_user_name' => $jobsArrStars[$randNum]->comp_user_name,
                            'isstar' => $jobsArrStars[$randNum]->isstar,
                            'image' => $jobsArrStars[$randNum]->image,
                            'code_image' => $jobsArrStars[$randNum]->code_image,
                            'about' => $jobsArrStars[$randNum]->about,
                            'compt_name' => $jobsArrStars[$randNum]->compt_name,
                             'domain_name' => $jobsArrStars[$randNum]->domain_name,
                            'city_name' => $jobsArrStars[$randNum]->city_name,
                            'services' => $ser,
                             'see_it' => $jobsArrStars[$randNum]->see_it,
                            'url' => $jobsArrStars[$randNum]->url,
                              );
                    $jobIds[]=$jobsArrStars[$randNum]->comp_id;

                }*/

                $ser  = str_limit($jobArr[$t]->services, $limit = 160, $ends = '...');
                $jobCount = DB::table('managers')
                    ->join('job_description','job_description.manager_id','=','managers.manager_id')
                    ->where('managers.comp_id','=',$jobArr[$t]->comp_id)
                    ->count();


                $jobsArray[$jobArr[$t]->comp_id] =
                    array(
                        'comp_name' => $jobArr[$t]->comp_name,
                        'comp_id' => $jobArr[$t]->comp_id,
                        'comp_user_name' => $jobArr[$t]->comp_user_name,
                        'isstar' => ($jobArr[$t]->endstar >= Now()) ? 1 :0,
                        'city_color' => $jobColor[$jobArr[$t]->city_name],

                        'image' => $jobArr[$t]->image,
                        'job_count' => $jobCount,
                        'about' => $jobArr[$t]->about,
                        'phone' => $jobArr[$t]->phone,
                        'email' => $jobArr[$t]->email,
                        'facebook' => $jobArr[$t]->facebook,
                        'website' => $jobArr[$t]->website,
                        'compt_name' => $jobArr[$t]->compt_name,
                        'code_image' => $jobArr[$t]->code_image,
                         'domain_name' => $jobArr[$t]->domain_name,
                        'city_name' => $jobArr[$t]->city_name,
                        'services' => $ser,
                         'see_it' => $jobArr[$t]->see_it,
                        'url' => $jobArr[$t]->url,
                      );

            }
        }
        $urls = $s->searchCompanyURL($data);


        $jobCount = DB::table('companys')->count();


        return view('search.companys')
            ->with('companyArray',$jobsArray)
             ->with('city',$city)
            ->with('domain',$domain)
            ->with('type',$type)
            ->with('urls',$urls)
            ->with('data',$data)
            ->with('jobCount',$jobCount)
            ->with('page_count',$page_count);


    }
    public  function  showCompanyAjax(Request $request){
        $s = new Search();

        if(!empty($_GET['string'])){ $string = str_replace("-"," ",$_GET['string']); }else{ $string =NULL; }

        if(!empty($_GET['city'])){ $cityName = str_replace("-"," ",$_GET['city']); }else{ $cityName =NULL; }

        if(!empty($_GET['domain'])){ $domainName = str_replace("-"," ",$_GET['domain']); }else{ $domainName =NULL; }

        if(!empty($_GET['type'])){ $typeName = str_replace("-"," ",$_GET['type']); }else{ $typeName =NULL; }


        if(!empty($_GET['page'])){ $page = (int) $_GET['page']; }else{ $page =1; }

        $data = array(
            'select' => 'all',
            'string'    =>  $string,
            'cityName' => $cityName,
            'domainName' => $domainName,
            'typeName' => $typeName,

            'page' =>  $page,
            'start' =>  NULL,
            'end' =>  NULL,
        );
        $records_at_page = 10;
        $start= ($page -1) * $records_at_page;
        $end = $records_at_page;

        $data['start'] = $start;
        $data['end'] = $end;
        $jobs = $s->searchCompany($data);

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
              /*  if( $countStars !=0 && $loopStars < 3){
                    $loopStars++;
                    $randNum = rand(0,$countStars -1);
                    if($jobsArrStars[$randNum]->image == "") {
                        $stringImage= $actual_link."/images/simple/140px_company.png";

                    }else{
                        $stringImage= $actual_link."/images/company/140px_". $jobsArrStars[$randNum]->code_image ."_". $jobsArrStars[$randNum]->image;
                    }
                    $jobsArray[$jobsArrStars[$randNum]->comp_id] =
                        array(
                            'comp_name' => $jobsArrStars[$randNum]->comp_name,
                            'comp_id' => $jobsArrStars[$randNum]->comp_id,
                            'comp_user_name' => $jobsArrStars[$randNum]->comp_user_name,
                            'isstar' => $jobsArrStars[$randNum]->isstar,
                            'image' => $stringImage,
                             'about' => $jobsArrStars[$randNum]->about,
                            'compt_name' => $jobsArrStars[$randNum]->compt_name,
                            'domain_name' => $jobsArrStars[$randNum]->domain_name,
                            'city_name' => $jobsArrStars[$randNum]->city_name,
                            'see_it' => $jobsArrStars[$randNum]->see_it,
                            'url' => $jobsArrStars[$randNum]->url,
                        );
                    $jobIds[]=$jobsArrStars[$randNum]->comp_id;

                }*/
                $ser  = str_limit($job->services, $limit = 160, $ends = '...');

                if($ser == null)
                    $ser="";
                if($job->image == "") {
                    $stringImage= $actual_link."/images/simple/140px_company.png";

                }else{
                    $stringImage= $actual_link."/images/company/140px_". $job->code_image ."_". $job->image;
                }

                $jobCount = DB::table('managers')
                    ->join('job_description','job_description.manager_id','=','managers.manager_id')
                    ->where('managers.comp_id','=',$job->comp_id)
                    ->count();
                $jobsArray[$job->comp_id] =
                    array(
                        'comp_name' => $job->comp_name,
                        'comp_id' => $job->comp_id,
                        'comp_user_name' => $job->comp_user_name,
                        'isstar' => ($job->endstar >= Now()) ? 1 :0,
                        'services' => $ser,
                        'city_color' => $jobColor[$job->city_name],
                        'phone' => $job->phone,
                        'email' => $job->email,
                        'website' => $job->website,
                        'facebook' => $job->facebook,
                        'image' => $stringImage,
                        'job_count' => $jobCount,
                        'about' => $job->about,
                        'compt_name' => $job->compt_name,
                        'code_image' => $job->code_image,
                        'domain_name' => $job->domain_name,
                        'city_name' => $job->city_name,
                        'see_it' => $job->see_it,
                        'url' => $job->url,
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
