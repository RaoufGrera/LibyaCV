<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Seeker;
use DB;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use Mail;
use App\Mail\NewUserConfirm;
use Redis;

class viewController
{
    //
    public function index(){

       /* if(!empty(session('seeker_id')))
            return   redirect('/profile/dashboard');
*/

   /* $url = "https://fcm.googleapis.com/fcm/send";
    $token = "cQYeePNn3Xc:APA91bEDTsDqnxB5kyQhUTYjYge0W5xuznWEcoXI4y5VdoazoRyQwDgeVsNNFqFR2lGb6UZXo2yq186k1JJZZGwcwZMyQ4BpwnxaEu-e9h3yRcoj7fvbl7u82U7UKRNDX8B6M-163OwZ";
    $serverKey = 'AAAA6Bhr9Q8:APA91bEYNLEUW5rGrnjVGFyx1T11FDHS_Wf0TX_aonU-cWGBuOvuCkm9C3Z2SrUJQioRppSDVdISj1IdgIOCK1ZtG65ZBxiONHgYzGhJ67-dX7mqlzb51P4wC6zOyzRymADmRKJ--mrE';
    $title = "Notification title";
    $body = "Hello I am from Your php server";
    $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1');
    $data = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1');
    $arrayToSend = array('to' => $token,'data'=>$data);
    $json = json_encode($arrayToSend);
    $headers = array();
    dump($json);
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: key='. $serverKey;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    //Send the request
    $response = curl_exec($ch);
    //Close request
    if ($response === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);*/

        $redis = Redis::connection();


        $dataDomainRedis= $redis->get('welcome:domain');

         $dataCityRedis= $redis->get('welcome:city');
         $dataStaticRedis= $redis->get('welcome:static');
         $dataCity = json_decode( $dataCityRedis, TRUE );
        $dataDomain = json_decode( $dataDomainRedis, TRUE );
        $dataStatic = json_decode( $dataStaticRedis, TRUE );



        return view('welcome')
            ->with('dataCity',$dataCity)
            ->with('dataStatic',$dataStatic)
            ->with('dataDomain',$dataDomain);

        
    }

