<?php
/**
 * Created by PhpStorm.
 * User: Asasna
 * Date: 2/2/2018
 * Time: 2:35 AM
 */

namespace App;

use App\Jobs\SendNoteAndroidJob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helpers;
use App\SeekerPrice;
use Intervention\Image\Facades\Image;
use Redis;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use Illuminate\Support\Facades\Log;
use IvoPetkov\HTML5DOMDocument;
use App\Desc;
use App\Jobs\NoteAddJob;
use App\Guest;
use Illuminate\Bus\Queueable;
use Notification;
use App\Notifications\SendWebNoti;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Spatie\Sitemap\SitemapGenerator;


use  Session;
use Datetime;

class AndroidHelpers
{


    public static function site()
    { 
            /* SitemapGenerator::create("https://www.libyacv.com")
                 ->writeToFile(public_path('sitemap.xml'));*/
     
             $sitemap = App::make('sitemap');
     
             // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
             // by default cache is disabled
             $sitemap->setCache('laravel.sitemap', 60);
     
             $images=null;
             // check if there is cached sitemap and build new only if is not
             if (!$sitemap->isCached()) {
                 // add item to the sitemap (url, date, priority, freq)
                 $sitemap->add('https://www.libyacv.com/', '2019-10-1T20:10:00+02:00', '1.0', 'daily');
                 $sitemap->add('https://www.libyacv.com/job/search', '2019-10-1T20:10:00+02:00', '1.0', 'daily');
                 $sitemap->add('https://www.libyacv.com/cv/search', '2019-10-1T20:10:00+02:00', '1.0', 'daily');
                 $sitemap->add('https://www.libyacv.com/company/search', '2019-10-1T20:10:00+02:00', '1.0', 'monthly');
                 $sitemap->add('https://www.libyacv.com/free-cv-template', '2019-10-1T20:10:00+02:00', '1.0', 'monthly');
                 $sitemap->add('https://www.libyacv.com/free-cv-template/arabic-resume', '2019-10-1T20:10:00+02:00', '1.0', 'monthly');
                 $sitemap->add('https://www.libyacv.com/free-cv-template/english-resume', '2019-10-1T20:10:00+02:00', '1.0', 'monthly');
     
                 // get all posts from db, with image relations
                 $_imgSrc = 'images/';
                 $urljob = 'https://www.libyacv.com/job/';
                 $url = 'https://www.libyacv.com/';
                 $posts = DB::table('job_description')
                     ->select('job_description.desc_id','comp_name','job_name','image','code_image','job_description.created_at')
                     ->join('managers', 'managers.manager_id', '=', 'job_description.manager_id')
                     ->join('companys', 'companys.comp_id', '=', 'managers.comp_id')
                     ->get();
                 // add every post to the sitemap
                 foreach ($posts as $post) {
                     if($post->image != ''){
                         $image = "company/300px_".$post->code_image ."_".$post->image ;
     
                     }else{
                         $image ="simple/300px_company.png";
                     }
     
     
                     $tr=  $url.$_imgSrc.$image;
                     $images = array();
     
                         $images[] = array(
                             'url' => $tr,
                             'title' => $post->comp_name,
                             'caption' => $post->comp_name
                         );
     
     
                     $separator="-";
                     $string = $post->job_name ;
                     $string = trim($string);
                     $string = mb_strtolower($string, 'UTF-8');
                     $string = preg_replace("/[^a-z0-9_\s-ءاآؤئليةبپتثجچحخدذرزسشصضطظعغفقكکگلمنوهی]/u", '', $string);
                     $string = preg_replace("/[\s-_]+/", ' ', $string);
                     $string = preg_replace("/[\s_]/", $separator, $string);
     
                     $string=$urljob.$post->desc_id.'/'.$string;
                     $sitemap->add($string, $post->created_at, 0.6, 'daily', $images);
                 }
             }
             $sitemap->store('xml', 'mysitemap');
     
        
    }
public static function sendweb(){
    $user = \App\Guest::all();

            $jobs = DB::table('job_description')
            ->join('managers', 'managers.manager_id', '=', 'job_description.manager_id')
            ->join('companys', 'companys.comp_id', '=', 'managers.comp_id')            
            ->where('is_web', '=', 0)
            ->where('managers.manager_id','!=',185)
            ->where('job_description.desc_id','>',3981)
            ->select( 'image',
            'code_image', 'comp_name', 'job_name', 'job_description.desc_id')->get();
            DB::table('job_description')->update(['is_web' =>  1]);

            $i=0;
            foreach($jobs as $job){
                $i++;
                if($i== 2)
                break;
                
                if($job->image !=""){$companyImage = 'https://www.libyacv.com/images/company/300px_'.$job->code_image.'_'.$job->image; }else{  $companyImage ='https://www.libyacv.com/images/simple/company.png';}
               
                    $separator="-";
                    $string = trim($job->job_name);
                    $string = mb_strtolower($string, 'UTF-8');
                    $string = preg_replace("/[^a-z0-9_\s-ءاآؤئليةبپتثجچحخدذرزسشصضطظعغفقكکگلمنوهی]/u", '', $string);
                    $string = preg_replace("/[\s-_]+/", ' ', $string);
                    $string = preg_replace("/[\s_]/", $separator, $string);
        
        
                    $action = "https://www.libyacv.com/job/".$job->desc_id."/".$string;
               
               
                $title =$job->comp_name;
                $body =$job->job_name;
                $icon = $companyImage;
                Notification::send($user,new SendWebNoti($title, $body,$icon, $action));
            }
            
}

