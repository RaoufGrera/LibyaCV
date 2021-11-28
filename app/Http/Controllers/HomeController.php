<?php

namespace App\Http\Controllers;

use http\Exception;
use Illuminate\Http\Request;
use DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use IvoPetkov\HTML5DOMDocument;
use App\Helpers;
use Carbon\Carbon;
use App\Desc;
use App\Jobs\NoteAddJob;
use App\AndroidHelpers;
use  App\MainHelper;
class HomeController extends Controller
{

    public function all(){
        $this->getProductAr();
        $this->getProduct();
        $this->postInsert();

       // AndroidHelpers::postInsert();

        AndroidHelpers::FireBaseStateJobs();
        AndroidHelpers::sendweb();
        MainHelper::RefreshWebsiteV2();
     //   AndroidHelpers::site();


    }
    /*
  JOB CATEGORIES
 *




    */
    /*
     1	محاسبة/اقتصاد			money
     2	تدريس / تدريب			tech
     3	فندقة /مطاعم			pitza
     4	هندسة			eng
     5	تقنية معلومات			data
     6	إدارة/سكرتارية 			sek
     7	مبيعات/تسويق			salesmaket
     8	سائقين/توصيل			delever
     9	حلاقة/كوافيرة			skin
     11	حرفيون/مهنيون			lham
     13	طب / تمريض			docotor
     16	إعلام /دعاية			media
     17	خدم/عمالة/حراسة			cleanhouse
     18	اعمال اخري			otherwork
     19	علوم اجتماعية / قانون			law
     20	لغات/ترجمة			translate

      */

    function strip_html_tags($text)
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
    function returnDomain($domain)
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

