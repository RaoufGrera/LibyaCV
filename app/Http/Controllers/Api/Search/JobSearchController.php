<?php

namespace App\Http\Controllers\Api\Search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Search;
use Illuminate\Support\Facades\Auth;
use App\Helpers;

use DB;

class JobSearchController extends Controller
{
    public function searchJob(){



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

        $jobs = $s->searchJob($data);

        $arrStars = array();


        $jobsArray = array();
        $jobsArrStars = array();
       // $jobsArrayStars = array();
       // $jobIds = array();



        foreach ($arrStars as $item) {
            $jobsArrStars[] = $item;
        }
      //  $countStars = count($jobsArrStars);

      //  $loopStars =0;

        $actual_link ="https://www.libyacv.com";


        if($jobs != null) {
            foreach ($jobs as $job) {


                $dateArabic = Helpers::arabic_date_format(strtotime($job->created_at));


                $job_desc  = str_limit($job->job_desc, $limit = 80, $ends = '...');

                if($job->image == "") {
                    $stringImage= $actual_link."/images/simple/company.png";

                }else{
                    $stringImage= $actual_link."/images/company/300px_". $job->code_image ."_". $job->image;
                }

                $utf8_text = $this->strip_html_tags($job_desc);

                $jobsArray[$job->desc_id] =
                    array(
                        'job_name' => $job->job_name,
                        'desc_id' => $job->desc_id,
                        'comp_name' =>$job->comp_name,
                        'job_desc' =>"",//$utf8_text,
                        'isstar' => ($job->starenddate >= Now()) ? 1 :0,

                        'image' => $stringImage,

                        'comp_user_name' => $job->comp_user_name,
                        'domain_name' => $job->domain_name,
                        'city_name' => $job->city_name,
                        // 'req_count' => $jobArr[$t]->req_count,
                        'see_it' => $job->see_it,
                        'url' =>$job->url,
                        'type'=>"movie",
                        'job_end' =>$job->job_end,
                        'job_start' => $dateArabic );
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

        $seeker_id =Auth::user()->seeker_id;



        $job = DB::table('job_description')
            ->select('job_description.desc_id', 'job_name', 'managers.manager_id', 'level', 'companys.comp_id'
                , 'comp_user_name', 'comp_name', 'job_start', 'job_end'
                , DB::raw('COUNT(DISTINCT job_seeker_req.seeker_id) AS req_count')
                 , 'job_desc', 'job_description.email','job_description.phone','job_description.website','how_receive'
                , 'job_description.see_it', 'image', 'code_image', 'job_city.city_name', 'job_domain.domain_name', 'compt_name')
            ->join('managers', 'managers.manager_id', '=', 'job_description.manager_id')
            ->join('companys', 'companys.comp_id', '=', 'managers.comp_id')
            ->leftJoin('job_seeker_req', 'job_seeker_req.desc_id', '=', 'job_description.desc_id')//error
            ->join('job_domain', 'job_domain.domain_id', '=', 'job_description.domain_id')
            ->join('job_city', 'job_city.city_id', '=', 'job_description.city_id')
               ->where('job_description.desc_id', '=', $desc_id)
            ->groupby('job_description.desc_id')
            ->first();
        if($job == null)
             return response()->json(  null ,200,[],JSON_NUMERIC_CHECK);
        $isreq = DB::table('job_seeker_req')
            ->where('desc_id', $desc_id)
            ->where('seeker_id', $seeker_id)
            ->first();

        $check = true;
        if ($isreq === null)
            $check =false;
        $randNum = rand(1, 20);

            DB::table('job_description')
                ->where('desc_id', $desc_id)
                ->update(['see_it' => DB::raw('see_it+1')]);


        $actual_link ="https://www.libyacv.com";
        if($job->image == "") {
            $stringImage= $actual_link."/images/simple/company.png";

        }else{
            $stringImage= $actual_link."/images/company/300px_". $job->code_image ."_". $job->image;
        }

        $utf8_text = $this->strip_html_tags($job->job_desc);

        $jobsArray = array(
            "desc_id" =>$job->desc_id,
            "job_name" =>$job->job_name,
            "isreq" =>$check,
            "see_it" =>$job->see_it,
            "image" =>$stringImage,
            "code_image" =>$job->code_image,
            "city_name" =>$job->city_name,
            "domain_name" =>$job->domain_name,
            "compt_name" =>$job->compt_name,
            //"job_skills" =>$job->job_skills,
            "job_desc" =>$utf8_text,
            "comp_user_name" =>$job->comp_user_name,
            "comp_name" =>$job->comp_name,
            "job_start" =>$job->job_start,
            "job_end" =>$job->job_end,

            "req_count" =>$job->req_count,
            "how_receive" =>$job->how_receive,
            "email" =>$job->email,
            "phone" =>$job->phone,
            "website" =>$job->website,


        );

        return response()->json(
            $jobsArray
            ,200,[],JSON_NUMERIC_CHECK);

    }
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