    public static function FireBaseStateJob()
    {
        /*  $tokens = DB::table('seekers')
            ->join('notifications', 'notifications.seeker_id', '=', 'seekers.seeker_id')
            ->where('note_type_id', 3)
            ->where('isread', 0)

            ->whereNotNull('fcm_token')
            ->select('fcm_token', 'data')->get();
        if (count($tokens) != 0) {
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60 * 20);
            $notificationBuilder = new PayloadNotificationBuilder('حالة طلب التوظيف');
            $dataBuilder = new PayloadDataBuilder();

            $dataBuilder->addData(['a_data' => 'my_data']);

            $option = $optionBuilder->build();
            $data = $dataBuilder->build();


            DB::table('notifications')
                ->where('isread', 0)
                ->where('note_type_id', 3)
                ->update([
                    'isread' => 1,
                ]);

            foreach ($tokens as $item) {
                $notificationBuilder->setBody($item->data)
                    ->setSound('default');
                $notification = $notificationBuilder->build();
                $downstreamResponse = FCM::sendTo($item->fcm_token, $option, $notification, $data);
                $downstreamResponse->numberSuccess();
            }
        }*/ }

    public static function FireBaseStateJobs()
    {
        $timestamp = Now('Africa/Tripoli');




        $companyName = DB::table('job_description')
            ->join('seeker_note_firebase', 'seeker_note_firebase.domain_id', '=', 'job_description.domain_id')
            ->join('seekers', 'seekers.seeker_id', '=', 'seeker_note_firebase.seeker_id')
            ->where('is_send', '=', 0)
            ->whereNotNull('fcm_token')
            ->where('desc_id','>',3430)
            ->select('seekers.seeker_id', 'fcm_token', 'job_name', 'job_description.desc_id', 'job_description.domain_id')->get();







        $first = " إشعار من مجال مفضل لديك ";


        DB::table('job_description')->update(['is_send' =>  1]);



        $optionBuilder = new OptionsBuilder();
        //  $optionBuilder->setTimeToLive(60*20);
        $notificationBuilder = new PayloadNotificationBuilder("وظيفة شاغرة");
        $dataBuilder = new PayloadDataBuilder();


        $title = "وظيفة شاغرة";
        foreach ($companyName as $item) {
            // 41.253.28.116

            $data_send = $item->job_name ;//. $first;
            $dataBuilder->addData([
                'title' => $title, 'body' => $data_send, 'send' => 'job',
                'id' => $item->desc_id
            ]);

            $isAndroid = 0;

            DB::table('notifications')->insert([
                'seeker_id' => $item->seeker_id,
                'data' => $data_send,
                'created_at' => $timestamp,
                'note_type_id' => 5,
                'isread' => $isAndroid
            ]);


            $option = $optionBuilder->build();
            $data = $dataBuilder->build();


            $notificationBuilder->setBody($data_send)
                ->setSound('default');
            $notification = $notificationBuilder->build();
            $downstreamResponse = FCM::sendTo($item->fcm_token, $option, $notification, $data);
            $downstreamResponse->numberSuccess();
        }
    }


