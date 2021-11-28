<?php

namespace App\Http\Controllers\Search;

use App\Search;
use App\Helpers;
use Auth;
use DB;
use App\Http\Controllers\Controller;

class CvController extends Controller
{
    //

    //Show Cv
    public function showCv(){

        $s = new Search();

        $domainID=$edtID=$cityID=$cityRandom=$cityName=null;
        $domainRandom =$domainName=$edtName=$edtRandom=null;

        $string=null;
        if(!empty($_GET['string'])){ $string = str_replace("-"," ",$_GET['string']); }else{ $string =NULL; }



        if(!empty($_GET['city'])){ $cityName = str_replace("-"," ",$_GET['city']); }else{ $cityName =NULL; }
        if(!empty($_GET['domain'])){ $domainName = str_replace("-"," ",$_GET['domain']); }else{ $domainName =NULL; }
        if(!empty($_GET['education'])){ $edtName = str_replace("-"," ",$_GET['education']); }else{ $edtName =NULL; }
        $arrCity =  $arrDomain =$arrEdu=null;


        /* $arrDomain= Helpers::getDataSeeker('job_domain',null,false);
         $arrCity =Helpers::getDataSeeker('job_city',null,false);
         $edtArray =Helpers::getDataSeeker('job_edt',null,false);*/

       /* $cityArray = Helpers::getDataSeeker('job_city',null,false);
        foreach ($cityArray as $item){
            $arrCity[$item->city_id]=$item->city_name;
            if($cityName == $item->city_name) $cityID=$item->city_id;
        }
        $DoaminArray = Helpers::getDataSeeker('job_domain',null,false);
        foreach ($DoaminArray as $item){
            $arrDomain[$item->domain_id]=$item->domain_name;
            if($domainName == $item->domain_name) $domainID=$item->domain_id;

        }
        $edtArray = Helpers::getDataSeeker('job_edt',null,false);
        foreach ($edtArray as $item){
            $arrEdu[$item->edt_id]=$item->edt_name;
            if($edtName == $item->edt_name) $edtID=$item->edt_id;

        }
*/

/*        if(!empty($_GET['city'])){
            $searchArray2D = $_SESSION['search']['city'];

            foreach($searchArray2D as $srSearch){
                if($_GET['city'] ==  $srSearch['random']) {
                    $cityName = $srSearch['name'];
                    $cityID = $srSearch['count'];
                }
                $cityRandom = $_GET['city'];
            }

            $city = NULL;
        }else{
            $cityName = NULL;
        }




        if(!empty($_GET['domain'])){
            $searchArray2D = $_SESSION['search']['domain'];

            foreach($searchArray2D as $srSearch) {
                if ($_GET['domain'] == $srSearch['random']){
                    $domainName = $srSearch['name'];

                    $domainID= $srSearch['count'];
                }
                $domainRandom = $_GET['domain'];
            }

            $domain =NULL;}else{ $domainName=NULL; }

        if(!empty($_GET['education'])){
            $searchArray2D = $_SESSION['search']['education'];

            foreach($searchArray2D as $srSearch) {
                if ($_GET['education'] == $srSearch['random']){
                    $edtName = $srSearch['name'];
                    $edtID= $srSearch['count'];
                  }
                $edtRandom = $_GET['education'];
            }
            $education = NULL;
        }else{ $edtName =NULL; }

*/


        if(!empty($_GET['page'])){ $page = (int) $_GET['page']; }else{ $page =1; }

        $spec = $exp =  $id = NULL;
        $data = array(
            'select' => 'all',
            'string'    =>  $string,
            'cityName' => $cityName,
       /*     'cityRandom' => $cityRandom,*/
            'cityID' => $cityID,
            'domainName' => $domainName,
           'domainID' => $domainID,
            /*  'domainRandom' => $domainRandom,*/
            'edtName' => $edtName,
           /* 'edtRandom' => $edtRandom,*/
            'edtID' => $edtID,
            'id' => $id,
             'page' =>  $page,
            'start' =>  NULL,
            'end' =>  NULL,
        );

        $records_at_page = 20;
        $arr = array();
        $data['select'] = "city";
        $cityDB = $s->searchCv($data);
        $data['select'] = "domain";
        $domainDB = $s->searchCv($data);
        $data['select'] = "education";
        $edtDB = $s->searchCv($data);


        $data['select'] = "all";
        $data['start'] = 0;
        $data['end'] = 20;
        $queryCount =$arr= $s->searchCv($data);

        $recodes_count = count($queryCount);

         $seekerArr = array();

         $arrNat = array();


        foreach ($arr as $val) {
            $seekerArr[] = $val;
        }





      /*  $arrSearch2D = array('city'=>array(),'domain'=>array(),'education'=>array());
        foreach($arrCity as $key => $value){
            $arrSearch2D['city'][]=array(
                'name'=> $key,
                'count'=> $value,
                'random' => $value,
            );
        }
        if(empty($_GET['city']))
            $_SESSION['search']['city'] = $arrSearch2D['city'];

        foreach($arrEdu as $key => $value){
            $arrSearch2D['education'][]=array(
                'name'=> $key,
                'count'=> $value,
                'random' => $value,
            );
        }
        if(empty($_GET['education']))
            $_SESSION['search']['education'] = $arrSearch2D['education'];if(empty($_GET['education']))
            $_SESSION['search']['education'] = $arrSearch2D['education'];


        foreach($arrDomain as $key => $value){
            $arrSearch2D['domain'][]=array(
                'name'=> $key,
                'count'=> $value,
                'random' => $value,
            );
        }
        if(empty($_GET['domain']))
            $_SESSION['search']['domain'] = $arrSearch2D['domain'];
*/



        $page_count = (int) ceil($recodes_count / $records_at_page );

        if($recodes_count <> 0){
            if(($page > $page_count) || ($page <= 0)){
                die('خطاء');
            }}

        $start= ($page -1) * $records_at_page;
        $end = $records_at_page;
        if($end >= $recodes_count)
            $end=$recodes_count;


        $data['start'] = NULL;
        $data['end'] = NULL;
        //$seekers = $queryCount;
        $seekersArray = array();
        $SeekersIds = array();
        /* Script comes here */
        if($seekerArr != null) {
            for ($t = $start; $t < $end+$start; $t++) {

                $edt_name=$seekerArr[$t]->edt_name;
               // $edt_name = $arrEdu[$edt_tt];
                $dateArabic = Helpers::arabic_date_format(strtotime($seekerArr[$t]->updated_at));

                $stringImage="";
              if($seekerArr[$t]->image_view ==1 )
                  $stringImage =$seekerArr[$t]->image;


                $about="";
                if ($seekerArr[$t]->about != null)
                    $about = $seekerArr[$t]->about;
                elseif ($seekerArr[$t]->goal_text != null)
                    $about =$seekerArr[$t]->goal_text;


                $seekersArray[$seekerArr[$t]->seeker_id] =
                    array(
                        'fname' => $seekerArr[$t]->fname,
                        'lname' => $seekerArr[$t]->lname,
                        'about' => $about,
                        'user_name' => $seekerArr[$t]->user_name,
                        'gender' => $seekerArr[$t]->gender,
                        'image' => $stringImage,
                        'last_seen' => $seekerArr[$t]->last_seen,
                        'edt_name' => $edt_name,
                        'code_image' => $seekerArr[$t]->code_image,
                        'age' => $seekerArr[$t]->age,
                        'sum_exp' => 55,
                        'see_it' => $seekerArr[$t]->see_it,
                        'seeker_count' => $seekerArr[$t]->match."%",
                        'domain_name' => $seekerArr[$t]->domain_name,
                        'city_name' => $seekerArr[$t]->city_name,
                         'address' => $seekerArr[$t]->address,
                        'match' => $seekerArr[$t]->see_it,
                        'hide_cv' => $seekerArr[$t]->hide_cv,
                        'updated_at' => $dateArabic,
                        'goal_text' => $seekerArr[$t]->goal_text,
                        'services_count'=>0,
                        'spec' => array());


                $SeekersIds[]=$seekerArr[$t]->seeker_id;

            }
            $seekerServices = DB::select("SELECT `seeker_id`,COUNT(`services_id`) AS services_count
             FROM `services`
             WHERE `seeker_id` IN (" . implode(',', $SeekersIds) . ") group by `seeker_id`");

            $SeekerSpecs = DB::select("SELECT `spec_seeker`.`seeker_id`,`spec_seeker`.`spec_seeker_id`,`spec_name`,COUNT(`firend_spec`.`firend_spec_id`) AS spec_count
                    FROM `spec_seeker` 
                    JOIN `spec` ON `spec`.`spec_id` = `spec_seeker`.`spec_id`
                    LEFT JOIN `firend_spec` ON `spec_seeker`.`spec_seeker_id` = `firend_spec`.`firend_spec_id`
                    WHERE `spec_seeker`.`seeker_id` IN (".implode(',',$SeekersIds).") group by `spec`.`spec_name`, `spec_seeker`.`seeker_id`,`spec_seeker`.`spec_seeker_id`");


            foreach ($SeekerSpecs as $item){

                foreach ($SeekersIds as $Ids){
                    if($item->seeker_id == $Ids){
                        $spec_name = str_limit($item->spec_name, $limit = 30, $ends = '...');

                        $seekersArray[$Ids]['spec'][$spec_name] = $item->spec_count."-".$item->spec_seeker_id;
                        break;
                    }
                }
            }
            foreach ($seekerServices as $item) {
                foreach ($SeekersIds as $Ids) {
                    if ($item->seeker_id == $Ids) {
                        $seekersArray[$Ids]['services_count'] = $item->services_count;
                    }
                }
            }
        }

        $urls = $s->searchURL($data);



       // $genderFemale=$genderMale=$gender=$spec=$specEd= $faculty=$nat=$education= $company=null;

        // echo ($finalMem - $initialMem)/1024 . " Kbytes";
/*

        $cFile=  dirname(__FILE__);;
    $filename = "RtestR.php";
    $ourFileName =$cFile."/".$filename;
    $ourFileHandle = fopen($ourFileName, 'w');



    $written =  "<?php echo 'mosa'; ?>";


    fwrite($ourFileHandle,$written);

    fclose($ourFileHandle);

     include ($ourFileName);*/


        return view('search.cvs')

            ->with('seekersArray',$seekersArray)
              ->with('city',$cityDB)
              ->with('domain',$domainDB)
            ->with('education',$edtDB)
            ->with('urls',$urls)
            ->with('data',$data)
            ->with('page_count',$page_count);
    }



    public function showCvAjax(){
         $cityRandom=$cityName=$page=null;

        if(!empty($_GET['page'])){ $page = (int) $_GET['page']; }else{ $page =1; }


        $s = new Search();

        $domainID=$edtID=$cityID=$cityRandom=$cityName=null;
        $domainRandom =$domainName=$edtName=$edtRandom=null;

        $string=null;
        if(!empty($_GET['string'])){ $string = str_replace("-"," ",$_GET['string']); }else{ $string =NULL; }



        if(!empty($_GET['city'])){ $cityName = str_replace("-"," ",$_GET['city']); }else{ $cityName =NULL; }
        if(!empty($_GET['domain'])){ $domainName = str_replace("-"," ",$_GET['domain']); }else{ $domainName =NULL; }
        if(!empty($_GET['education'])){ $edtName = str_replace("-"," ",$_GET['education']); }else{ $edtName =NULL; }
        $arrCity =  $arrDomain =$arrEdu=null;

        $arrDomain = array();
        $arrCity = array();
        $arrEdu = array();
        /* $arrDomain= Helpers::getDataSeeker('job_domain',null,false);
         $arrCity =Helpers::getDataSeeker('job_city',null,false);
         $edtArray =Helpers::getDataSeeker('job_edt',null,false);*/

        $cityArray = Helpers::getDataSeeker('job_city',null,false);
        foreach ($cityArray as $item){
            $arrCity[$item->city_id]=$item->city_name;
            if($cityName == $item->city_name) $cityID=$item->city_id;
        }
        $DoaminArray = Helpers::getDataSeeker('job_domain',null,false);
        foreach ($DoaminArray as $item){
            $arrDomain[$item->domain_id]=$item->domain_name;
            if($domainName == $item->domain_name) $domainID=$item->domain_id;

        }
        $edtArray = Helpers::getDataSeeker('job_edt',null,false);
        foreach ($edtArray as $item){
            $arrEdu[$item->edt_id]=$item->edt_name;
            if($edtName == $item->edt_name) $edtID=$item->edt_id;

        }


        /*        if(!empty($_GET['city'])){
                    $searchArray2D = $_SESSION['search']['city'];

                    foreach($searchArray2D as $srSearch){
                        if($_GET['city'] ==  $srSearch['random']) {
                            $cityName = $srSearch['name'];
                            $cityID = $srSearch['count'];
                        }
                        $cityRandom = $_GET['city'];
                    }

                    $city = NULL;
                }else{
                    $cityName = NULL;
                }




                if(!empty($_GET['domain'])){
                    $searchArray2D = $_SESSION['search']['domain'];

                    foreach($searchArray2D as $srSearch) {
                        if ($_GET['domain'] == $srSearch['random']){
                            $domainName = $srSearch['name'];

                            $domainID= $srSearch['count'];
                        }
                        $domainRandom = $_GET['domain'];
                    }

                    $domain =NULL;}else{ $domainName=NULL; }

                if(!empty($_GET['education'])){
                    $searchArray2D = $_SESSION['search']['education'];

                    foreach($searchArray2D as $srSearch) {
                        if ($_GET['education'] == $srSearch['random']){
                            $edtName = $srSearch['name'];
                            $edtID= $srSearch['count'];
                          }
                        $edtRandom = $_GET['education'];
                    }
                    $education = NULL;
                }else{ $edtName =NULL; }

        */


        if(!empty($_GET['page'])){ $page = (int) $_GET['page']; }else{ $page =1; }

        $spec = $exp =  $id = NULL;
        $data = array(
            'select' => 'all',
            'string'    =>  $string,
            'cityName' => $cityName,
            /*     'cityRandom' => $cityRandom,*/
            'cityID' => $cityID,
            'domainName' => $domainName,
            'domainID' => $domainID,
            /*  'domainRandom' => $domainRandom,*/
            'edtName' => $edtName,
            /* 'edtRandom' => $edtRandom,*/
            'edtID' => $edtID,
            'id' => $id,
            'page' =>  $page,
            'start' =>  NULL,
            'end' =>  NULL,
        );





        $records_at_page =20;
        $start= ($page -1) * $records_at_page;
        $end = $records_at_page;


        $data['start'] = $start;
        $data['end'] = $end;

         $seekers = $s->searchCv($data);

        $data['start'] = NULL;
        $data['end'] = NULL;
        //$seekers = $queryCount;
        $seekersArray = array();
        $SeekersIds = array();
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

        if(count($seekers) != null) {
            foreach ($seekers as $seeker) {

                $beforEdt = $arrEdu[$seeker->edt_id];
                $city = $arrCity[$seeker->city_id];
                $doamin = $arrDomain[$seeker->domain_id];
                $edt_name = str_replace("/", "/", $beforEdt);

                if ($seeker->image == "" || $seeker->image_view != 1) {
                    if ($seeker->gender == "m")
                        $stringImage = $actual_link . "/images/simple/140px_male.png";
                    else
                        $stringImage = $actual_link . "/images/simple/140px_female.png";
                } else {
                    $stringImage = $actual_link . "/images/seeker/140px_" . $seeker->code_image . "_" . $seeker->image;
                }

                if ($seeker->hide_cv == 0) {
                    $hideString = "icon-eye a";
                    $FnameString = $seeker->fname;
                    $LnameString = $seeker->lname;
                } else {
                    $hideString = "icon-eye-off a";
                    $FnameString = "السيرة الذاتية";
                    $LnameString = "مخفية";
                }

                $address = $about = "";
                if ($seeker->address != "")
                    $address = "- " . $seeker->address;
                $dateArabic = Helpers::arabic_date_format(strtotime($seeker->updated_at));


                if ($seeker->about != null)
                    $about = $seeker->about;
                elseif ($seeker->goal_text != null)
                    $about =$seeker->goal_text;
                $seekersArray[$seeker->seeker_id] =
                    array(
                        'fname' => $FnameString,
                        'lname' => $LnameString,
                        'about' => $about,
                        'user_name' => $seeker->user_name,
                        'gender' => $seeker->gender,
                        'image' => $stringImage,
                        'last_seen' => $seeker->last_seen,
                        'edt_name' => $edt_name,
                        'code_image' => $seeker->code_image,
                        'age' => $seeker->age,
                        'sum_exp' => 55,
                        'see_it' => $seeker->see_it,


                        'seeker_count' => $seeker->match . "%",
                        'domain_name' => $doamin,
                        'city_name' => $city,
                        'address' => $address,
                        'match' => $seeker->see_it,
                        'hide_cv' => $hideString,
                        'updated_at' => $dateArabic,
                        'services_count' => 0,
                        'spec' => array());

                $SeekersIds[] = $seeker->seeker_id;


            }

            $seekerServices = DB::select("SELECT `seeker_id`,COUNT(`services_id`) AS services_count
             FROM `services`
             WHERE `seeker_id` IN (" . implode(',', $SeekersIds) . ") group by `seeker_id`");

            $SeekerSpecs = DB::select("SELECT `spec_seeker`.`seeker_id`,`spec_seeker`.`spec_seeker_id`,`spec_name`,COUNT(`firend_spec`.`firend_spec_id`) AS spec_count
                    FROM `spec_seeker` 
                    JOIN `spec` ON `spec`.`spec_id` = `spec_seeker`.`spec_id`
                    LEFT JOIN `firend_spec` ON `spec_seeker`.`spec_seeker_id` = `firend_spec`.`firend_spec_id`
                    WHERE `spec_seeker`.`seeker_id` IN (" . implode(',', $SeekersIds) . ") group by   `spec`.`spec_name`, `spec_seeker`.`seeker_id`,`spec_seeker`.`spec_seeker_id`");

            foreach ($SeekerSpecs as $item) {

                foreach ($SeekersIds as $Ids) {
                    if ($item->seeker_id == $Ids) {

                        $seekersArray[$Ids]['spec'][$item->spec_name] = $item->spec_count . "-" . $item->spec_seeker_id;
                        break;
                    }
                }
            }
            foreach ($seekerServices as $item) {
                foreach ($SeekersIds as $Ids) {
                    if ($item->seeker_id == $Ids) {
                        $seekersArray[$Ids]['services_count'] = $item->services_count;
                    }
                }
            }
        }

         return response()->json([
            'users' => $seekersArray,
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }


}
