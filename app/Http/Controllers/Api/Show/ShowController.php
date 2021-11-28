<?php

namespace App\Http\Controllers\Api\Show;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Helpers;
class ShowController extends Controller
{

    public function index(){


        $id =Auth::user()->seeker_id;
        $isNew = true;

        $job_seeker = Helpers::getDataSeeker('seekers',$id,!$isNew);


        $seeker_ed = Helpers::getDataSeeker('ed',$id,$isNew);
        $seeker_exp = Helpers::getDataSeeker('exp',$id,$isNew);
        $seeker_lang = Helpers::getDataSeeker('lang',$id,$isNew);
        $seeker_spec = Helpers::getDataSeeker('spec',$id,$isNew);
        $seeker_skills = Helpers::getDataSeeker('skills',$id,$isNew);
        $seeker_cert = Helpers::getDataSeeker('cert',$id,$isNew);
        $seeker_train = Helpers::getDataSeeker('train',$id,$isNew);
        $seeker_hobby = Helpers::getDataSeeker('hobby',$id,$isNew);
        $seeker_info = Helpers::getDataSeeker('info',$id,$isNew);

        $actual_link ="https://www.libyacv.com";

        $job_seekerArr = array();
        $datereg = date("Y");
        $age = $datereg - date("Y",strtotime($job_seeker->birth_day));

        $city = $job_seeker->city_name;
        $domain = $job_seeker->domain_name;

        if($job_seeker->image == "") {
            if($job_seeker->gender =="f")
                $stringImage= $actual_link."/images/simple/female.png";
            else
                $stringImage= $actual_link."/images/simple/male.png";


        }else{
            $stringImage= $actual_link."/images/seeker/300px_". $job_seeker->code_image ."_". $job_seeker->image;
        }
      /*  if ($job_seeker->address != ""){
            $city  = $city . " - ".$job_seeker->address;
        }*/

            $job_seekerArr = [
            "city_name" =>$city,
            "domain_name" =>$domain,
            "image" =>$stringImage,
            "address" =>$job_seeker->address,
            "fname"=>$job_seeker->fname,
            "lname" =>$job_seeker->lname,
            "nat_name" =>$job_seeker->nat_name,
            "email"=>$job_seeker->email1,
                "see_it"=>$job_seeker->see_it,
            "goal_text"=>$job_seeker->goal_text,
            "user_name"=>$job_seeker->user_name,
             "phone" =>$job_seeker->phone,
            "birth_day"=>$age,
        ];
        $seeker_edArray = array();

        foreach ($seeker_ed as $item){
            $p = strpos("/",$item->edt_name);
            $edt_name = str_before($item->edt_name,"/");
            $domain_name = str_before($item->domain_name,"/");
            # $edt_name = str_replace("/"," ",$item->edt_name);
            $seeker_edArray[]=[
                "avg"=>$item->avg,
                "start_date"=>$item->start_date,
                "end_date"=>$item->end_date,
                "domain_name"=>$domain_name,
                "edt_name"=>$edt_name,
                "univ_name"=>$item->univ_name,
                "faculty_name"=>$item->faculty_name,
                "sed_name"=>$item->sed_name
            ];
        }

        $seeker_ExpArray = array();

        foreach ($seeker_exp as $item){
            $domain_name = str_before($item->domain_name,"/");

            $start_date = date('Y-m', strtotime($item->start_date));
            if($item->state == 0){
            $endate = "الى الأن";}
            else{
              $endate = date('Y-m', strtotime($item->end_date));
                }
            // $edt_name = str_replace("/"," ",$item->edt_name);
            $seeker_ExpArray[]=[
                "exp_name"=>$item->exp_name,
                "exp_desc"=>$item->exp_desc,
                "compe_name"=>$item->compe_name,
                "state" => $item->state,
                "start_date"=>$start_date,
                "end_date"=>$endate,
                "domain_name"=>$domain_name,

            ];
        }
        $seeker_LangArray = array();
        foreach ($seeker_lang as $item){
            $seeker_LangArray[]=[
                "lang_name"=>$item->lang_name,
                "level_name"=>$item->level_name,
            ];
        }

        return response()->json(array('data'=>['job_seeker'=>$job_seekerArr,'seeker_ed'=>$seeker_edArray,'seeker_exp'=>$seeker_ExpArray,
            'seeker_lang'=>$seeker_LangArray,'seeker_spec'=>$seeker_spec,
            'seeker_skills'=>$seeker_skills,'seeker_cert'=>$seeker_cert,
            'seeker_train'=>$seeker_train,
            'seeker_hobby'=>$seeker_hobby,'seeker_info'=> $seeker_info])
            , 200);
    }

