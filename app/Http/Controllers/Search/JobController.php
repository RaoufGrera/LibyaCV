<?php

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use App\Search;
use App\Helpers;

use Auth;
use Exception;
use Debugbar;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    //


    //Show Companyis
    public function showJob()
    {


        $s = new Search();

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
            $domainName = $_GET['domain'];
        } else {
            $domainName = NULL;
        }
        /*    موظف متعاقد متطوع متدرب */
        if (!empty($_GET['type'])) {
            $typeName = str_replace("-", " ", $_GET['type']);
        } else {
            $typeName = NULL;
        }
        if (!empty($_GET['status'])) {
            $statusName = str_replace("-", " ", $_GET['status']);
        } else {
            $statusName = NULL;
        }


        if (!empty($_GET['page'])) {
            $page = (int)$_GET['page'];
        } else {
            $page = 1;
        }

        $spec = $exp =  $id = NULL;
        $data = array(
            'select' => 'all',
            'id' => NULL,
            'string'    =>  $string,
            'cityName' => $cityName,
            'domainName' => $domainName,
            'typeName' => $typeName,
            'statusName' => $statusName,

            'page' =>  $page,
            'start' =>  NULL,
            'end' =>  NULL,
        );
        $data['select'] = "city";
        $cityDB = $s->searchJob($data);
        $data['select'] = "domain";
        $domainDB = $s->searchJob($data);

        $data['select'] = "all";

        $records_at_page = 20;
        $jobCount = count($s->searchJob($data));

        $data['start'] = 0;
        $data['end'] = 20;
        $arr = $s->searchJob($data);
       // $arrStars = $s->searchJobStars($data);
        $recodes_count = count($arr);
     /*   $jobArr = array();
        foreach ($arr as $val) {
            $jobArr[] = $val;
        }*/
        $arrDomain = Helpers::getDataSeeker('job_domain', null, false);
      //  $arrCity = Helpers::getDataSeeker('job_city', null, false);

       // $arrType = Helpers::getDataSeeker('job_type', null, false);
      //  $arrStatus = Helpers::getDataSeeker('job_status', null, false);




        $page_count = (int)ceil($recodes_count / $records_at_page);

        if ($recodes_count <> 0) {
            if (($page > $page_count) || ($page <= 0)) {
                die('خطاء');
            }
        }

        $start = ($page - 1) * $records_at_page;
        $end = $records_at_page;

        if ($end >= $recodes_count)
            $end = $recodes_count;





        $jobsArray = array();
        $jobsArrStars = array();
        $jobIds = array();





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

        /*  if( $countStars !=0 && $loopStars < 3){
                         $loopStars++;
                         $randNum = rand(0,$countStars -1);


                         $dateArabic = Helpers::arabic_date_format(strtotime($jobsArrStars[$randNum]->created_at));


                         $job_desc = str_limit($jobsArrStars[$randNum]->job_desc, $limit = 80, $ends = '...');
                         $jobsArray[$jobsArrStars[$randNum]->desc_id] =
                             array(
                                 'job_name' => $jobsArrStars[$randNum]->job_name,
                                 'desc_id' => $jobsArrStars[$randNum]->desc_id,
                                  'comp_name' => $jobsArrStars[$randNum]->comp_name,
                                 'isstar' => $jobsArrStars[$randNum]->isstar,
                                 'image' => $jobsArrStars[$randNum]->image,
                                 'image_code' => $jobsArrStars[$randNum]->code_image,
                                 'comp_user_name' => $jobsArrStars[$randNum]->comp_user_name,
                                 'domain_name' => $jobsArrStars[$randNum]->domain_name,
                                 'city_name' => $jobsArrStars[$randNum]->city_name,
                                  'job_desc' => $job_desc,
                                 'see_it' => $jobsArrStars[$randNum]->see_it,
                                 'comp_user_name' => $jobsArrStars[$randNum]->comp_user_name,
                                 'url' => $jobsArrStars[$randNum]->url,
                                 'job_end' => $jobsArrStars[$randNum]->job_end,
                                 'job_start' => $dateArabic );
                         $jobIds[]=$jobsArrStars[$randNum]->desc_id;

                     }*/

        if (count($arr) != 0) {
            foreach ($arr as $jobArr) {


                $dateArabic = Helpers::arabic_date_format(strtotime($jobArr->created_at));

               // $job_desc  = str_limit($jobArr->job_desc, $limit = 120, $ends = '...');

                $jobsArray[$jobArr->desc_id] =
                    array(
                        'job_name' => $jobArr->job_name,
                        'desc_id' => $jobArr->desc_id,
                        'comp_name' => $jobArr->comp_name,
                        'isstar' => ($jobArr->starenddate >= Now()) ? 1 : 0,
                        'is_refresh' => $jobArr->is_refresh,
                        'image' => $jobArr->image,
                        'image_code' => $jobArr->code_image,
                        'comp_user_name' => $jobArr->comp_user_name,
                        'domain_name' => $jobArr->domain_name,
                        'city_name' => $jobArr->city_name,
                        /*'job_desc' => $job_desc,*/

                        'city_color' => $jobColor[$jobArr->city_name],
                        // 'req_count' => $jobArr->req_count,
                        'see_it' => $jobArr->see_it,
                        //'comp_user_name' => $jobArr->comp_user_name,
                        'url' => $jobArr->url,
                        'job_end' => $jobArr->job_end,
                        'job_start' => $dateArabic
                    );
            }
        }


        $urls = $s->searchJobURL($data);




        return view('search.jobs')
            ->with('jobsArray', $jobsArray)
            ->with('city', $cityDB)
            ->with('domain', $domainDB)
        //    ->with('status', $arrStatus)
            ->with('jobCount', $jobCount)


          //  ->with('type', $arrType)

            ->with('urls', $urls)
            ->with('data', $data)

            ->with('page_count', $page_count);
    }
    public function showJobAjax()
    {


        $s = new Search();

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
            $domainName = $_GET['domain'];
        } else {
            $domainName = NULL;
        }
        /*    موظف متعاقد متطوع متدرب */
        if (!empty($_GET['type'])) {
            $typeName = str_replace("-", " ", $_GET['type']);
        } else {
            $typeName = NULL;
        }

        if (!empty($_GET['company'])) {
            $companyName = str_replace("-", " ", $_GET['company']);
        } else {
            $companyName = NULL;
        }

        if (!empty($_GET['spec'])) {
            $specName = str_replace("-", " ", $_GET['spec']);
        } else {
            $specName = NULL;
        }

        if (!empty($_GET['salary'])) {
            $salaryName = str_replace("-", " ", $_GET['salary']);
        } else {
            $salaryName = NULL;
        }
        if (!empty($_GET['status'])) {
            $statusName = str_replace("-", " ", $_GET['status']);
        } else {
            $statusName = NULL;
        }


        if (!empty($_GET['edt'])) {
            $edtName = str_replace("-", "/", $_GET['edt']);
        } else {
            $edtName = NULL;
        }



        if (!empty($_GET['page'])) {
            $page = (int)$_GET['page'];
        } else {
            $page = 1;
        }

        $spec = $exp =  $id = NULL;
        $data = array(
            'select' => 'all',
            'id' => NULL,
            'string'    =>  $string,
            'cityName' => $cityName,
            'domainName' => $domainName,
            'typeName' => $typeName,
            'companyName' => $companyName,
            'edtName' => $edtName,
            'salaryName' => $salaryName,
            'statusName' => $statusName,
            'specName' => $specName,
            'spec' => $spec,
            'page' =>  $page,
            'start' =>  NULL,
            'end' =>  NULL,
        );
        $records_at_page = 20;




        $start = ($page - 1) * $records_at_page;
        $end = $records_at_page;

        $data['start'] = $start;
        $data['end'] = $end;

        $jobs = $s->searchJob($data);


        $jobsArray = array();
        $jobIds = array();


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

        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

        if (count($jobs) != 0) {
            foreach ($jobs as $job) {



                $dateArabic = Helpers::arabic_date_format(strtotime($job->created_at));

                $job_desc  = str_limit($job->job_desc, $limit = 120, $ends = '...');


                if ($job->image == "") {
                    $stringImage = $actual_link . "/images/simple/140px_company.png";
                } else {
                    $stringImage = $actual_link . "/images/company/140px_" . $job->code_image . "_" . $job->image;
                }

                $dir = "";
                if (preg_match('/[^\W_ ]/', $job->job_name)) // '/[^a-z\d]/i' should also work.
                    $dir="ltr";

                $job_url = Helpers::make_slug($job->job_name);
                $jobsArray[$job->desc_down] =
                    array(
                        'job_name' => $job->job_name,
                        'job_url' => $job_url,
                        'desc_id' => $job->desc_id,
                        'comp_name' => $job->comp_name,
                        'isstar' => ($job->starenddate >= Now()) ? 1 : 0,
                        'city_color' => $jobColor[$job->city_name],

                        'image' => $stringImage,
                        'dir' => $dir,
                        'comp_user_name' => $job->comp_user_name,
                        'domain_name' => $job->domain_name,
                        'city_name' => $job->city_name,
                        'job_desc' => $job_desc,
                        // 'req_count' => $jobArr[$t]->req_count,
                        'see_it' => $job->see_it,
                        'url' => $job->url,
                        'job_end' => $job->job_end,
                        'job_start' => $dateArabic
                    );
                //$jobIds[] = $job->desc_id;
            }
        }


        if (count($jobsArray) == 0)
            return response()->json(null, 200, [], JSON_UNESCAPED_UNICODE);


        return response()->json([
            'users' => $jobsArray,
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
    public function domainJob()
    {
        return view('search.domainjob');
    }
}
