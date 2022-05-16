<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Helpers;
use App\Desc;
use App\Jobs\NoteAddJob;
use App\AndroidHelpers;
use App\Http\Controllers\Element;
class FileController extends Controller
{
    //
    public function index()
    {
        $xmlString = file_get_contents(public_path('sample.xml'));
        
        $xmlObject = simplexml_load_string($xmlString);
        $content = simplexml_load_string(
            $xmlString
            , null
            , LIBXML_NOCDATA
        );
  
        dump($content->channel);
            $json = json_encode($xmlObject);
            $phpArray = json_decode($json, true); 
   
            $feeds = file_get_contents(public_path('sample.xml'));
        $feeds = str_replace("<content:encoded>","<contentEncoded>",$feeds);
        $feeds = str_replace("</content:encoded>","</contentEncoded>",$feeds);
        $rss = simplexml_load_string($feeds);
       // $json = json_encode($rss);
      //  $phpArray = json_decode($json, true); 
      //  dd($rss);
        
    echo "<ul>";
    $arrJobs=[];
    $i = 0;
        foreach($rss->channel->item as $entry) {
            $states= (string)$entry->contentEncoded; 
             $title = (string)$entry->title;
            $companyName = (string)$entry->company;
            $job_address = (string)$entry->job_address;
            $job_category = (string)$entry->job_category;

            $job_category = trim($job_category);
            $arrJobs['link']=(string)$entry->link;

           
            $domain_id = $this->returnDomain($job_category);
            $city_id = $this->getCity($job_address);


           

            $states =str_replace($entry->link,"#",$states);

         //  echo $entry->link;
            $states =str_replace("https://libyanjobs.ly","https://www.LibyaCV.com",$states);
            $states =str_replace("Libyanjobs","LibyaCV",$states);

     
                // $contCompany = $dom->getElementById('contact_company_form');
                $email ="";

                 
                     $city2 = $states;
                     preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $city2, $matches);
                     //  print_r($matches[0]);
 
                     if (array_key_exists(0, $matches[0]))
                         $email = $matches[0][0];

                         echo $states;
                  
            


         //   $states= $this->strip_html_tags($states);
           
            $states= preg_replace("/\n\n+/s","\n",$states);

            $arrJobs['title']=$title;
            $arrJobs['company']= $companyName;
            $arrJobs['domain_id']=$domain_id;
            $arrJobs['city_id']=$city_id;
            $arrJobs['email']=$email;
            $arrJobs['desc']=$states;

         
           
        

           $check = DB::table('desc')->where('title', '=', $arrJobs['title'])
                ->where('url', '=', $arrJobs['link'])->first();
           try{
            if ($check === null) {
                // user doesn't exist

                DB::table('desc')->insert([
                    "desc" => $arrJobs['desc'],
                  //  "desc_lara" => $item['desc'],
                    'city_id' =>  $city_id,
                    'domain_id' => $domain_id,
                    'title' => $arrJobs['title'],
                    'title_display' => $arrJobs['title'],
                    'company_name' => $companyName,
                    'url' => $arrJobs['link'],
                    'email' => $arrJobs['email'],
                    'website' => "",
                    'phone' =>"",
                    'is_show' => 0
                ]);
            }
        } catch (\Exception $e) {
        DB::table('desc')->insert([
            "desc" => "error",
            'city_id' =>  $city_id,
            'domain_id' => $domain_id,
            'title' => $arrJobs['title'],
            'title_display' => $arrJobs['title'],
            'company_name' => $company,
            'url' => $arrJobs['link'],
            'email' => $arrJobs['email'],
            'website' => "",
            'phone' => "",
            'is_show' => 1
        ]);
   
    }
   
}
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

                // if($ww =="" && $item->email =="" && $item->phone== "")
                  //   continue;

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

function  strip_html_tags($text)
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
}