    public function showCv($seeker_id){
        $id =$seeker_id;
        $isNew = true;

        $job_seeker = Helpers::getDataSeeker('seekers',$id,!$isNew);


        $seeker_ed = Helpers::getDataSeeker('ed',$id,$isNew);
        $seeker_exp = Helpers::getDataSeeker('exp',$id,$isNew);
        $seeker_lang = Helpers::getDataSeeker('lang',$id,$isNew);
        $seeker_spec = Helpers::getDataSeeker('spec',$id,$isNew);
        $seeker_skills = Helpers::getDataSeeker('skills',$id,$isNew);
        $seeker_cert = Helpers::getDataSeeker('cert',$id,$isNew);
        $seeker_train = Helpers::getDataSeeker('train',$id,$isNew);
        $seeker_hobby = Helpers::getDataSeeker('hobby',$id,$isNew);
        $seeker_info = Helpers::getDataSeeker('info',$id,$isNew);
        DB::table('seekers')->where('seeker_id',$id)->increment('see_it', 1);//->update(['see_it'=> +3]);


        $job_seekerArr = array();
        $datereg = date("Y");
        $age = $datereg - date("Y",strtotime($job_seeker->birth_day));
        $domain = $job_seeker->domain_name;

        $city = $job_seeker->city_name;
        /*  if ($job_seeker->address != ""){
              $city  = $city . " - ".$job_seeker->address;
          }*/
        $actual_link ="https://www.libyacv.com";

        if($job_seeker->image == "") {
            if($job_seeker->gender =="f")
                $stringImage= $actual_link."/images/simple/female.png";
            else
                $stringImage= $actual_link."/images/simple/male.png";


        }else{
            $stringImage= $actual_link."/images/seeker/300px_". $job_seeker->code_image ."_". $job_seeker->image;
        }

        $job_seekerArr = [
            "city_name" =>$city,
            "domain_name" =>$domain,
            "image" =>$stringImage,
            "address" =>$job_seeker->address,
            "fname"=>$job_seeker->fname,
            "lname" =>$job_seeker->lname,
            "nat_name" =>$job_seeker->nat_name,
            "email"=>$job_seeker->email1,
            "goal_text"=>$job_seeker->goal_text,
            "user_name"=>$job_seeker->user_name,
            "phone" =>$job_seeker->phone,
            "birth_day"=>$age,
            "see_it"=>$job_seeker->see_it,

        ];
        $seeker_edArray = array();

        foreach ($seeker_ed as $item){
            $p = strpos("/",$item->edt_name);
            $edt_name = str_before($item->edt_name,"/");
            $domain_name = str_before($item->domain_name,"/");
            # $edt_name = str_replace("/"," ",$item->edt_name);
            $seeker_edArray[]=[
                "avg"=>$item->avg,
                "start_date"=>$item->start_date,
                "end_date"=>$item->end_date,
                "domain_name"=>$domain_name,
                "edt_name"=>$edt_name,
                "univ_name"=>$item->univ_name,
                "faculty_name"=>$item->faculty_name,
                "sed_name"=>$item->sed_name
            ];
        }

        $seeker_ExpArray = array();

        foreach ($seeker_exp as $item){
            $domain_name = str_before($item->domain_name,"/");

            $start_date = date('Y-m', strtotime($item->start_date));
            if($item->state == 0){
                $endate = "الى الأن";}
            else{
                $endate = date('Y-m', strtotime($item->end_date));
            }
            // $edt_name = str_replace("/"," ",$item->edt_name);
            $seeker_ExpArray[]=[
                "exp_name"=>$item->exp_name,
                "exp_desc"=>$item->exp_desc,
                "compe_name"=>$item->compe_name,
                "state" => $item->state,
                "start_date"=>$start_date,
                "end_date"=>$endate,
                "domain_name"=>$domain_name,

            ];
        }
        $seeker_LangArray = array();
        foreach ($seeker_lang as $item){
            $seeker_LangArray[]=[
                "lang_name"=>$item->lang_name,
                "level_name"=>$item->level_name,
            ];
        }

        return response()->json(array('data'=>['job_seeker'=>$job_seekerArr,'seeker_ed'=>$seeker_edArray,'seeker_exp'=>$seeker_ExpArray,
                'seeker_lang'=>$seeker_LangArray,'seeker_spec'=>$seeker_spec,
                'seeker_skills'=>$seeker_skills,'seeker_cert'=>$seeker_cert,
                'seeker_train'=>$seeker_train,
                'seeker_hobby'=>$seeker_hobby,'seeker_info'=> $seeker_info])
            , 200);
    }



