<?php

namespace App\Http\Controllers\Api\Search;

use Illuminate\Http\Request;
use App\Search;
use App\Helpers;
use Auth;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function showCompany()
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
            $domainName = str_replace("-", " ", $_GET['domain']);
        } else {
            $domainName = NULL;
        }



        if (!empty($_GET['page'])) {
            $page = (int)$_GET['page'];
        } else {
            $page = 1;
        }

        $data = array(
            'select' => 'all',
            'string' => $string,
            'cityName' => $cityName,
            'domainName' => $domainName,
             'typeName' => "",

            'page' => $page,
            'start' => NULL,
            'end' => NULL,
        );
        $records_at_page = 8;
        $start= ($page -1) * $records_at_page;
        $end = $records_at_page;

        $data['start'] = $start;
        $data['end'] = $end;
        $arr = $s->searchCompany($data);
       // $arrStars = $s->searchCompanyStar($data);
        $recodes_count = count($arr);



        $actual_link ="https://www.libyacv.com";

        $start = ($page - 1) * $records_at_page;
        $end = $records_at_page;

        if ($end >= $recodes_count)
            $end = $recodes_count;

        $jobsArray = array();

        if ($arr != null) {
            foreach ($arr as $item) {
                if($item->image == "") {
                    $stringImage= $actual_link."/images/simple/company.png";

                }else{
                    $stringImage= $actual_link."/images/company/300px_". $item->code_image ."_". $item->image;
                }

                $ser = str_limit($item->services, $limit = 160, $ends = '...');

                $jobsArray[$item->comp_id] =
                    array(
                        'comp_name' => $item->comp_name,
                        'comp_id' => $item->comp_id,
                        'comp_user_name' => $item->comp_user_name,
                       // 'isstar' => ($item->endstar >= Now()) ? 1 : 0,
                        'type'=>"movie",
                        'image' => $stringImage,
                        'about' => $item->about,
                        'compt_name' => $item->compt_name,
                         'domain_name' => $item->domain_name,
                        'city_name' => $item->city_name,
                        'services' => $ser,
                        'see_it' => $item->see_it,
                     );

            }
            $lastjob = array();

            $i =0;
            foreach($jobsArray as $dd){
                if( $i ==7)
                    $lastjob[]=array('type'=>"ads");

                $lastjob[]=$dd;
                $i++;
            }
            $lastjob[count($lastjob)] =    array('type'=>"ads");
            $jobsArray=$lastjob;
        }



        return response()->json(
            $jobsArray
            ,200,[],JSON_NUMERIC_CHECK);



    }

    public function index($company_name)
    {

         $seeker_id =Auth::user()->seeker_id;

        // $company = Helpers::getDataSeeker('seekerCompany',$company_name,false);


        $company = DB::table('companys')
         //   ->join('managers', 'managers.comp_id', '=', 'companys.comp_id')
            //  ->join('seekers','seekers.seeker_id','=','managers.seeker_id')
          //  ->where('managers.seeker_id', $seeker_id)

             ->where('comp_user_name','=',$company_name)
            ->first();


        $followers = Helpers::followers('followers_company',$company->comp_id,$seeker_id);

        $status = false;
        if($followers != "empty")
            $status = true;
        $followers_count = Helpers::followers('followers_company',$company->comp_id,null);


        if(empty($followers_count))
            $followers_count=null;
        $randNum = rand(1,30);
        if($randNum  > 25) {
            DB::table('companys')
                ->where('comp_user_name', '=', $company_name)
                ->update(['see_it' => DB::raw('see_it+6')]);
        }

        $actual_link ="https://www.libyacv.com";
        if($company->image == "") {
            $stringImage= $actual_link."/images/simple/company.png";

        }else{
            $stringImage= $actual_link."/images/company/300px_". $company->code_image ."_". $company->image;
        }

        $company->image =$stringImage;
        $company->isreq =$status;
        return response()->json($company, 200);



    }

    public function addFollow($company_name)
    {
        $seeker_id =Auth::user()->seeker_id;

        $company = Helpers::getDataSeeker('seekerCompany',$company_name,false);

        $followers = Helpers::followers('followers_company',$company->comp_id,$seeker_id);

        if($followers == "empty") {
            DB::table('followers_company')->insert([
                'seeker_id' => $seeker_id,
                'comp_id' => $company->comp_id,
                'created_at' => \Carbon\Carbon::now(),
            ]);
             Helpers::setFollowers('followers_company', $company->comp_id, $seeker_id);


        }

        return response()->json([
            'message' => "تم تنفيذ العملية بنجاح.",

        ]);


    }
    public function removeFollow($company_name)
    {
        $seeker_id =Auth::user()->seeker_id;

        $company = Helpers::getDataSeeker('seekerCompany',$company_name,false);

        $followers = Helpers::followers('followers_company',$company->comp_id,$seeker_id);

        if($followers != "empty") {

            DB::table('followers_company')
                ->where('comp_id',  $company->comp_id)
                ->where('seeker_id', $seeker_id)
                ->delete();
            Helpers::removeFollowers('followers_company', $company->comp_id, $seeker_id);

        }



        return response()->json([
            'message' => "تم تنفيذ العملية بنجاح.",

        ]);


    }



}