    function returnDomainOpen($domain)
    {

        $result = 18;
        switch ($domain) {

             case "وظائف حراسة - أمن":
                $result = 17; // 17	خدم/عمالة/حراسة
                break;

            case  "وظائف مالية - محاسبة":
                $result = 1;

                break;

             case "وظائف تدريس ودورات تدريبية":
                $result = 2;
                break;

            case "وظائف إنتاج وإعلام":
                $result = 16; //16	إعلام /دعاية
                break;
            case "وظائف هندسة":

                $result = 4;
                break;

            case "وظائف تكنولوجيا المعلومات":
            case "وظائف تصميم":

                $result = 5; //5	تقنية معلومات
                break;

            case "وظائف موارد بشرية":
            case "وظائف سياحة و سفر":
            case "وظائف إدارة - سكرتارية":
            case "وظائف خدمة عملاء":
                $result = 6; //6	إدارة/سكرتارية
                break;


            case "وظائف تسويق":
            case "وظائف مبيعات":
                $result = 7; //7	مبيعات/تسويق
                break;

            case "وظائف سائقين وتوصيل":
                $result = 8; //8	سائقين/توصيل
                break;

            case "وظائف فنيّين  وحرفيّين":
            case "وظائف ميكانيكي سيارات":
            case "وظائف صناعة وزراعة":
                $result = 11; // 11	حرفيون/مهنيون			lham
                break;

            case "وظائف قانون - محاماة":
                $result = 19; //19	علوم اجتماعية / قانون
                break;

            case "وظائف طب - تمريض - صيدلة":
            case "وظائف العلوم الطبية والرعاية الصحية":
                $result = 13; // 13	طب / تمريض			lham
                break;

            case "وظائف كتابة محتوى وترجمة":
            $result = 20; // 20	لغات/ترجمة			lham
            break;

            case "وظائف فندقة - مطاعم":
                $result = 3; // 3	فندقة			lham
                break;

            case "وظائف صحّة - جمال":
                $result = 9; // 9	حلاقة وكوافير			lham
                break;
        }

        return $result;
    }
/*        $client = new \GuzzleHttp\Client(['headers' => ['Accept' => 'application/json']]);

        $url = "https://reqbin.com/api/v1/Requests";
        //    dump($url);
        $res = $client->request('POST', $url, [
            'headers' => [
                'content-type' => 'application/json',
                'Accept' => 'application/json',

            ],
            'body' => ('{"id":"0","name":"","json":"{\"method\":\"GET\",\"url\":\"https://ly.opensooq.com/ar/search/106177816/%D9%85%D9%86%D8%AF%D9%88%D8%A8-%D9%85%D8%B9-%D8%B4%D8%B1%D9%83%D8%A9-%D8%B3%D9%81%D8%B1%D8%A7%D8%AC%D9%8A-%D9%84%D9%84%D8%AE%D8%AF%D9%85%D8%A7%D8%AA\",\"contentType\":\"JSON\",\"content\":\"\",\"headers\":\"\",\"auth\":{\"auth\":\"noAuth\",\"bearerToken\":\"\",\"basicUsername\":\"\",\"basicPassword\":\"\",\"customHeader\":\"\"}}"}')


        ]);

*/
    public function getOpen(){

        if (!empty($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $client = new \GuzzleHttp\Client(['headers' => ['Accept' => 'application/json']]);

        $urlSearch = "https://ly.opensooq.com/ar/%D9%88%D8%B8%D8%A7%D8%A6%D9%81-%D8%B4%D8%A7%D8%BA%D8%B1%D8%A9/all?page=".$page;
        $resJobs = $client->request('GET', $urlSearch, [
            'headers' => [
                'content-type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ]);
        $HtmlJobs = $resJobs->getBody();
      //  dd($HtmlJobs);

        $realHref = "https://ly.opensooq.com";
        $domHTML5 = new  HTML5DOMDocument();
        $domHTML5->loadHTML($HtmlJobs,HTML5DOMDocument::ALLOW_DUPLICATE_IDS);
        for($i=0;$i<30;$i++){
        $queryJobs = $domHTML5->querySelectorAll('.fRight mb15')->offsetGet($i)->querySelector('a')->getAttribute('href');

$url = $realHref.$queryJobs;

            $res = $client->request('GET', $url, [
                'headers' => [
                    'content-type' => 'application/json',
                    'Accept' => 'application/json',

                ],

            ]);
            $guzzel = $res->getBody();

            $dom = new  HTML5DOMDocument();
            $dom->loadHTML($guzzel,HTML5DOMDocument::ALLOW_DUPLICATE_IDS);

           // dump($url);

            $title = $dom->querySelector('.titleWrap')->querySelector('h1')->innerHTML;
            $utf8_title = $this->strip_html_tags($title);


            $utf8_title = trim($utf8_title);
       //   dump($utf8_title);
            $selectorPart = ".firstPart";
            $checkSecond = $dom->querySelector('.secondPart');
            if($checkSecond != null)
                $selectorPart = ".secondPart";
            $span = $dom->querySelector($selectorPart)->querySelector('.showPhone');
            $realPhone ="";
            if($span != null){
                $queryPhone = $dom->querySelector('.showPhone')->innerHTML;
                $htmlPhone = substr($queryPhone, 0, 5);
                preg_match_all('/[0-9]{10}/', $guzzel, $matchesp);
                $phone = "";

                if (array_key_exists(0, $matchesp[0]))
                    $phone = $matchesp[0];
                foreach ($phone as $item){

                    $compare = substr($item, 0, 5);
                    if($compare == $htmlPhone){
                        $realPhone =$item;
                        break;
                    }

                }

            $span->parentNode->removeChild($span);
            $dom->saveHTML();
            }
            $queryDesc= $dom->querySelector($selectorPart)->innerHTML;
            $utf8_text = $this->strip_html_tags($queryDesc);


            str_replace("https://libyanjobs.ly","https://www.LibyaCV.com",$utf8_text);
            preg_replace("/\n\n+/s","\n",$utf8_title);



                $city = $dom->querySelector(".breadcrumbs")->querySelectorAll('.vTop')->offsetGet(0)->querySelector('a')->innerHTML;
                $checkDomain = $dom->querySelector(".breadcrumbs")->querySelectorAll('.vTop')->offsetExists(2);


                $domain="";
                if($checkDomain){
                 //   $checkDomain = $dom->querySelector(".customP")->querySelectorAll('.inline')->offsetGet(1)->querySelector('a')->querySelector('.brand');

                   // $checkDomain->parentNode->removeChild($checkDomain);
                    //$dom->saveHTML();
                    $domain = $dom->querySelector(".breadcrumbs")->querySelectorAll('.vTop')->offsetGet(2)->querySelector('a')->innerHTML;

                }
            $city = $this->getCity(trim($city));
            $domain = $this->returnDomainOpen(trim($domain));

            preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i",$queryDesc, $matches);
            //  print_r($matches[0]);
            $email = "";
            if (array_key_exists(0, $matches[0]))
                $email = $matches[0][0];
             echo $email;
            preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $queryDesc, $matchWeb);

            /* echo "<pre>";
            print_r($matchWeb[0]);
            echo "</pre>";*/


            $website = "";
            if (array_key_exists(0, $matchWeb[0]))
                $website = $matchWeb[0][count($matchWeb[0]) - 1];

       /*     echo $website;
            dump($city);
            dump($realPhone);
            dump($domain);
            dump($i);*/
          //  dump($domain);

            echo "job Number: " . $i;

            $check = DB::table('desc')->where('url', '=', $url)->first();
            if ($check === null) {
                // user doesn't exist
                $isShow = 0;
                if($website=="" && $realPhone =="" && $email ==""){
                    $isShow = 1;
                }
                DB::table('desc')->insert([
                    "desc" => $utf8_text,
                    'city_id' =>  $city,
                    'domain_id' => $domain,
                    'title' => $utf8_title,
                    'title_display' => $utf8_title,
                    'company_name' => "",
                    'url' => $url,
                    'email' => $email,
                    'website' => $website,
                    'phone' => $realPhone,
                    'is_show' => $isShow
                ]);
            }


        }
       // dd("END");
//عندي سيارة كيا تﻻجة نخدم

    }
    public function getProductAr()
    {
        AndroidHelpers::getProductAr();
       
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

        $rss_url = 'https://libyanjobs.ly/jobs/feed/';

        $api_endpoint = 'https://api.rss2json.com/v1/api.json?rss_url=';
        //  $data = json_decode(file_get_contents($api_endpoint . urlencode($rss_url)), true);
        // $data = json_decode(file_get_contents($api_endpoint . urlencode($rss_url)), true);

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

          //  $utf8_text = $this->strip_html_tags($raw_text);
            str_replace("https://libyanjobs.ly","https://www.LibyaCV.com",$raw_text);
            preg_replace("/\n\n+/s","\n",$raw_text);

            $dataArr[$i]['desc'] = $raw_text;
            // echo nl2br(e( $utf8_text));
            //echo $utf8_text;

            $i++;
        }

       //   dump($dataArr);

      //   dd($dataArr);
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


            $span = $dom->querySelector('em');

            if($span!= null){
                $city = $dom->querySelector('em')->innerHTML;
                $city = $this->getCity(trim($city));
            }else{
                $city=1;}
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

            $categoryTest = $dom->querySelector('.job-category');
            $htmlCategory="";
            if($categoryTest!= null) {
                $ee = $dom->querySelector('.job-category')->querySelector('a');
                $htmlCategory = $ee->innerHTML;
             //   dump($htmlCategory);
            }

            $eeCompany="";
           $companytest = $dom->querySelector('.job-company');
           if($companytest!= null) {
               $rrr = $dom->querySelector('.job-company')->querySelector('a');
               $eeCompany = $rrr->innerHTML;
           }
            $company = strip_tags($eeCompany);
            //  dump($company);
            $dataArr[$i]['city'] = $city;
            $dataArr[$i]['category'] = $htmlCategory;

            $trimCategory = trim($htmlCategory);

            //    dump($trimCategory);
            $domain_id = $this->returnDomain($trimCategory);

            //  echo " domain id :  ";
            // dump($domain_id);
            //   dump($item);

            // echo "emailBefore : " . $email;
            if ($phone == "" && $email == "" && $website == "") {
                $contCompany = $dom->getElementById('contact_company_form');

                if($contCompany!= null) {
                    $city2 = $dom->getElementById('contact_company_form')->innerHTML;
                    preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $city2, $matches);
                    //  print_r($matches[0]);

                    if (array_key_exists(0, $matches[0]))
                        $email = $matches[0][0];
                }
            }

            /*     dump($email);
            echo "Phone : " . $phone;
            echo "email : " . $email;
            echo "website : " . $website;*/



            $check = DB::table('desc')->where('title', '=', $item['title'])
                ->where('url', '=', $item['link'])->first();

            try {
                // Validate the value...

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
            } catch (\Exception $e) {
                DB::table('desc')->insert([
                    "desc" => "error",
                    'city_id' =>  $city,
                    'domain_id' => $domain_id,
                    'title' => $item['title'],
                    'title_display' => $item['title'],
                    'company_name' => $company,
                    'url' => $item['link'],
                    'email' => $email,
                    'website' => $website,
                    'phone' => $phone,
                    'is_show' => 1
                ]);
            }
            $i++;
        }
 
    }

    public function getCompany(){
        if (!empty($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $client = new \GuzzleHttp\Client(['headers' => ['Accept' => 'application/json']]);

        $urlSearch = "https://libyanjobs.ly/قائمة-الشركات/".$page;
        $resJobs = $client->request('GET', $urlSearch, [
            'headers' => [
                'content-type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ]);
        $HtmlJobs = $resJobs->getBody();


        $realHref = "https://libyanjobs.ly/companies/";
        $domHTML5 = new  HTML5DOMDocument();
        $domHTML5->loadHTML($HtmlJobs,HTML5DOMDocument::ALLOW_DUPLICATE_IDS);
        for($i=0;$i<12;$i++){
            $queryJobs = $domHTML5->querySelectorAll('.company-item-meta')->offsetGet($i)->querySelector('a')->getAttribute('href');

            $url = $queryJobs; //$realHref.

            $res = $client->request('GET', $url, [
                'headers' => [
                    'content-type' => 'application/json',
                    'Accept' => 'application/json',

                ],

            ]);
            $guzzel = $res->getBody();

            $dom = new  HTML5DOMDocument();
            $dom->loadHTML($guzzel,HTML5DOMDocument::ALLOW_DUPLICATE_IDS);

            //dump($url);
            $address=$category=$info="";

            $title = $dom->querySelector('.company-name')->innerHTML;
            $categoryCheck = $dom->querySelector('.value-_job_category');
            if($categoryCheck){
            $category = $dom->querySelector('.value-_job_category')->innerHTML;
            }

            $addressCheck = $dom->querySelector('.value-_full_address');
            if($addressCheck){
            $address = $dom->querySelector('.value-_full_address')->innerHTML;
            }
            $infoCheck = $dom->querySelector('.noo-company-content')->querySelector('p');
            if($infoCheck){
                $info = $dom->querySelector('.noo-company-content')->querySelector('p')->innerHTML;

            }
            $utf8_title = $this->strip_html_tags($title);
            $utf8_info = $this->strip_html_tags($info);


            $utf8_title = trim($utf8_title);
            $utf8_info = trim($utf8_info);


            dump($utf8_title);

            echo $utf8_info;
            dump($queryJobs);
        }
    }

    public function getProduct()
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

            $utf8_text = $this->strip_html_tags($raw_text);
            $dataArr[$i]['desc'] = $raw_text;
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
            $span = $dom->querySelector('em');

            if($span!= null){
            $city = $dom->querySelector('em')->innerHTML;
            $city = $this->getCity(trim($city));
            }else{
            $city=1;}
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
            $categoryTest = $dom->querySelector('.job-category');
            $htmlCategory="";
            if($categoryTest!= null) {
                $ee = $dom->querySelector('.job-category')->querySelector('a');
                $htmlCategory = $ee->innerHTML;
            }


            $eeCompany = $dom->querySelector('.job-company')->querySelector('a')->innerHTML;
            $company = strip_tags($eeCompany);
            //  dump($company);
            $dataArr[$i]['city'] = $city;
            $dataArr[$i]['category'] = $htmlCategory;

            $trimCategory = trim($htmlCategory);

            // dump($trimCategory);
            $domain_id = $this->returnDomain($trimCategory);

            //  echo " domain id :  ";
            //  dump($domain_id);
            //  dump($item);
            if ($phone == "" && $email == "" && $website == "") {
                $contCompany = $dom->getElementById('contact_company_form');

                if($contCompany!= null) {
                    $city2 = $dom->getElementById('contact_company_form')->innerHTML;
                    preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $city2, $matches);
                    //  print_r($matches[0]);

                    if (array_key_exists(0, $matches[0]))
                        $email = $matches[0][0];
                }
            }

            $check = DB::table('desc')->where('title', '=', $item['title'])
                ->where('url', '=', $item['link'])->first();
           try{
            if ($check === null) {
                // user doesn't exist

                DB::table('desc')->insert([
                    "desc" => $item['desc'],
                  //  "desc_lara" => $item['desc'],
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
        } catch (\Exception $e) {
        DB::table('desc')->insert([
            "desc" => "error",
            'city_id' =>  $city,
            'domain_id' => $domain_id,
            'title' => $item['title'],
            'title_display' => $item['title'],
            'company_name' => $company,
            'url' => $item['link'],
            'email' => $email,
            'website' => $website,
            'phone' => $phone,
            'is_show' => 1
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


    function getCityOpen($city)
    {
        $result = 1;
        switch ($city) {
            case "طرابلس":
            case "أخرى":

                $result = 1;
                break;
            case "بنغازي":
                $result = 2;
                break;
            case "مصراته":
            case "سرت":
                $result = 3;
                break;
            case "الزاوية":

                $result = 5;
                break;
            case "غريان":
            case "صبراتة":
                $result=10;
                    break;

            case "ترهونة":
            case "بني وليد":
             $result=9;
                    break;
            case "سبها":
                $result = 5;
                break;
        }

        return $result;
    }
    function getCity($city)
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

    public function postInsert()
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
                    ->Where('count_emp', 'like', '%' . $item->company_name . '%')
                    ->orWhere('comp_name', 'like', '%' . $item->company_name . '%')
                    ->orWhere('comp_user_name', 'like', '%' . $item->company_name . '%')
                    ->first();
                /* ->where('comp_user_name', 'like', '%' . $item->company_name . '%')->orWhere('comp_name', 'like', '%' . $item->company_name . '%')
                    ->or*/
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


                if($item->company_name != "")
                    $item->company_name =   ' - '.$item->company_name;

                $is_active = 1;
                $ww = $item->website;
                if ($item->website == "https://libyanjobs.ly") {
                    $ww = "";
                }

                 if($ww =="" && $item->email =="" && $item->phone== "")
                     continue;

                $desc = Desc::create([
                    'job_name' => $item->title  . $item->company_name,
                    'job_desc' => $item->desc,
                    /*            'job_skills' => $job_skills,*/
                    'city_id' => $item->city_id,
                    'domain_id' =>  $item->domain_id,
                    'email' =>  $item->email,
                    'phone' => $item->phone,
                    'website' => $ww,
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
    public function index()
    {
        return view('home');
    }
}