    public static function FireBaseUpdatePrice($seeker_id)
    {



        $tokens = DB::table('seekers')
            ->join('notifications', 'notifications.seeker_id', '=', 'seekers.seeker_id')
            ->where('seeker_id', $seeker_id)
            ->where('note_type_id', 4)
            ->where('isread', 0)
            ->whereNotNull('fcm_token')
            ->select('fcm_token', 'data')->first();
        if ($tokens != null) {
            DB::table('notifications')
                ->where('isread', 0)
                ->where('seeker_id', $seeker_id)
                ->where('note_type_id', 4)
                ->update([
                    'isread' => 1,
                ]);
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60 * 20);

            $notificationBuilder = new PayloadNotificationBuilder('تحديث الرصيد');
            $notificationBuilder->setBody($tokens->data)
                ->setSound('default');

            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData(['a_data' => 'my_data']);
            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();

            $token = $tokens;
            $downstreamResponse = FCM::sendTo($token->fcm_token, $option, $notification, $data);

            $downstreamResponse->numberSuccess();
            $downstreamResponse->numberFailure();
            $downstreamResponse->numberModification();
        }
    }

    public static function strip_html_tags($text)
    {
        $text = preg_replace(
            array(
                // Remove invisible content
                '@<head[^>]*?>.*?</head>@siu',
                '@<style[^>]*?>.*?</style>@siu',
                '@<script[^>]*?.*?</script>@siu',
                '@<object[^>]*?.*?</object>@siu',
                '@<embed[^>]*?.*?</embed>@siu',
                '@<applet[^>]*?.*?</applet>@siu',
                '@<noframes[^>]*?.*?</noframes>@siu',
                '@<noscript[^>]*?.*?</noscript>@siu',
                '@<noembed[^>]*?.*?</noembed>@siu',
                // Add line breaks before and after blocks  
                // '@</?((br)|(hr))@iu',
                '@</?((address)|(blockquote)|(center)|(del))@iu',
                '@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
                '@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
                '@</?((table)|(th)|(td)|(caption))@iu',
                '@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
                '@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
                '@</?((frameset)|(frame)|(iframe))@iu',
            ),
            array(
                ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', " ", //"\n\$0",
                " \$0", "\$0", "\n\$0", " \$0", " \$0", //\n\$0
                " \$0", " \$0",
            ),
            $text
        );
        return strip_tags($text);
    }
    public static function returnDomain($domain)
    {

        $result = 18;
        switch ($domain) {

            case "Safety/Security":
            case "خدمات النظافة":

                $result = 17; // 17	خدم/عمالة/حراسة
                break;

            case  "المحاسبة ، خدمات التدقيق":
            case "الخدمات المصرفية والمالية":
            case "الخدمات المالية":
            case "المحاسبة ، خدمات التدقيق":

            case "Accounting,Auditing Services":
            case "Accounting,Auditing Services":
            case "Banking & Financial Services":
            case "Banking &amp; Financial Services":
            case "Financial Services":


                $result = 1;

                break;

            case "التدريب والتطوير":
            case "التعليم":
            case "Education":
            case "Training and Development":

                $result = 2;
                break;
            case "الصحافة والإعلام":
            case "وسائل الإعلام والإعلام الرقمي":
            case "وسائل التواصل الإجتماعي":
            case "Writing and Journalism":
                $result = 16; //16	إعلام /دعاية
                break;
            case "خدمات هندسية":
            case "ضبط الجودة":
            case "هندسة معمارية":
            case "النفط والغاز":
            case "الهندسة الميكانيكية":
            case "المعمارية،خدمات التصميم":
            case "الهندسة المدنية":
            case "الإلكترونيات والمكونات":
            case "الصيانة والخدمات الفنية":
            case "Architectural,Design Services":
            case "Aviation":
            case "Civil Engineering":
            case "Aviation":
            case "Electronics, Components": //*-
            case "Engineering Services": //*-
            case "Mechanical Engineering": //*-
            case "Oil & Gas": //*-
            case "Oil &amp; Gas": //*-
            case "Quality Control":
                $result = 4;
                break;

            case "تطوير التطبيقات":
            case "تكنولوجيا المعلومات":
            case "الإلكترونيات والمكونات":
            case "برمجة مواقع الكترونية":
            case "تكنولوجيا المعلومات والاتصالات":

            case "Application Development":
            case "Information & Communications Technology":
            case "Information Management":
            case "Information Technology":
            case "Web Development":
            case "Work from home":
            case "Information &amp; Communications Technology":


                $result = 5; //5	تقنية معلومات
                break;

            case "الموارد البشرية":
            case "منظمة":
            case "السكرتارية":
            case "الخدمات الإدارية وخدمات الدعم":
            case "الإدارة":
            case "العلاقات العامة":
            case "خدمات الإستشارات":
            case "تطوير الأعمال":
            case "الإعلان،خدمات العلاقات العامة":
            case "خدمات الدعم":
            case "خدمات رجال أعمال – أخرى":
            case " غير مصنفة":
            case "إدارة البرامج / المشاريع":

            case "المبيعات وخدمة العملاء":

            case "Administrative and Support Services":
            case "Administration":
            case "Consulting Services":
            case "Human Resources":
            case "Public Relations":
            case "Business Development":
            case "Manufacturing":
            case "organization":
            case "Other,Not Classified":
            case "Program/Project Management":
            case "Project Manager":



                $result = 6; //6	إدارة/سكرتارية
                break;


            case "الجمال والأزياء":
            case "الدعاية و التسويق والعلاقات العامة":
            case "العمل من المنزل":
            case "الغذاء، إنتاج المشروبات":
            case "مبيعات السيارات ، خدمات إصلاح":
            case "المشتريات والتوريد":
            case "وسائل الإعلام والإعلام الرقمي":
            case "وسائل التواصل الإجتماعي":


            case "Sales and Customer Service":
            case "Advertising,PR Services":
            case "Food, Beverage Production":
            case "Marketing, PR & Advertising":
            case "Media & Digital Media":
            case "Procurement & Supply":
            case "Procurement &amp; Supply":
            case "Marketing, PR &amp; Advertising":
            case "Media &amp; Digital Media":


                $result = 7; //7	مبيعات/تسويق
                break;
            case "النقل والخدمات اللوجستية":
            case "Logistics & Transportation":
            case "Logistics &amp; Transportation":
                $result = 8; //8	سائقين/توصيل
                break;
            case "  البناء والمقاولات":

                $result = 11; // 11	حرفيون/مهنيون			lham
                break;

            case "الخدمات القانونية":
            case "الخدمة الإجتماعية":
            case "Legal":
            case "Social Media":
            case "Social Sciences & Social Care":
            case "Human & Social Geography":
            case "Social Policy":
            case "Social Work":
            case "Sociology":
            case "Support Services":
            case "Social Sciences &amp; Social Care":

                $result = 19; //19	علوم اجتماعية / قانون
                break;

            case " خدمات الرعاية الصحية":
            case "الصحة، التمريض والرعاية الاجتماعية":
            case "التكنولوجيا الحيوية،الصيدلة":

            case "Biotechnology,Pharmaceuticals":
            case "Health, Nursing & Social Care":
            case "Health, Nursing &amp; Social Care":
            case "Healthcare Services":

                $result = 13; // 13	طب / تمريض			lham
                break;
            case " خدمات الترجمة":

            case "Translation":

                $result = 20; // 20	لغات/ترجمة			lham
                break;
        }

        return $result;
    }

    public static function getProductAr()
    {
        $client = new \GuzzleHttp\Client();

        /*   $GuzzleArr="cc";
         $GuzzleArr="cc";
         echo $res->getStatusCode(); # 200
         echo $res->getHeaderLine('content-type'); # 'application/json; charset=utf8'
         $GuzzleArr = $res->getBody();*/

        //  $rss_url = 'https://news.ycombinator.com/rss';
        // $trimCategory= "المبيعات وخدمة العملاء";
        //  $domain_id = $this->returnDomain($trimCategory);
        //dd($domain_id);

        $rss_url = 'https://libyanjobs.ly/jobs';

        $api_endpoint = 'https://api.rss2json.com/v1/api.json?rss_url=';
        //  $data = json_decode(file_get_contents($api_endpoint . urlencode($rss_url)), true);
        // $data = json_decode(file_get_contents($api_endpoint . urlencode($rss_url)), true);

        $res = $client->get($rss_url);
        $data= $res->getBody();
        dd($data);
        $data = json_decode(
            $res->getBody(),
            true
        );
        $dataArr = array();
        $i = 0;
        foreach ($data['items'] as $item) {

            $dataArr[$i]['title'] = $item['title'];
            $dataArr[$i]['link'] = $item['link'];
            $dataArr[$i]['author'] = $item['author'];
            $dataArr[$i]['content'] = $item['content'];
            //  echo $dataArr[$i]['content'];
            // dd($dataArr[$i]['content']);
            $raw_text = $dataArr[$i]['content'];

            $utf8_text = AndroidHelpers::strip_html_tags($raw_text);
            $dataArr[$i]['desc'] = $utf8_text;
            // echo nl2br(e( $utf8_text));
            //echo $utf8_text;

            $i++;
        }

        // dump($dataArr);

        //dd($data);
        // $client = new \GuzzleHttp\Client(['headers' => ['content-type' => 'application/json']]);

        foreach ($dataArr as $item) {
            $i = 0;
            $client = new \GuzzleHttp\Client(['headers' => ['Accept' => 'application/json']]);

            $url = $item['link'];
            //    dump($url);
            $res = $client->request('GET', $url, [
                'headers' => [
                    'content-type' => 'application/json',
                    'Accept' => 'application/json',

                ]
            ]);
            // $res = $client->get($url);

            $GuzzleArr = "cc";
            //echo $res->getStatusCode(); # 200
            // echo $res->getHeaderLine('content-type'); # 'application/json; charset=utf8'
            $GuzzleArr = $res->getBody();
            $dom = new  HTML5DOMDocument();
             $dom->loadHTML($GuzzleArr,HTML5DOMDocument::ALLOW_DUPLICATE_IDS);





            $city = $dom->querySelector('em')->innerHTML;
            $city =  AndroidHelpers::getCity(trim($city));
            //  dump($city);
            //  $desc = $dom->querySelector('.job-desc')->innerHTML;

            /* 

             $er = DB::table('desc')->first();
             echo $er->desc;

             dd($er->desc);*/
            //  echo $item['content'];
            preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $item['content'], $matches);
            //  print_r($matches[0]);
            $email = "";
            if (array_key_exists(0, $matches[0]))
                $email = $matches[0][0];
            //  echo $email;
            preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#',  $item['content'], $matchWeb);

            /* echo "<pre>";
            print_r($matchWeb[0]);
            echo "</pre>";*/


            $website = "";
            if (array_key_exists(0, $matchWeb[0]))
                $website = $matchWeb[0][count($matchWeb[0]) - 1];
            //    echo $website;



            // returns all results in array $matches
            preg_match_all('/[0-9]{10}/', $item['content'], $matchesp);

            $phone = "";
            if (array_key_exists(0, $matchesp[0]))
                $phone = $matchesp[0][0];
            //  echo $phone;

            //  dump($phone);


            //  echo $dom->querySelector('.job-category')->innerHTML;
            $ee = $dom->querySelector('.job-category')->querySelector('a');
            $htmlCategory = $ee->innerHTML;


            $eeCompany = $dom->querySelector('.job-company')->querySelector('a')->innerHTML;
            $company = strip_tags($eeCompany);
            //  dump($company);
            $dataArr[$i]['city'] = $city;
            $dataArr[$i]['category'] = $htmlCategory;

            $trimCategory = trim($htmlCategory);

            //    dump($trimCategory);
            $domain_id =  AndroidHelpers::returnDomain($trimCategory);

            //  echo " domain id :  ";
            // dump($domain_id);
            //   dump($item);

            // echo "emailBefore : " . $email;
            if ($phone == "" && $email == "" && $website == "") {
                $city2 = $dom->getElementById('contact_company_form')->innerHTML;
                preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $city2, $matches);
                //  print_r($matches[0]);

                if (array_key_exists(0, $matches[0]))
                    $email = $matches[0][0];
            }

            /*     dump($email);
            echo "Phone : " . $phone;
            echo "email : " . $email;
            echo "website : " . $website;*/



            $check = DB::table('desc')->where('title', '=', $item['title'])
                ->where('url', '=', $item['link'])->first();
            if ($check === null) {
                // user doesn't exist

                DB::table('desc')->insert([
                    "desc" => $item['desc'],
                    'city_id' =>  $city,
                    'domain_id' => $domain_id,
                    'title' => $item['title'],
                    'title_display' => $item['title'],
                    'company_name' => $company,
                    'url' => $item['link'],
                    'email' => $email,
                    'website' => $website,
                    'phone' => $phone,
                    'is_show' => 0
                ]);
            }
            $i++;
        }
        //  dd($dataArr);
        // $GuzzleArr=   json_decode((string) $res->getBody(), true);

        // echo $GuzzleArr;
        // dd($GuzzleArr) ;
        //$products = DB::table('product')->get();
        //  return view()->with("",$products);

    }

    public static function getProduct()
    {
        $client = new \GuzzleHttp\Client();
        /* $res = $client->get($url);
         $GuzzleArr="cc";
         echo $res->getStatusCode(); # 200
         echo $res->getHeaderLine('content-type'); # 'application/json; charset=utf8'
         $GuzzleArr = $res->getBody();*/

        //  $rss_url = 'https://news.ycombinator.com/rss';
        // $trimCategory= "المبيعات وخدمة العملاء";
        //  $domain_id = $this->returnDomain($trimCategory);
        //dd($domain_id);

        $rss_url = 'https://libyanjobs.ly/en/jobs/feed/';

        $api_endpoint = 'https://api.rss2json.com/v1/api.json?rss_url=';
        //  $data = json_decode(file_get_contents($api_endpoint . urlencode($rss_url)), true);
        $res = $client->get($api_endpoint . urlencode($rss_url));
        $data = json_decode(
            $res->getBody(),
            true
        );
        $dataArr = array();
        $i = 0;
        foreach ($data['items'] as $item) {

            $dataArr[$i]['title'] = $item['title'];
            $dataArr[$i]['link'] = $item['link'];
            $dataArr[$i]['author'] = $item['author'];
            $dataArr[$i]['content'] = $item['content'];
            //  echo $dataArr[$i]['content'];
            // dd($dataArr[$i]['content']);
            $raw_text = $dataArr[$i]['content'];

            $utf8_text = AndroidHelpers::strip_html_tags($raw_text);
            $dataArr[$i]['desc'] = $utf8_text;
            // echo nl2br(e( $utf8_text));
            //echo $utf8_text;

            $i++;
        }

        // dump($dataArr);

        //dd($data);
        // $client = new \GuzzleHttp\Client(['headers' => ['content-type' => 'application/json']]);

        foreach ($dataArr as $item) {
            $i = 0;
            $client = new \GuzzleHttp\Client(['headers' => ['Accept' => 'application/json']]);

            $url = $item['link'];
            // dump($url);
            $res = $client->request('GET', $url, [
                'headers' => [
                    'content-type' => 'application/json',
                    'Accept' => 'application/json',

                ]
            ]);
            // $res = $client->get($url);

            $GuzzleArr = "cc";
            //echo $res->getStatusCode(); # 200
            // echo $res->getHeaderLine('content-type'); # 'application/json; charset=utf8'
            $GuzzleArr = $res->getBody();
            $dom = new  HTML5DOMDocument();

            $dom->loadHTML($GuzzleArr,HTML5DOMDocument::ALLOW_DUPLICATE_IDS);

             //  dd($dom);
            $city = $dom->querySelector('em')->innerHTML;
            $city = AndroidHelpers::getCity(trim($city));
            //  dump($city);
            //  $desc = $dom->querySelector('.job-desc')->innerHTML;

            /* 

             $er = DB::table('desc')->first();
             echo $er->desc;

             dd($er->desc);*/
            //  echo $item['content'];
            preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $item['content'], $matches);
            //  print_r($matches[0]);
            $email = "";
            if (array_key_exists(0, $matches[0]))
                $email = $matches[0][0];
            //   echo $email;
            preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#',  $item['content'], $matchWeb);

            /*  echo "<pre>";
            print_r($matchWeb[0]);
            echo "</pre>";
*/

            $website = "";
            if (array_key_exists(0, $matchWeb[0]))
                $website = $matchWeb[0][count($matchWeb[0]) - 1];
            //  echo $website;



            // returns all results in array $matches
            preg_match_all('/[0-9]{10}/', $item['content'], $matchesp);

            $phone = "";
            if (array_key_exists(0, $matchesp[0]))
                $phone = $matchesp[0][0];
            //  echo $phone;

            //  dump($phone);


            //  echo $dom->querySelector('.job-category')->innerHTML;
            $ee = $dom->querySelector('.job-category')->querySelector('a');
            $htmlCategory = $ee->innerHTML;


            $eeCompany = $dom->querySelector('.job-company')->querySelector('a')->innerHTML;
            $company = strip_tags($eeCompany);
            //  dump($company);
            $dataArr[$i]['city'] = $city;
            $dataArr[$i]['category'] = $htmlCategory;

            $trimCategory = trim($htmlCategory);

            // dump($trimCategory);
            $domain_id = AndroidHelpers::returnDomain($trimCategory);

            //  echo " domain id :  ";
            //  dump($domain_id);
            //  dump($item);
            if ($phone == "" && $email == "" && $website == "") {
                $city2 = $dom->getElementById('contact_company_form')->innerHTML;
                preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $city2, $matches);
                //  print_r($matches[0]);

                if (array_key_exists(0, $matches[0]))
                    $email = $matches[0][0];
            }

            $check = DB::table('desc')->where('title', '=', $item['title'])
                ->where('url', '=', $item['link'])->first();
            if ($check === null) {
                // user doesn't exist

                DB::table('desc')->insert([
                    "desc" => $item['desc'],
                    'city_id' =>  $city,
                    'domain_id' => $domain_id,
                    'title' => $item['title'],
                    'title_display' => $item['title'],
                    'company_name' => $company,
                    'url' => $item['link'],
                    'email' => $email,
                    'website' => $website,
                    'phone' => $phone,
                    'is_show' => 0
                ]);
            }
            $i++;
        }
        //  dd($dataArr);
        // $GuzzleArr=   json_decode((string) $res->getBody(), true);

        // echo $GuzzleArr;
        // dd($GuzzleArr) ;
        //$products = DB::table('product')->get();
        //  return view()->with("",$products);

    }
    /*
1	طرابلس			tripoli
2	بنغازي			beng
3	مصراته			misrata
4	الخمس			homs
5	الزاوية			zawia
6	زليتن			zlitn
7	البيضاء			albida
8	سبها			sabha
9	ترهونة			tarhona
10	غريان			gr
				
*/


    public static function getCity($city)
    {
        $result = 1;
        switch ($city) {
            case "طرابلس":
            case "Tripoli":
            case "أخرى":
            case "Other":
                $result = 1;
                break;
            case "بنغازي":
            case "Benghazi":
                $result = 2;
                break;
            case "مصراته":
            case "Misurata":
                $result = 3;
                break;
            case "الزاوية":

                $result = 5;
                break;
            case "سبها":
            case "Sabha":
                $result = 5;
                break;
        }

        return $result;
    }
    public static  function postInsert()
    {

        $descs = DB::table('desc')
            ->where('is_show', '=', 0)->get();
        if ($descs !== null) {

            foreach ($descs as $item) {
                //  dump($item);
                $mangeId = 185; //5
                $comp = DB::table('companys')
                    ->select('manager_id')
                    ->join('managers', 'managers.comp_id', '=', 'companys.comp_id')
                    ->where('count_emp', 'like', '%' . $item->company_name . '%')->orWhere('comp_name', 'like', '%' . $item->company_name . '%')->first();
                if ($comp != null) {

                    $mangeId = $comp->manager_id;
                }

                $job_start = date("Y-m-d");

                $timestamp = Now('Africa/Tripoli');
                //  $job_end = date('Y-m-d', strtotime("+40 days"));

                $how_receive = 1; //trim(strip_tags($request->input('how_receive'))); // 0 is active..  1 is not active
                date_default_timezone_set('Africa/Tripoli');
                $job_end = date('Y-m-d', strtotime("+15 days"));

                //  $job_end = date('Y-m-d', strtotime("+30 days"));
                $minDesc = DB::table('job_description')->min('desc_down');
                $job_stop = rand(58, 689);
                $job_stop  = $job_stop + 12;
                if ($minDesc == 0)
                    $l = 99999999999999;
                else
                    $l = $minDesc - 1;


                $is_active = 1;
                $desc = Desc::create([
                    'job_name' => $item->title . ' - ' . $item->company_name,
                    'job_desc' => $item->desc,
                    /*            'job_skills' => $job_skills,*/
                    'city_id' => $item->city_id,
                    'domain_id' =>  $item->domain_id,
                    'email' =>  $item->email,
                    'phone' => $item->phone,
                    'website' => $item->website,
                    'job_stop' => $job_stop,

                    'is_active' => $is_active,
                    'how_receive' => $how_receive,
                    'created_at' => $timestamp,
                    'job_start' => $job_start,
                    'job_end' => $job_end,
                    'desc_down' => $l,
                    'manager_id' => $mangeId,
 
                ]);


                $desc->comp_name = $item->company_name;
                NoteAddJob::dispatch($desc)
                    ->delay(now()->addMinutes(1));

                DB::table('desc')->where('id', '=', $item->id)->update([
                    'is_show' => 1,
                ]);
            }
        }
    }
}
