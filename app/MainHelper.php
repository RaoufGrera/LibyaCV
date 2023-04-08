<?php
/**
 * Created by PhpStorm.
 * User: Asasna
 * Date: 5/20/2018
 * Time: 12:44 PM
 */

namespace App;
//use SitemapGenerator;

use App\Search;
use App\Helpers;

use Auth;
use Exception;
use Debugbar;
use DB;
use App\Http\Requests;
use Redis;
use Spatie\Sitemap\SitemapGenerator;

class MainHelper
{

    public static function RefreshSiteMap(){

        SitemapGenerator::create('https://example.com')->writeToFile(public_path('sitemap.xml'));
    }
    public static function RefreshWebsite(){




        $dataCity =DB::select('SELECT 
    t.city_id, t.city_name,t.city_name_en,
     (SELECT COUNT(c.city_id) FROM job_description c WHERE c.city_id = t.city_id ) as city_count,
     (SELECT COUNT(s.city_id) FROM seekers s WHERE s.city_id = t.city_id) as seeker_count
FROM job_city t HAVING city_count != 0 order by city_count desc,seeker_count desc');
// and job_end >= Now()

        $dataDomain =DB::select('SELECT 
    t.domain_id, t.domain_name,t.domain_name_en,
     (SELECT COUNT(c.domain_id) FROM job_description c WHERE c.domain_id = t.domain_id) as domain_count,
     (SELECT COUNT(s.domain_id) FROM seekers s WHERE s.domain_id = t.domain_id) as seeker_count
FROM job_domain t HAVING domain_count != 0 order by domain_count desc,seeker_count desc');



        $_imgSrc = '/images/simple';


        $_dataCity='$dataCity';
        $_dataDomain='$dataDomain';

        $allDiv="";
        $allDivDomain="";
        $i=0;

        foreach ($dataCity as $item){
            $tr=  $_imgSrc.'/'.$item->city_name_en.'.jpg';
            $i++;
            $div = '<div class="col-md-3"> <a hreflang="ar" href="/job/search?city='.$item->city_name.'" > <div class="col-md-12 v"> <div class="sdh"><img class="'.$item->city_name_en.'" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAPYAAABZAQMAAAA3lkuwAAAAA1BMVEX///+nxBvIAAAAAXRSTlMAQObYZgAAABlJREFUeNrtwTEBAAAAwqD1T+1lC6AAAIAbCyAAAS6gjfcAAAAASUVORK5CYII=" /><br></div><a href="/job/search?city='.$item->city_name.'">'.$item->city_name.'</a>
                                <span>[ '.$item->city_count.' وظيفة ]
                                <span class="p"> [ '.$item->seeker_count.' باحث ] </span></span>
                            </div></a>
                             </div>';

            $allDiv =$allDiv.$div;

            if($i==4)
                $allDiv=$allDiv.'<div id="city" style="display: none;" class="col-md-12 center oo sdh cont">';
        }

        $java ='<div class="col-md-12"> <span onclick="javascript:ToggleShow(\'city\');" class="text-center t">عرض المزيد/إخفاء</span></div>';
       if($dataCity != null){
           if(count($dataCity) > 4)
               $allDiv=$allDiv. '</div>'.$java;
           else
               $allDiv=$allDiv. '</div>';
       }
       else{
           $allDiv=$allDiv. '</div>';
       }


        //$allDivDomain='<div id="domain"  class="col-md-12 center oo sdh cont">';
        $i=0;
        foreach ($dataDomain as $item){
            $tr=  $_imgSrc.'/'.$item->domain_name_en.'.jpg';
            $i++;
            if($i >=20){
                $div = '<div class="col-md-3"> <a hreflang="ar" href="/job/search?domain='.$item->domain_name.'" > <div class="col-md-12 "><a href="/job/search?domain='.$item->domain_name.'" >'.$item->domain_name.'</a>
                                <span>[ '.$item->domain_count.' وظيفة ]
                                <span class="p"> [ '.$item->seeker_count.' باحث ] </span></span>
                            </div></a>
                             </div>';

            }else {
                $div = '<div class="col-md-3"> <a hreflang="ar" href="/job/search?domain=' . $item->domain_name . '" > <div class="col-md-12 v"> <div class="sdh"><img class="'.$item->domain_name_en.'" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAPYAAABZAQMAAAA3lkuwAAAAA1BMVEX///+nxBvIAAAAAXRSTlMAQObYZgAAABlJREFUeNrtwTEBAAAAwqD1T+1lC6AAAIAbCyAAAS6gjfcAAAAASUVORK5CYII=" /><br></div><a  href="/job/search?domain=' . $item->domain_name . '">' . $item->domain_name . '</a>
                                <span>[ ' . $item->domain_count . ' وظيفة ]
                                  <span class="p"> [ '.$item->seeker_count.' باحث ] </span></span>
                            </div></a>
                             </div>';
            }
            $allDivDomain =$allDivDomain.$div;

            if($i==4)
                $allDivDomain=$allDivDomain.'<div id="domain" style="display: none;" class="col-md-12 center oo sdh cont">';
        }

        $java ='<div class="col-md-12"> <span onclick="javascript:ToggleShow(\'domain\');" class="text-center t">عرض المزيد/إخفاء</span></div>';

        if($dataDomain != null){
            if(count($dataDomain) > 4)
                $allDivDomain=$allDivDomain. '</div>'.$java;
            else
                $allDivDomain=$allDivDomain. '</div>';
        }
        else{
            $allDivDomain=$allDivDomain. '</div>';
        }
        $redis = Redis::connection();
        $dataStatic = null;

       // $dataStatic[0] = DB::table('job_description')
          //  ->where('job_description.job_end', '>=', NOW())
        //    ->count();
        $dataStatic[1] = DB::table('job_description')
            ->count();



        $dataStatic[2] = DB::table('seekers')
            ->count();

//<div class="col-lg-4"><h3>'.$dataStatic[0].'</h3><span class="shr"></span><p>وظيفة متاحة الأن</p></div>
        $divStatic = '
             <div class="col-lg-6"><h3>'.$dataStatic[1].'</h3><span class="shr"></span> <p>وظيفة</p></div> 
             <div class="col-lg-6"><h3>'.$dataStatic[2].'</h3><span class="shr"></span> <p>باحث عن عمل</p></div>';

        $dataJob = DB::table("job_description")->count();
        $dataSeekers = DB::table("seekers")->count();
        $dataCompany = DB::table("companys")->count();
        $dataServices = DB::table("services")->count();

        $allData = array("desc"=>$dataJob,"seekers"=>$dataSeekers,"company"=>$dataCompany,"services"=>$dataServices);


        $redis->set('welcome:data',json_encode($allData,JSON_UNESCAPED_UNICODE));

        $redis->set('welcome:city',json_encode($allDiv,JSON_UNESCAPED_UNICODE));
        $redis->set('welcome:domain',json_encode($allDivDomain,JSON_UNESCAPED_UNICODE));
        $redis->set('welcome:static',json_encode($divStatic,JSON_UNESCAPED_UNICODE));


        $redis->set('welcome:city',json_encode($allDiv,JSON_UNESCAPED_UNICODE));
        $redis->set('welcome:domain',json_encode($allDivDomain,JSON_UNESCAPED_UNICODE));


    }

    public static function RefreshWebsiteV2(){

        $s = new Search();

        $spec = $exp =  $id = NULL;
        $data = array(
            'select' => 'all',
            'id' => NULL,
            'string'    =>  NULL,
            'cityName' => NULL,
            'domainName' => NULL,
            'typeName' => NULL,
            'statusName' => NULL,

            'page' =>  1,
            'start' =>  NULL,
            'end' =>  NULL,
        );
        $records_at_page = 18;

        $data['start'] = 0;
        $data['end'] = 18;
        $arr = $s->searchJob($data);
        $jobArr = array();
        foreach ($arr as $val) {
            $jobArr[] = $val;
        }
      /*  $arrDomain = Helpers::getDataSeeker('job_domain', null, false);
        $arrCity = Helpers::getDataSeeker('job_city', null, false);

        $arrType = Helpers::getDataSeeker('job_type', null, false);
        $arrStatus = Helpers::getDataSeeker('job_status', null, false);*/
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
        $start = (1 - 1) * $records_at_page;
        $end = $records_at_page;
        if (count($jobArr) != 0) {
            for ($t = $start; $t < $end + $start; $t++) {


                $dateArabic = Helpers::arabic_date_format(strtotime($jobArr[$t]->created_at));

                $job_desc  = str_limit($jobArr[$t]->job_desc, $limit = 120, $ends = '...');

                $jobsArray[$jobArr[$t]->desc_id] =
                    array(
                        'job_name' => $jobArr[$t]->job_name,
                        'desc_id' => $jobArr[$t]->desc_id,
                        'comp_name' => $jobArr[$t]->comp_name,
                        'isstar' => ($jobArr[$t]->starenddate >= Now()) ? 1 : 0,
                        'is_refresh' => $jobArr[$t]->is_refresh,
                        'image' => $jobArr[$t]->image,
                        'image_code' => $jobArr[$t]->code_image,
                        'comp_user_name' => $jobArr[$t]->comp_user_name,
                        'domain_name' => $jobArr[$t]->domain_name,
                        'city_name' => $jobArr[$t]->city_name,
                        /*'job_desc' => $job_desc,*/

                        'city_color' => $jobColor[$jobArr[$t]->city_name],
                        // 'req_count' => $jobArr[$t]->req_count,
                        'see_it' => $jobArr[$t]->see_it,
                        //'comp_user_name' => $jobArr[$t]->comp_user_name,
                        'url' => $jobArr[$t]->url,
                        'job_end' => $jobArr[$t]->job_end,
                        'job_start' => $dateArabic
                    );
            }
        }
        $_imgSrc = '/images/';

        $allDiv='<div><div class="col-lg-6 bbr">';
        $i =0;
        foreach($jobsArray as $jobArray ){

            $job_name  = str_limit($jobArray["job_name"], $limit = 45, $ends = '...');

            if($jobArray['image'] != ''){
           $image = "company/140px_".$jobArray['image_code']."_".$jobArray['image'];

            }else{
                $image ="simple/140px_company.png";
            }


                 $tr=  $_imgSrc.$image;

            $separator="-";
            $string = $jobArray['job_name'];
            $string = trim($string);
            $string = mb_strtolower($string, 'UTF-8');
            $string = preg_replace("/[^a-z0-9_\s\-ءاآؤئبپتثجچحخدذرزژسشصضطظعغفقكکگلمنوهی]/u", '', $string);
            $string = preg_replace("/[\s-_]+/", ' ', $string);
            $string = preg_replace("/[\s_]/", $separator, $string);

            $dir = "";
            if (preg_match('/[^\W_ ]/', $jobArray['job_name'])) // '/[^a-z\d]/i' should also work.
                $dir="ltr";
        $mlk =  $string;
                 $div = '<div class="job-div"><div class="cv-body">
                                 <div class="devimgseeker">
                                <a itemprop="'.$job_name.'" href="/job/'.$jobArray["desc_id"].'/'.$mlk.'"><img alt="'.$jobArray['comp_name'].'" class="imgjob-view"
                                     src="'.$tr.'" /></a></div><div class="line"><h2 class=" display '.$dir.'">
                                     <a  id="cvname" href="/job/'.$jobArray['desc_id'].'/'.$mlk.'">'. $job_name.' </a></h2>
                                           <span class="r"><span class="texts "><a class="icon-location '.$jobArray['city_color'].'" style="color: #FFFFFF;" href="job/search?city='.$jobArray['city_name'].'">'.$jobArray['city_name'].'</a></span>
                                          <span class="texts"> <i class="icon-heart" ></i>'.$jobArray['see_it'].'</span> &nbsp;<span>'.$jobArray['job_start'].'</span></span></div></div> </div>';
            $allDiv =$allDiv.$div;
            if($i==8)
                $allDiv=$allDiv.'</div><div class="col-lg-6 ">';

            $i++;

}



        $allDiv=$allDiv.'</div></div><div style="margin-top: 30px;" class="col-lg-12"></div><a id="more" class="btn btn-lg  btn-default center"  href="/job/search"><span>مشاهدة المزيد  </span></a>';

        $redis = Redis::connection();
        $dataStatic = null;

        // $dataStatic[0] = DB::table('job_description')
        //  ->where('job_description.job_end', '>=', NOW())
        //    ->count();
        $dataStatic[1] = DB::table('job_description')
            ->count();



        $dataStatic[2] = DB::table('seekers')
            ->count();

//<div class="col-lg-4"><h3>'.$dataStatic[0].'</h3><span class="shr"></span><p>وظيفة متاحة الأن</p></div>
        $divStatic = '
             <div class="col-lg-6"><h3>'.$dataStatic[1].'</h3><span class="shr"></span> <p>وظيفة</p></div> 
             <div class="col-lg-6"><h3>'.$dataStatic[2].'</h3><span class="shr"></span> <p>باحث عن عمل</p></div>';

        $dataJob = DB::table("job_description")->count();
        $dataSeekers = DB::table("seekers")->count();
        $dataCompany = DB::table("companys")->count();
        $dataServices = DB::table("services")->count();

        $allData = array("desc"=>$dataJob,"seekers"=>$dataSeekers,"company"=>$dataCompany,"services"=>$dataServices);


        $redis->set('welcome:data',json_encode($allData,JSON_UNESCAPED_UNICODE));

        $redis->set('welcome:city',json_encode($allDiv,JSON_UNESCAPED_UNICODE));
      //  $redis->set('welcome:domain',json_encode($allDivDomain,JSON_UNESCAPED_UNICODE));
        $redis->set('welcome:static',json_encode($divStatic,JSON_UNESCAPED_UNICODE));


        $redis->set('welcome:city',json_encode($allDiv,JSON_UNESCAPED_UNICODE));
      //  $redis->set('welcome:domain',json_encode($allDivDomain,JSON_UNESCAPED_UNICODE));


    }
    public static function make_slug($string, $separator = '-')
    {
        $string = trim($string);
        $string = mb_strtolower($string, 'UTF-8');
        $string = preg_replace("/[^a-z0-9_\s\-ءاآؤئبپتثجچحخدذرزژسشصضطظعغفقكکگلمنوهی]/u", '', $string);
        $string = preg_replace("/[\s-_]+/", ' ', $string);
        $string = preg_replace("/[\s_]/", $separator, $string);

        return $string;
    }
    public static function Services(){


        $url = "http://esoft.ly/api/Customer/getCustomer/169/?key=AAAAAA";


        $client = new \GuzzleHttp\Client();
        $res = $client->get($url);
        $GuzzleArr = json_decode($res->getBody(), true);


            return $GuzzleArr; //response()->json($GuzzleArr , 200, [], JSON_NUMERIC_CHECK);
    }

}