    public function showCvAuth(){

        $id =Auth::user()->seeker_id;
        $isNew = true;


        $job_seeker = Helpers::getDataSeeker('seekers',$id,!$isNew);


        $seeker_ed = Helpers::getDataSeeker('ed',$id,$isNew);
        $seeker_exp = Helpers::getDataSeeker('exp',$id,$isNew);
        $seeker_lang = Helpers::getDataSeeker('lang',$id,$isNew);
        $seeker_spec = Helpers::getDataSeeker('spec',$id,$isNew);
        $seeker_skills = Helpers::getDataSeeker('skills',$id,$isNew);
        $seeker_cert = Helpers::getDataSeeker('cert',$id,$isNew);
        $seeker_train = Helpers::getDataSeeker('train',$id,$isNew);
        $seeker_hobby = Helpers::getDataSeeker('hobby',$id,$isNew);
        $seeker_info = Helpers::getDataSeeker('info',$id,$isNew);


        $job_seekerArr = array();
        $datereg = date("Y");
        $age = $datereg - date("Y",strtotime($job_seeker->birth_day));
        $domain = $job_seeker->domain_name;

        $city = $job_seeker->city_name;
        /*  if ($job_seeker->address != ""){
              $city  = $city . " - ".$job_seeker->address;
          }*/
        $actual_link ="https://www.libyacv.com";

        if($job_seeker->image == "") {
            if($job_seeker->gender =="f")
                $stringImage= $actual_link."/images/simple/female.png";
            else
                $stringImage= $actual_link."/images/simple/male.png";


        }else{
            $stringImage= $actual_link."/images/seeker/300px_". $job_seeker->code_image ."_". $job_seeker->image;
        }

        $job_seekerArr = [
            "city_name" =>$city,
            "domain_name" =>$domain,
            "image" =>$stringImage,
            "address" =>$job_seeker->address,
            "fname"=>$job_seeker->fname,
            "lname" =>$job_seeker->lname,
            "nat_name" =>$job_seeker->nat_name,
            "email"=>$job_seeker->email1,
            "goal_text"=>$job_seeker->goal_text,
            "user_name"=>$job_seeker->user_name,
            "phone" =>$job_seeker->phone,
            "birth_day"=>$age,
            "see_it"=>$job_seeker->see_it,

        ];
        $seeker_edArray = array();

        foreach ($seeker_ed as $item){
            $p = strpos("/",$item->edt_name);
            $edt_name = str_before($item->edt_name,"/");
            $domain_name = str_before($item->domain_name,"/");
            # $edt_name = str_replace("/"," ",$item->edt_name);
            $seeker_edArray[]=[
                "ed_id"=>$item->ed_id,
                "avg"=>$item->avg,
                "start_date"=>$item->start_date,
                "end_date"=>$item->end_date,
                "domain_name"=>$domain_name,
                "edt_name"=>$edt_name,
                "univ_name"=>$item->univ_name,
                "faculty_name"=>$item->faculty_name,
                "sed_name"=>$item->sed_name
            ];
        }

        $seeker_ExpArray = array();

        foreach ($seeker_exp as $item){
            $domain_name = str_before($item->domain_name,"/");

            $start_date = date('Y-m', strtotime($item->start_date));
            if($item->state == 1){
                $endate = "الى الأن";}
            else{
                $endate = date('Y-m', strtotime($item->end_date));
            }
            // $edt_name = str_replace("/"," ",$item->edt_name);
            $seeker_ExpArray[]=[
                "exp_id"=>$item->exp_id,

                "exp_name"=>$item->exp_name,
                "exp_desc"=>$item->exp_desc,
                "compe_name"=>$item->compe_name,
                "state" => $item->state,
                "start_date"=>$start_date,
                "end_date"=>$endate,
                "domain_name"=>$domain_name,

            ];
        }
       /* $seeker_LangArray = array();
        foreach ($seeker_lang as $item){
            $seeker_LangArray[]=[
                "lang_id"=>$item->lang_id,

                "lang_name"=>$item->lang_name,
                "level_name"=>$item->level_name,
            ];
        }*/

        return response()->json(array('data'=>['job_seeker'=>$job_seekerArr,'seeker_ed'=>$seeker_edArray,'seeker_exp'=>$seeker_ExpArray,
                'seeker_lang'=>$seeker_lang,'seeker_spec'=>$seeker_spec,
                'seeker_skills'=>$seeker_skills,'seeker_cert'=>$seeker_cert,
                'seeker_train'=>$seeker_train,
                'seeker_hobby'=>$seeker_hobby,'seeker_info'=> $seeker_info])
            , 200);
    }
}