    public function createTestR()
    {


        $dataCity = DB::select('SELECT 
    t.city_id, t.city_name,t.city_name_en,
     (SELECT COUNT(c.city_id) FROM job_description c WHERE c.city_id = t.city_id ) as city_count,
     (SELECT COUNT(s.city_id) FROM seekers s WHERE s.city_id = t.city_id) as seeker_count
FROM job_city t');


        $dataDomain = DB::select('SELECT 
    t.domain_id, t.domain_name,t.domain_name_en,
     (SELECT COUNT(c.domain_id) FROM job_description c WHERE c.domain_id = t.domain_id) as domain_count,
     (SELECT COUNT(s.domain_id) FROM seekers s WHERE s.domain_id = t.domain_id) as seeker_count
FROM job_domain t order by domain_count desc,seeker_count desc');



        $dataJob = DB::table("job_description")->count();
        $dataSeekers = DB::table("seekers")->count();
        $dataCompany = DB::table("companys")->count();
        $dataServices = DB::table("services")->count();

        $allData = array("desc"=>$dataJob,"seekers"=>$dataSeekers,"company"=>$dataCompany,"services"=>$dataServices);


        $_imgSrc = '/images/simple';


        $_dataCity = '$dataCity';
        $_dataDomain = '$dataDomain';

        $allDiv = "";
        $allDivDomain = "";
        $i = 0;
        foreach ($dataCity as $item) {
            $tr = $_imgSrc . '/' . $item->city_name_en . '.jpg';
            $i++;
            $div = '<div class="col-md-3"> <a hreflang="ar" href="/job/search?city=' . $item->city_name . '" > <div class="col-md-12 v"> <div class="sdh"><img src="' . $tr . '" alt=' . $item->city_name . '/><br></div><a href="/job/search?city=' . $item->city_name . '">' . $item->city_name . '</a>
                                <span>[ ' . $item->city_count . ' وظيفة ]
                                <span class="p"> [ ' . $item->seeker_count . ' باحث ] </span></span>
                            </div></a>
                             </div>';

            $allDiv = $allDiv . $div;

            if ($i == 4)
                $allDiv = $allDiv . '<div id="city" style="display: none;" class="col-md-12 center oo sdh cont">';
        }
        $allDiv = $allDiv . '</div>';


        //$allDivDomain='<div id="domain"  class="col-md-12 center oo sdh cont">';
        $i = 0;
        foreach ($dataDomain as $item) {
            $tr = $_imgSrc . '/' . $item->domain_name_en . '.jpg';
            $i++;
            if ($i >= 20) {
                $div = '<div class="col-md-3"> <a hreflang="ar" href="/job/search?domain=' . $item->domain_name . '" > <div class="col-md-12 "><a href="/job/search?domain=' . $item->domain_name . '" >' . $item->domain_name . '</a>
                                <span>[ ' . $item->domain_count . ' وظيفة ]
                                <span class="p"> [ ' . $item->seeker_count . ' باحث ] </span></span>
                            </div></a>
                             </div>';

            } else {
                $div = '<div class="col-md-3"> <a hreflang="ar" href="/job/search?domain=' . $item->domain_name . '" > <div class="col-md-12 v"> <div class="sdh"><img src="' . $tr . '" alt=' . $item->domain_name . ' /><br></div><a  href="/job/search?domain=' . $item->domain_name . '">' . $item->domain_name . '</a>
                                <span>[ ' . $item->domain_count . ' وظيفة ]
                                  <span class="p"> [ ' . $item->seeker_count . ' باحث ] </span></span>
                            </div></a>
                             </div>';
            }
            $allDivDomain = $allDivDomain . $div;

            if ($i == 4)
                $allDivDomain = $allDivDomain . '<div id="domain" style="display: none;" class="col-md-12 center oo sdh cont">';
        }

        $allDivDomain = $allDivDomain . '</div>';
        $redis = Redis::connection();

        $dataStatic = null;

        $dataStatic[0] = DB::table('job_description')
            //->where('job_description.job_end', '>=', NOW())
            ->count();
        $dataStatic[1] = DB::table('job_description')
            ->count();



        $dataStatic[2] = DB::table('seekers')
            ->count();


            $divStatic = '<div class="col-lg-4"><h3>'.$dataStatic[0].'</h3><span class="shr"></span><p>وظيفة متاحة الأن</p></div> 
             <div class="col-lg-4"><h3>'.$dataStatic[1].'</h3><span class="shr"></span> <p>وظيفة تم نشرها</p></div> 
             <div class="col-lg-4"><h3>'.$dataStatic[2].'</h3><span class="shr"></span> <p>باحث عن عمل</p></div>';



         $redis->set('welcome:city',json_encode($allDiv,JSON_UNESCAPED_UNICODE));
        $redis->set('welcome:domain',json_encode($allDivDomain,JSON_UNESCAPED_UNICODE));
        $redis->set('welcome:static',json_encode($divStatic,JSON_UNESCAPED_UNICODE));
        $redis->set('welcome:data',json_encode($allData,JSON_UNESCAPED_UNICODE));

        echo "ok";
    }

    public function sendFireBase(){

      /*  */

        $initialMem = memory_get_usage();

        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);
        $notificationBuilder = new PayloadNotificationBuilder('Libya CV');
        $dataBuilder = new PayloadDataBuilder();

        $dataBuilder->addData(['a_data' => 'my_data']);

        $option = $optionBuilder->build();
        $data = $dataBuilder->build();






// You must change it to get your tokens
        $tokens = DB::table('seekers')
         /*   ->join('notifications','notifications.seeker_id','=','seekers.seeker_id')
            ->where('note_type_id',3)
            ->where('isread',0)*/

            ->whereNotNull('fcm_token')
            ->select('fcm_token')->get();
            /*
if(count($tokens) !=0){
        DB::table('notifications')
            ->where('isread',0)
            ->where('note_type_id',3)
            ->update([
            'isread'=>1,
        ]);*/


        foreach ($tokens as $item){



              $notificationBuilder->setBody("Titel")
                ->setSound('default') ;
            $notification = $notificationBuilder->build();


        $downstreamResponse = FCM::sendTo($item->fcm_token, $option, $notification, $data);
             $downstreamResponse->numberSuccess();
            $downstreamResponse->numberFailure();
            $downstreamResponse->numberModification();
        }


        /* Script comes here */
        $finalMem = memory_get_peak_usage();
        echo ($finalMem - $initialMem)/1024 . " Kbytes";
    }

    public function sendSpecFireBase1(){

        $initialMem = memory_get_usage();

        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder('my title');
        $notificationBuilder->setBody('Hello world')
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        $token = "cQYeePNn3Xc:APA91bEDTsDqnxB5kyQhUTYjYge0W5xuznWEcoXI4y5VdoazoRyQwDgeVsNNFqFR2lGb6UZXo2yq186k1JJZZGwcwZMyQ4BpwnxaEu-e9h3yRcoj7fvbl7u82U7UKRNDX8B6M-163OwZ";
        //$token = "cQYeePNn3Xc:APA91bEDTsDqnxB5kyQhUTYjYge0W5xuznWEcoXI4y5VdoazoRyQwDgeVsNNFqFR2lGb6UZXo2yq186k1JJZZGwcwZMyQ4BpwnxaEu-e9h3yRcoj7fvbl7u82U7UKRNDX8B6M-163OwZ";
        dump($data);

       // fwsT0iVXLvw:APA91bGFobU1gVln-5DfXB-aKUV4gd9gmBVE15kt4v5sXyjsGBTdsJsGgTMPPs8iDFYVqfE9sUt4s1wG5HzVM3F_vtkBNwZjrSKzzlNcjKYQhkcwDvpJFyih4dfHqGvHr8pOf7ibBWRU
        $downstreamResponse = FCM::sendTo($token, $option, null, $data);

        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();
        dump($downstreamResponse);

        $finalMem = memory_get_peak_usage();
        echo ($finalMem - $initialMem)/1024 . " Kbytes";



    }
    public function sendSpecFireBase(){

        $initialMem = memory_get_usage();

        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder('my title');
        $notificationBuilder->setBody('Hello world')
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $token = "cisRP68Q8Xg:APA91bHGsM6iVuRNf9krU_Z_IS1QZ1p9eUKObUQzIe4nJomz9Yhs5hm_kRNkLBbvM4Mk-wEBkbyZ8HKUxXZU4GxUR9b6PiaYPbR3xt_f5hfi0SFF5nmTs0yOHsGLs4X5EOieIItjPD0A";

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();


        dump($downstreamResponse);

        $finalMem = memory_get_peak_usage();
        echo ($finalMem - $initialMem)/1024 . " Kbytes";



    }
    public function sendEmail(){

        //Mail::to('raouf.grera@gmail.com')->send(new NewUserConfirm());
    }

}
