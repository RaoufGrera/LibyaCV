<?php
/**
 * Created by PhpStorm.
 * User: Lenovo1
 * Date: 3/12/2016
 * Time: 1:52 AM
 */

namespace app;

use View;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Log;

use Redis;
use  Session;
use Datetime;
class Helpers
{

    public static function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime();
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
    public static function  make_slug($string, $separator = '-')
    {
        $string = trim($string);
        $string = mb_strtolower($string, 'UTF-8');
        $string = preg_replace("/[^a-z0-9_\s-ءاآؤئليةبپتثجچحخدذرزسشصضطظعغفقكکگلمنوهی]/u", '', $string);
        $string = preg_replace("/[\s-_]+/", ' ', $string);
        $string = preg_replace("/[\s_]/", $separator, $string);

        return $string;
    }
    public static function  arabic_date_format($timestamp)
    {
        $periods = array(
            "second"  => "ثانية",
            "seconds" => "ثواني",
            "minute"  => "دقيقة",
            "minutes" => "دقائق",
            "hour"    => "ساعة",
            "hours"   => "ساعات",
            "day"     => "يوم",
            "days"    => "أيام",
            "month"   => "شهر",
            "months"  => "شهور",
        );
        date_default_timezone_set('Africa/Tripoli');
        $difference = (int) abs(time() - $timestamp);

        $plural = array(3,4,5,6,7,8,9,10);

        $readable_date = "منذ ";

        if ($difference < 60) // less than a minute
        {
            $readable_date .= $difference . " ";
            if (in_array($difference, $plural)) {
                $readable_date .= $periods["seconds"];
            } else {
                $readable_date .= $periods["second"];
            }
        }
        elseif ($difference < (60*60)) // less than an hour
        {
            $diff = (int) ($difference / 60);
            $readable_date .= $diff . " ";
            if (in_array($diff, $plural)) {
                $readable_date .= $periods["minutes"];
            } else {
                $readable_date .= $periods["minute"];
            }
        }
        elseif ($difference < (24*60*60)) // less than a day
        {
            $diff = (int) ($difference / (60*60));
            $readable_date .= $diff . " ";
            if (in_array($diff, $plural)) {
                $readable_date .= $periods["hours"];
            } else {
                $readable_date .= $periods["hour"];
            }
        }
        elseif ($difference < (30*24*60*60)) // less than a month
        {
            $diff = (int) ($difference / (24*60*60));
            $readable_date .= $diff . " ";
            if (in_array($diff, $plural)) {
                $readable_date .= $periods["days"];
            } else {
                $readable_date .= $periods["day"];
            }
        }
        elseif ($difference < (365*24*60*60)) // less than a year
        {
            $diff = (int) ($difference / (30*24*60*60));
            $readable_date .= $diff . " ";

            if (in_array($diff, $plural)) {
                $readable_date .= $periods["months"];
            } else {
                $readable_date .= $periods["month"];
            }
        }
        else
        {
            $readable_date = date("d-m-Y", $timestamp);
        }

        return $readable_date;
    }
    public static function getMessage($type){

        switch ($type) {
            case 'saved':
                return "تم الحفظ بنجاح";
                break;
            case 'deleted':
                return "تم الحذف بنجاح";
            case 'error':
                return "حدث خطاء أثناء تنفيذ العملية";
                break;
        }
    }

    public static function getMessageNote($type){

        switch ($type) {
            case 'saved':
                return "تم الحفظ بنجاح";
                break;
            case 'deleted':
                return "تم الحذف بنجاح";
            case 'error':
                return "حدث خطاء أثناء تنفيذ العملية";
                break;
        }
    }
    public static function getDataSeeker($table, $id,$new)
    {
        $redis = Redis::connection();
        $dataTable=null;
        switch ($table) {
            case 'ed':
                if(!$new)
                    $dataTable = $redis->get('job_ed:'.$id);
                if($dataTable !=null){
                    $dataTable = json_decode($dataTable);
                }
                else{
                $dataTable = DB::table('job_ed')
                    ->join('job_domain', 'job_domain.domain_id', '=', 'job_ed.domain_id')
                    ->join('job_edt', 'job_edt.edt_id', '=', 'job_ed.edt_id')
                    ->join('univ', 'univ.univ_id', '=', 'job_ed.univ_id')
                    ->Leftjoin('faculty', 'faculty.faculty_id', '=', 'job_ed.faculty_id')
                    ->Leftjoin('spec_ed', 'spec_ed.sed_id', '=', 'job_ed.sed_id')
                    ->where('job_ed.seeker_id', '=', $id)
                    ->orderby('job_ed.end_date', 'DESC')->get();
                    $redis->set('job_ed:'.$id,json_encode($dataTable,JSON_UNESCAPED_UNICODE));
                }

                return $dataTable;
                break;

            case 'exp':
                if(!$new)
                $dataTable = $redis->get('job_exp:'.$id);
                if($dataTable !=null && !$new){
                    $dataTable = json_decode($dataTable);
                }
                else{
                    $dataTable = DB::table('job_exp')
                        ->join('job_domain', 'job_domain.domain_id', '=', 'job_exp.domain_id')
                        ->join('comp_exp', 'comp_exp.compe_id', '=', 'job_exp.compe_id')
                        ->where('job_exp.seeker_id', '=', $id)
                        ->orderby('job_exp.state', 'DESC')
                        ->orderby('job_exp.end_date', 'DESC')->get();
                    $redis->set('job_exp:'.$id,json_encode($dataTable,JSON_UNESCAPED_UNICODE));
                }
                return $dataTable;
                break;

            case 'lang':
                if(!$new)
                    $dataTable = $redis->get('job_lang_seeker:'.$id);
                if($dataTable !=null ){
                    $dataTable = json_decode($dataTable);
                }
                else {
                $dataTable = DB::table('job_lang_seeker')
                    ->join('job_lang', 'job_lang.lang_id', '=', 'job_lang_seeker.lang_id')
                    ->join('job_level', 'job_level.level_id', '=', 'job_lang_seeker.level_id')
                    ->where('job_lang_seeker.seeker_id', '=', $id)
                    ->orderby('job_lang_seeker.level_id', 'DESC')->get();
                    $redis->set('job_lang_seeker:'.$id,json_encode($dataTable,JSON_UNESCAPED_UNICODE));

                }
                return $dataTable;
                break;

            case 'spec':
                if(!$new)
                    $dataTable = $redis->get('spec_seeker:'.$id);
                if($dataTable !=null ){
                    $dataTable = json_decode($dataTable);
                }
                else {
                    $dataTable =  DB::table('spec_seeker')
                        ->select('spec_seeker_id','firend_spec_id','spec.spec_name',DB::raw('COUNT(firend_spec.firend_id) AS spec_count'))
                        ->join('spec', 'spec.spec_id', '=', 'spec_seeker.spec_id')
                        ->leftJoin('firend_spec', 'firend_spec.firend_spec_id', '=', 'spec_seeker.spec_seeker_id')
                        ->where('spec_seeker.seeker_id', '=', $id)
                        ->groupby('spec_seeker_id','firend_spec_id','spec.spec_name')
                        ->get();
                    $redis->set('spec_seeker:'.$id,json_encode($dataTable,JSON_UNESCAPED_UNICODE));

                }
                return $dataTable;
                break;

            case 'spec_company':
                if(!$new)
                    $dataTable = $redis->get('spec_company:'.$id);
                if($dataTable !=null ){
                    $dataTable = json_decode($dataTable);
                }
                else {
                    $dataTable = DB::table('spec_company')
                        ->select('spec_company_id','spec_company.spec_id','comp_id','spec_name')
                        ->join('spec', 'spec.spec_id', '=', 'spec_company.spec_id')
                        ->where('spec_company.comp_id', '=', $id)->get();
                    $redis->set('spec_company:'.$id,json_encode($dataTable,JSON_UNESCAPED_UNICODE));

                }
                return $dataTable;
                break;

            /*case 'specFirend':
                if(!$new)
                    $dataTable = $redis->get('specFirend:'.$id);
                if($dataTable !=null ){
                    $dataTable = json_decode($dataTable);
                }
                else {
                    $dataTable =  DB::table('spec_seeker')
                        ->select('spec_seeker_id','firend_spec_id','spec.spec_name',DB::raw('COUNT(firend_spec.firend_id) AS spec_count'))
                        ->join('spec', 'spec.spec_id', '=', 'spec_seeker.spec_id')
                        ->leftJoin('firend_spec', 'firend_spec.firend_spec_id', '=', 'spec_seeker.spec_seeker_id')
                        ->where('spec_seeker.seeker_id', '=', $id)
                        ->groupby('spec_seeker_id')
                         ->get();
                    $redis->set('specFirend:'.$id,json_encode($dataTable,JSON_UNESCAPED_UNICODE));

                }
                return $dataTable;
                break;*/

            case 'skills':
                if(!$new)
                    $dataTable = $redis->get('job_skills:'.$id);
                if($dataTable !=null ){
                    $dataTable = json_decode($dataTable);
                }
                else {
                    $dataTable = DB::table('job_skills')
                        ->join('job_level', 'job_level.level_id', '=', 'job_skills.level_id')
                        ->where('job_skills.seeker_id', '=', $id)
                        ->orderby('job_skills.level_id', 'DESC')->get();
                    $redis->set('job_skills:'.$id,json_encode($dataTable,JSON_UNESCAPED_UNICODE));

                }
                return $dataTable;
                break;

            case 'cert':
                if(!$new)
                    $dataTable = $redis->get('job_certificate:'.$id);
                if($dataTable !=null ){
                    $dataTable = json_decode($dataTable);
                }
                else {
                    $dataTable = DB::table('job_certificate')
                        ->join('job_cert', 'job_cert.cert_id', '=', 'job_certificate.cert_id')
                        ->where('job_certificate.seeker_id', '=', $id)->get();
                    $redis->set('job_certificate:'.$id,json_encode($dataTable,JSON_UNESCAPED_UNICODE));

                }
                return $dataTable;
                break;

            case 'train':
                if(!$new)
                    $dataTable = $redis->get('job_training:'.$id);
                if($dataTable !=null ){
                    $dataTable = json_decode($dataTable);
                }
                else {
                $dataTable = DB::table('job_training')
                    ->where('job_training.seeker_id', '=', $id)->get();
                    $redis->set('job_training:'.$id,json_encode($dataTable,JSON_UNESCAPED_UNICODE));

                }
                return $dataTable;
                break;

            case 'hobby':
                if(!$new)
                    $dataTable = $redis->get('job_hobby:'.$id);
                if($dataTable !=null ){
                    $dataTable = json_decode($dataTable);

                }
                else {
                $dataTable = DB::table('job_hobby')
                    ->join('hobby', 'hobby.hobby_id', '=', 'job_hobby.hobby_id')
                    ->where('job_hobby.seeker_id', '=', $id)->get();
                    $redis->set('job_hobby:'.$id,json_encode($dataTable,JSON_UNESCAPED_UNICODE));

                }
                return $dataTable;
                break;

            case 'ref':
                if(!$new)
                    $dataTable = $redis->get('job_reference:'.$id);
                if($dataTable !=null ){
                    $dataTable = json_decode($dataTable);
                }
                else {
                $dataTable = DB::table('job_reference')
                    ->where('job_reference.seeker_id', '=', $id)->get();
                $redis->set('job_reference:'.$id,json_encode($dataTable,JSON_UNESCAPED_UNICODE));

                 }
                return $dataTable;
                break;

            case 'info':
                if(!$new)
                    $dataTable = $redis->get('job_info:'.$id);
                if($dataTable !=null ){
                    $dataTable = json_decode($dataTable);
                }
                else {
                $dataTable = DB::table('job_info')
                    ->where('job_info.seeker_id', '=', $id)->get();
                    $redis->set('job_info:'.$id,json_encode($dataTable,JSON_UNESCAPED_UNICODE));

                }
                return $dataTable;
                break;

            case 'job_edt':
                $dataTable = $redis->get('database:job_edt');
                if($dataTable !=null && !$new){
                    $dataTable = json_decode($dataTable);
                }
                else{
                    $redis->del('database:job_edt');
                    $dataTable=  DB::table('job_edt')
                        ->select('edt_name','edt_id')
                        ->get();

                    $redis->set('database:job_edt',json_encode($dataTable,JSON_UNESCAPED_UNICODE));
                }
                 return $dataTable;
                break;
            case 'univ':
                $dataTable = $redis->get('database:univ');
                if($dataTable !=null && !$new){
                    $dataTable = json_decode($dataTable);
                }
                else{
                    $redis->del('database:univ');
                    $dataTable=  DB::table('univ')
                        ->select('univ_name','univ_id')
                        ->get();

                    $redis->set('database:univ',json_encode($dataTable,JSON_UNESCAPED_UNICODE));
                }
                return $dataTable;
                break;
                //
            case 'job_salary':
                $dataTable = $redis->get('database:job_salary');
                if($dataTable !=null && !$new){
                    $dataTable = json_decode($dataTable);
                }
                else{
                    $redis->del('database:job_salary');

                    $dataTable=  DB::table('job_salary')
                        ->select('salary_name','salary_id')
                        ->get();

                    $redis->set('database:job_salary',json_encode($dataTable,JSON_UNESCAPED_UNICODE));
                }
                 return $dataTable;
                break;
            case 'job_type':

                $dataTable = $redis->get('database:job_type');
                if($dataTable !=null && !$new){
                    $dataTable = json_decode($dataTable);
                }
                else{
                    $redis->del('database:job_type');

                    $dataTable=  DB::table('job_type')
                        ->select('type_name','type_id')
                        ->get();

                    $redis->set('database:job_type',json_encode($dataTable,JSON_UNESCAPED_UNICODE));
                }
                return $dataTable;
                break;

            case 'job_status':
                $dataTable = $redis->get('database:job_status');
                if($dataTable !=null && !$new){
                    $dataTable = json_decode($dataTable);
                }
                else{
                    $dataTable=  DB::table('job_status')
                        ->select('status_name','status_id')
                        ->get();

                    $redis->set('database:job_status',json_encode($dataTable,JSON_UNESCAPED_UNICODE));
                }
                return $dataTable;
                break;


            case 'job_lang':
                $dataTable = $redis->get('database:job_lang');
                if($dataTable !=null && !$new){
                    $dataTable = json_decode($dataTable);
                }
                else{
                    $redis->del('database:job_lang');

                    $dataTable=  DB::table('job_lang')
                        ->select('lang_name','lang_id')
                        ->get();

                    $redis->set('database:job_lang',json_encode($dataTable,JSON_UNESCAPED_UNICODE));
                }
                return $dataTable;
                break;



            case 'job_level':
                $dataTable = $redis->get('database:job_level');
                if($dataTable !=null && !$new){
                    $dataTable = json_decode($dataTable);
                }
                else{
                    $redis->del('database:job_level');

                    $dataTable=  DB::table('job_level')
                        ->select('level_name','level_id')
                        ->get();

                    $redis->set('database:job_level',json_encode($dataTable,JSON_UNESCAPED_UNICODE));
                }
                return $dataTable;
                break;
            case 'job_domain':
                $dataTable = $redis->get('database:job_domain');
                if($dataTable !=null && !$new){
                    $dataTable = json_decode($dataTable);
                }
                else{
                    $dataTable=  DB::table('job_domain')
                        ->select('domain_name','domain_id')

                        ->get();

                    $redis->set('database:job_domain',json_encode($dataTable,JSON_UNESCAPED_UNICODE));
                }
                return $dataTable;
                break;

            case 'job_city':
                $dataTable = $redis->get('database:job_city');
                if($dataTable !=null && !$new){
                    $dataTable = json_decode($dataTable);
                }
                else{
                    $redis->del('database:job_city');
                    $dataTable=  DB::table('job_city')
                        ->select('city_name','city_id')
                        ->get();

                    $redis->set('database:job_city',json_encode($dataTable,JSON_UNESCAPED_UNICODE));
                }
                return $dataTable;
                break;

            case 'job_comp_type':
                $dataTable = $redis->get('database:job_comp_type');
                if($dataTable !=null && !$new){
                    $dataTable = json_decode($dataTable);
                }
                else{
                    $redis->del('database:job_comp_type');

                    $dataTable=  DB::table('job_comp_type')
                        ->select('compt_name','compt_id')
                        ->get();

                    $redis->set('database:job_comp_type',json_encode($dataTable,JSON_UNESCAPED_UNICODE));
                }
                return $dataTable;
                break;

            case 'job_nat':

                $dataTable = $redis->get('database:job_nat');
                if($dataTable !=null && !$new){
                    $dataTable = json_decode($dataTable);
                }
                else{
                    $redis->del('database:job_nat');

                    $dataTable=  DB::table('job_nat')
                        ->select('nat_name','nat_id')

                        ->get();

                    $redis->set('database:job_nat',json_encode($dataTable,JSON_UNESCAPED_UNICODE));
                }
                return $dataTable;
                break;

            case 'seekers':
            $dataTable = $redis->get('seekers:'.$id);
            if($dataTable !=null && !$new){
                $dataTable = json_decode($dataTable);
            }
            else{

                $dataTable=  DB::table('seekers')
                    ->select('seeker_id','see_it','image_view','email1','phone_view','phoned_date','exp_sum','match','seekers.updated_at','job_city.city_name','job_domain.domain_name','job_edt.edt_name','user_name_company','have_company','hide_cv','price','pay_cv','fname','lname','job_domain.domain_id','job_nat.nat_name','match','website','facebook','twitter','linkedin','instagram','goodreads','email','image','code_image','goal_text','user_name','fname', 'lname', 'about', 'phone', 'birth_day', 'seekers.edt_id', 'seekers.nat_id', 'seekers.city_id', 'address', 'gender')
                    ->join('job_city','job_city.city_id','=','seekers.city_id')
                    ->join('job_edt','job_edt.edt_id','=','seekers.edt_id')
                    ->join('job_nat','job_nat.nat_id','=','seekers.nat_id')
                    ->join('job_domain','job_domain.domain_id','=','seekers.domain_id')
                    ->where('seeker_id', '=', $id)
                    ->first();


                if(Auth::guard('users')->check()){
                    if( $dataTable->seeker_id == Auth::guard('users')->user()->seeker_id){
                        Session::put('match', $dataTable->match);
                        Session::put('exp_sum', $dataTable->exp_sum);
                        Session::put('price', $dataTable->price);
                        Session::put('pay_cv', $dataTable->pay_cv);
                        Session::put('have_company', $dataTable->have_company);
                        Session::put('image', $dataTable->image);
                        Session::put('code_image', $dataTable->code_image);
                        Session::put('user_name_company', $dataTable->user_name_company);


                        if(empty(session('seeker_id'))){

                            $dataDomainRedis= $redis->get('welcome:data');
                            $data = json_decode($dataDomainRedis,TRUE);
                            Session::put('data',$data);
                           // Session::flush();

                            Session::put('seeker_id', $dataTable->seeker_id);

                            Session::put('user_name', $dataTable->user_name);
                            Session::put('count_note', 0);
                                Session::put('price', $dataTable->price);
                                Session::put('pay_cv', $dataTable->pay_cv);

                            Session::put('fname', $dataTable->fname);
                            Session::put('lname', $dataTable->lname);
                            Session::put('image', $dataTable->image);
                            Session::put('code_image', $dataTable->code_image);
                            Session::put('gender', $dataTable->gender);
                            Session::put('match', $dataTable->match);

                        }
                    }
                }
                $redis->set('seekers:'.$id,json_encode($dataTable,JSON_UNESCAPED_UNICODE));
            }
            return $dataTable;
            break;


            case 'seekerCompany':
                $dataTable = $redis->get('seekerCompany:'.$id);
                if($dataTable !=null && !$new){
                    $dataTable = json_decode($dataTable);
                }
                else{

                    $dataTable= DB::table('companys')
                        ->select('companys.comp_id','comp_name', 'comp_user_name','services','managers.block_admin'
                            ,'level','image','code_image','cover','code_cover','see_it',
                            'facebook',  'twitter',  'linkedin','website','url','comp_desc'
                            ,'lng','lat','address','email','comp_desc','domain_id','city_id','compt_id',
                            'phone','managers.seeker_id','domain_name','compt_name','city_name')
                        ->join('managers', 'managers.comp_id', '=', 'companys.comp_id')
                        ->where('companys.comp_user_name', '=', $id)
                        ->first();

                    $redis->set('seekerCompany:'.$id,json_encode($dataTable,JSON_UNESCAPED_UNICODE));
                }
                return $dataTable;
                break;

            case 'firends':
                $dataTable = $redis->get('firends:'.$id);
                if($dataTable !=null && !$new){

                    $dataTable = json_decode($dataTable);
                }
                else{

                    $dataTable= DB::table('firends')

                      //  ->where('req_firend_id', session('seeker_id'))
                        ->where('seeker_id', $id)
                        ->get();

                    $redis->set('firends:'.$id,json_encode($dataTable,JSON_UNESCAPED_UNICODE));
                }
                return $dataTable;
                break;



        }
    }

    public static function  deleteNote($id){
            $redis = Redis::connection();
            $redis->del('SeekerNote:'.$id);
    }

    public static function AddNote($id,$content,$type=1,$isRead=1){

        //$redis = Redis::connection();
        DB::table('notifications')->insert([
            'seeker_id'=>$id,
            'data'=>$content,
             'created_at'=> Now(),
            'isread'=>$isRead,
             'note_type_id'=>$type
            ]);
         //$redis->sadd('SeekerNote:'.$id,$content);
    }

    public  static function ReadData(){
        $redis = Redis::connection();

        $dataDomainRedis= $redis->get('welcome:data');
        $data = json_decode($dataDomainRedis,TRUE);
        Session::put('data',$data);

        return $data;

    }

    public  static function ReadNote($id,$isCount){

        if($isCount){
             $count = DB::table('notifications')->select('data')->where('seeker_id',$id)->where('read_at',null)->orderby('id','desc')
                 ->get();
                Session::put('count_note',count($count));
             return $count;
        }
        $reternArray = DB::table('notifications')->select('data')->where('seeker_id',$id)->orderby('id','desc')->take(6)->get();


       /* $redis = Redis::connection();
        $result =$redis->sscan('SeekerNote:'.$id,'0', 'count',400);
        $originalArray = $result[1];
        $newArray = array_slice($originalArray, 0, 60, true);
        $reternArray = array();
        foreach ($newArray as $item) {
                $reternArray[] = array(
                    'name' => $item
                );
        }*/
        return $reternArray;
    }
    public  static function setRedis($table,$newData)
    {
        $redis = Redis::connection();
        switch ($table) {
            case 'spec':
                $redis->sadd('ReadTable:spec',$newData);
                 break;
            case 'comp_exp':
                $redis->sadd('ReadTable:comp_exp',$newData);
                break;
            case 'job_edt':
                $redis->sadd('database:job_edt',$newData);
                break;
            case 'univ':
                $redis->sadd('ReadTable:univ',$newData);
                break;
            case 'faculty':
                $redis->sadd('ReadTable:faculty',$newData);
                break;
            case 'spec_ed':
                $redis->sadd('ReadTable:spec_ed',$newData);
                break;

            case 'hobby':
                $redis->sadd('ReadTable:hobby',$newData);
                break;
            case 'cert':
                $redis->sadd('ReadTable:cert',$newData);
                break;
            case 'username':
                $redis->sadd('ReadTable:username',$newData);
                break;
            case 'followers_company':
                $redis->sadd('ReadTable:followers_company',$newData);
                break;


            case 'DropRedis':
                $redis->del('ReadTable:spec');
                $redis->del('ReadTable:comp_exp');
                $redis->del('ReadTable:univ');
                $redis->del('ReadTable:faculty');
                $redis->del('ReadTable:spec_ed');
                $redis->del('database:job_edt');
                $redis->del('ReadTable:hobby');
                $redis->del('ReadTable:cert');
                $redis->del('ReadTable:username');
                $redis->del('ReadTable:followers_company');
                $redis->del('seekers');


        }
    }

    public  static function getRedis($table,$thisData)
    {
        $redis = Redis::connection();
        switch ($table) {
            case 'spec':
                $result =$redis->sscan('ReadTable:spec','0', 'match', $thisData.'=*','count', 10000);

                $first_value = reset($result[1]);

                $afterRemoveStar="empty";
                if (($pos = strpos($first_value, "=")) !== FALSE) {
                    $realValue = substr($first_value, 0, $pos);
                    if($thisData == $realValue)
                         $afterRemoveStar = substr($first_value, $pos+1);
                }

                return $afterRemoveStar;
                break;

            case 'comp_exp':
                $result =$redis->sscan('ReadTable:comp_exp','0', 'match', $thisData.'=*','count', 10000);

                $first_value = reset($result[1]);

                $afterRemoveStar="empty";
                if (($pos = strpos($first_value, "=")) !== FALSE) {
                    $realValue = substr($first_value, 0, $pos);
                    if($thisData == $realValue)
                         $afterRemoveStar = substr($first_value, $pos+1);
                }

                return $afterRemoveStar;
                break;

            case 'univ':
                $result =$redis->sscan('ReadTable:univ','0', 'match', $thisData.'=*','count', 10000);

                $first_value = reset($result[1]);

                $afterRemoveStar="empty";
                if (($pos = strpos($first_value, "=")) !== FALSE) {
                    $realValue = substr($first_value, 0, $pos);
                    if($thisData == $realValue)
                         $afterRemoveStar = substr($first_value, $pos+1);
                }

                return $afterRemoveStar;
                break;

            case 'faculty':
                $first = microtime(true);
                $result =$redis->sscan('ReadTable:faculty','0', 'match', $thisData.'=*','count', 10000);

                $first_value = reset($result[1]);

                /*   $end = microtime(true) -$first;
             Log::info('Faculty Search: '.$end .'ms');
                Log::info($result);
                Log::info($first_value);*/

                $afterRemoveStar="empty";
                if (($pos = strpos($first_value, "=")) !== FALSE) {
                    $realValue = substr($first_value, 0, $pos);
                    if($thisData == $realValue)
                         $afterRemoveStar = substr($first_value, $pos+1);
                }

                return $afterRemoveStar;
                break;


            case 'spec_ed':
                $result =$redis->sscan('ReadTable:spec_ed','0', 'match', $thisData.'=*','count', 10000);

                $first_value = reset($result[1]);

                $afterRemoveStar="empty";
                if (($pos = strpos($first_value, "=")) !== FALSE) {
                    $realValue = substr($first_value, 0, $pos);
                    if($thisData == $realValue)
                    $afterRemoveStar = substr($first_value, $pos+1);
                }

                return $afterRemoveStar;
                break;

            case 'hobby':
                $result =$redis->sscan('ReadTable:hobby','0', 'match', $thisData.'=*','count', 10000);

                $first_value = reset($result[1]);

                $afterRemoveStar="empty";
                if (($pos = strpos($first_value, "=")) !== FALSE) {
                    $realValue = substr($first_value, 0, $pos);
                    if($thisData == $realValue)
                    $afterRemoveStar = substr($first_value, $pos+1);
                }

                return $afterRemoveStar;
                break;

            case 'cert':
                $result =$redis->sscan('ReadTable:cert','0', 'match', $thisData.'=*','count', 10000);

                $first_value = reset($result[1]);

                $afterRemoveStar="empty";
                if (($pos = strpos($first_value, "=")) !== FALSE) {
                    $realValue = substr($first_value, 0, $pos);
                    if($thisData == $realValue)
                      $afterRemoveStar = substr($first_value, $pos+1);
                }

                return $afterRemoveStar;
                break;

            case 'firends':
                $result =$redis->sscan('ReadTable:firends','0', 'match', $thisData.'=*','count', 10000);

                $first_value = reset($result[1]);
                //return true or false
                $afterRemoveStar=false;
                if (($pos = strpos($first_value, "=")) !== FALSE) {
                    $realValue = substr($first_value, 0, $pos);
                    if($thisData == $realValue)
                    $afterRemoveStar = true;
                }

                return $afterRemoveStar;
                break;
            case 'followers_company':
                $result =$redis->sscan('ReadTable:followers_company','0', 'match', $thisData.'=*','count', 10000);

                $first_value = reset($result[1]);

                $afterRemoveStar="empty";
                if (($pos = strpos($first_value, "=")) !== FALSE) {
                    $realValue = substr($first_value, 0, $pos);
                    if($thisData == $realValue)
                     $afterRemoveStar = substr($first_value, $pos+1);
                }

                return $afterRemoveStar;
                break;


        }
    }

    public static function followers($table,$id,$thisData){
        $redis = Redis::connection();
        if($thisData ==null){
            $result =$redis->sscan('followers_company:'.$id,'0', 'match', $thisData.'*','count', 10000);

            if($result!=null)
             return $result[1];
            else
                return null;
        }
        switch ($table) {
            case 'followers_company':

                $result =$redis->sscan('followers_company:'.$id,'0', 'match', $thisData.'*','count', 10000);

                $first_value = reset($result[1]);

                $afterRemoveStar="empty";
                if ($first_value  == $thisData) {
                    $afterRemoveStar = $first_value;
                }
                if($thisData== null)
                    $afterRemoveStar = $first_value;

                return $afterRemoveStar;
                break;

        }
    }
    public static  function  setFollowers($table,$id,$newData){
        $redis = Redis::connection();
        switch ($table) {
            case 'followers_company':
                $redis->sadd('followers_company:' . $id, $newData);
        }

    }

    public static  function  removeFollowers($table,$id,$newData){
        $redis = Redis::connection();
        switch ($table) {
            case 'followers_company':
                $redis->srem('followers_company:' . $id, $newData);
        }

    }



    public  static function ManageRedis($table){
        switch ($table){
            case'CreateRedis':
                        $varSpec = DB::table('spec')->select('spec_name', 'spec_id')->get();
                        foreach ($varSpec as $item){
                            Helpers::setRedis('spec', $item->spec_name . "=" . $item->spec_id);
                        }

                        $varUniv = DB::table('univ')->select('univ_name', 'univ_id')->get();
                        foreach ($varUniv as $item){
                            Helpers::setRedis('univ', $item->univ_name . "=" . $item->univ_id);
                        }

                        $varUniv = DB::table('faculty')->select('faculty_name', 'faculty_id')->get();
                        foreach ($varUniv as $item){
                            Helpers::setRedis('faculty', $item->faculty_name . "=" . $item->faculty_id);
                        }

                        $varCert = DB::table('job_cert')->select('cert_name', 'cert_id')->get();
                        foreach ($varCert as $item){
                            Helpers::setRedis('cert', $item->cert_name . "=" . $item->cert_id);
                        }

                        $varComp = DB::table('comp_exp')->select('compe_name', 'compe_id')->get();
                        foreach ($varComp as $item){
                            Helpers::setRedis('comp_exp', $item->compe_name . "=" . $item->compe_id);
                        }

                        $varHobby = DB::table('hobby')->select('hobby_name', 'hobby_id')->get();
                        foreach ($varHobby as $item){
                            Helpers::setRedis('hobby', $item->hobby_name . "=" . $item->hobby_id);
                        }
                       /* $varSeeker = DB::table('seekers')->select('user_name', 'seeker_id')->get();
                        foreach ($varSeeker as $item){
                            Helpers::setRedis('username', $item->user_name . "=" . $item->seeker_id);
                        }*/
                        $varSpec = DB::table('spec_ed')->select('sed_name', 'sed_id')->get();
                        foreach ($varSpec as $item){
                            Helpers::setRedis('spec_ed', $item->sed_name . "=" . $item->sed_id);
                        }

                        $varUniv = DB::table('univ')->select('univ_name', 'univ_id')->get();
                        foreach ($varUniv as $item){
                            Helpers::setRedis('univ', $item->univ_name . "=" . $item->univ_id);
                        }

                        $varUniv = DB::table('faculty')->select('faculty_name', 'faculty_id')->get();
                        foreach ($varUniv as $item){
                            Helpers::setRedis('faculty', $item->faculty_name . "=" . $item->faculty_id);
                        }

                        $varCert = DB::table('job_cert')->select('cert_name', 'cert_id')->get();
                        foreach ($varCert as $item){
                            Helpers::setRedis('cert', $item->cert_name . "=" . $item->cert_id);
                        }

                        $varComp = DB::table('comp_exp')->select('compe_name', 'compe_id')->get();
                        foreach ($varComp as $item){
                            Helpers::setRedis('comp_exp', $item->compe_name . "=" . $item->compe_id);
                        }

                        $varHobby = DB::table('hobby')->select('hobby_name', 'hobby_id')->get();
                        foreach ($varHobby as $item){
                            Helpers::setRedis('hobby', $item->hobby_name . "=" . $item->hobby_id);
                        }



                        Helpers::getDataSeeker('job_comp_type',null,true);
                        Helpers::getDataSeeker('job_nat',null,true);
                        Helpers::getDataSeeker('job_edt',null,true);
                        Helpers::getDataSeeker('job_city',null,true);
                        Helpers::getDataSeeker('job_domain',null,true);
                        Helpers::getDataSeeker('job_status',null,true);
                        Helpers::getDataSeeker('job_type',null,true);
                        Helpers::getDataSeeker('job_lang',null,true);
                        Helpers::getDataSeeker('job_level',null,true);
                        Helpers::getDataSeeker('univ',null,true);
                        return true;
                        break;
            case 'DropRedis':
                Helpers::setRedis('DropRedis',null);
                return true;
                break;

                case 'CreateRedisCompany':
                    $items = DB::table('companys')->select('comp_user_name')->get();
                    foreach ($items as $item){
                         Helpers::getDataSeeker('seekerCompany',$item->comp_user_name,true);
                    }
                 return true;
                break;
                }





        return false;

    }

    public  static function searchRedis($table,$thisData)
    {
        $redis = Redis::connection();
        switch ($table) {
            case 'followers_company':
                $result = $redis->sscan('ReadTable:followers_company', '0', 'match', $thisData . '=*');

                $countResult = count($result[1]);
                $originalArray = $result[1];
                $newArray = array_slice($originalArray, 0, 5, true);
                $reternArray = array();


                foreach ($newArray as $item) {
                    $afterRemoveStar = "empty";
                    if (($pos = strpos($item, "=")) !== FALSE) {
                        $afterRemoveStar = substr($item, 0, $pos);
                        $reternArray[] = array(
                            'name' => $afterRemoveStar
                        );

                    }
                }
                return $reternArray;
                break;

            case 'spec':
                $result = $redis->sscan('ReadTable:spec', '0', 'match', $thisData . '=*','count', 9000);

                $countResult = count($result[1]);
                $originalArray = $result[1];
                $newArray = array_slice($originalArray, 0, 5, true);
                $reternArray = array();


                foreach ($newArray as $item) {
                    $afterRemoveStar = "empty";
                    if (($pos = strpos($item, "=")) !== FALSE) {
                        $afterRemoveStar = substr($item, 0, $pos);
                        $reternArray[] = array(
                            'name' => $afterRemoveStar
                        );

                    }
                }
                return $reternArray;
                break;

            case 'comp_exp':
                $result = $redis->sscan('ReadTable:comp_exp', '0', 'match', $thisData . '=*','count', 1000);

                $countResult = count($result[1]);
                $originalArray = $result[1];
                $newArray = array_slice($originalArray, 0, 5, true);
                $reternArray = array();


                foreach ($newArray as $item) {
                    $afterRemoveStar = "empty";
                    if (($pos = strpos($item, "=")) !== FALSE) {
                        $afterRemoveStar = substr($item, 0, $pos);
                        $reternArray[] = array(
                            'name' => $afterRemoveStar
                        );

                    }
                }
                return $reternArray;
                break;

            case 'hobby':
                $result = $redis->sscan('ReadTable:hobby', '0', 'match', $thisData . '*','count', 1000);

                $countResult = count($result[1]);
                $originalArray = $result[1];
                $newArray = array_slice($originalArray, 0, 5, true);
                $reternArray = array();


                foreach ($newArray as $item) {
                    $afterRemoveStar = "empty";
                    if (($pos = strpos($item, "=")) !== FALSE) {
                        $afterRemoveStar = substr($item, 0, $pos);
                        $reternArray[] = array(
                            'name' => $afterRemoveStar
                        );

                    }
                }
                return $reternArray;
                break;

            case 'univ':
                $result = $redis->sscan('ReadTable:univ', '0', 'match', $thisData.'*' ,'count', 10000);

                $countResult = count($result[1]);
                $originalArray = $result[1];
                $newArray = array_slice($originalArray, 0, 5, true);
                $reternArray = array();

                foreach ($newArray as $item) {
                    $afterRemoveStar = "empty";
                    if (($pos = strpos($item, "=")) !== FALSE) {
                        $afterRemoveStar = substr($item, 0, $pos);
                        $reternArray[] = array(
                            'name' => $afterRemoveStar
                        );

                    }
                }
                return $reternArray;
                break;

            case 'faculty':
                $result = $redis->sscan('ReadTable:faculty', '0', 'match', $thisData . '=*','count', 9000);

                $countResult = count($result[1]);
                $originalArray = $result[1];
                $newArray = array_slice($originalArray, 0, 5, true);
                $reternArray = array();


                foreach ($newArray as $item) {
                    $afterRemoveStar = "empty";
                    if (($pos = strpos($item, "=")) !== FALSE) {
                        $afterRemoveStar = substr($item, 0, $pos);
                        $reternArray[] = array(
                            'name' => $afterRemoveStar
                        );

                    }
                }
                return $reternArray;
                break;

            case 'spec_ed':
                $result = $redis->sscan('ReadTable:spec_ed', '0', 'match', $thisData . '=*','count', 9000);

                $countResult = count($result[1]);
                $originalArray = $result[1];
                $newArray = array_slice($originalArray, 0, 5, true);
                $reternArray = array();


                foreach ($newArray as $item) {
                    $afterRemoveStar = "empty";
                    if (($pos = strpos($item, "=")) !== FALSE) {
                        $afterRemoveStar = substr($item, 0, $pos);
                        $reternArray[] = array(
                            'name' => $afterRemoveStar
                        );

                    }
                }
                return $reternArray;
                break;

            case 'cert':
                $result = $redis->sscan('ReadTable:cert', '0', 'match', $thisData . '=*','count', 9000);

                $countResult = count($result[1]);
                $originalArray = $result[1];
                $newArray = array_slice($originalArray, 0, 5, true);
                $reternArray = array();


                foreach ($newArray as $item) {
                    $afterRemoveStar = "empty";
                    if (($pos = strpos($item, "=")) !== FALSE) {
                        $afterRemoveStar = substr($item, 0, $pos);
                        $reternArray[] = array(
                            'name' => $afterRemoveStar
                        );

                    }
                }
                return $reternArray;
                break;



            case 'username':
                $time_start = microtime(true);
             /*   $varSeeker = DB::table('seekers')->select('user_name', 'seeker_id')->get();
                foreach ($varSeeker as $item){
                    Helpers::setRedis('username', $item->user_name . "*" . $item->seeker_id);
                }
                $varSpec = DB::table('spec')->select('spec_name', 'spec_id')->get();
                foreach ($varSpec as $item){
                    Helpers::setRedis('spec', $item->spec_name . "*" . $item->spec_id);
                }

                $varUniv = DB::table('univ')->select('univ_name', 'univ_id')->get();
                foreach ($varUniv as $item){
                    Helpers::setRedis('univ', $item->univ_name . "*" . $item->univ_id);
                }

                $varUniv = DB::table('faculty')->select('faculty_name', 'faculty_id')->get();
                foreach ($varUniv as $item){
                    Helpers::setRedis('faculty', $item->faculty_name . "*" . $item->faculty_id);
                }

                $varCert = DB::table('job_cert')->select('cert_name', 'cert_id')->get();
                foreach ($varCert as $item){
                    Helpers::setRedis('cert', $item->cert_name . "*" . $item->cert_id);
                }

                $varComp = DB::table('comp_exp')->select('compe_name', 'compe_id')->get();
                foreach ($varComp as $item){
                    Helpers::setRedis('comp_exp', $item->compe_name . "*" . $item->compe_id);
                }

                $varHobby = DB::table('hobby')->select('hobby_name', 'hobby_id')->get();
                foreach ($varHobby as $item){
                    Helpers::setRedis('hobby', $item->hobby_name . "*" . $item->hobby_id);
                }
                 $varSeeker = DB::table('seekers')->select('user_name', 'seeker_id')->get();
                  foreach ($varSeeker as $item){
                      Helpers::setRedis('username', $item->user_name . "*" . $item->seeker_id);
                  }
                 $varSpec = DB::table('spec')->select('spec_name', 'spec_id')->get();
                  foreach ($varSpec as $item){
                      Helpers::setRedis('spec', $item->spec_name . "*" . $item->spec_id);
                  }

                  $varUniv = DB::table('univ')->select('univ_name', 'univ_id')->get();
                  foreach ($varUniv as $item){
                      Helpers::setRedis('univ', $item->univ_name . "*" . $item->univ_id);
                  }

                  $varUniv = DB::table('faculty')->select('faculty_name', 'faculty_id')->get();
                  foreach ($varUniv as $item){
                      Helpers::setRedis('faculty', $item->faculty_name . "*" . $item->faculty_id);
                  }

                  $varCert = DB::table('job_cert')->select('cert_name', 'cert_id')->get();
                  foreach ($varCert as $item){
                      Helpers::setRedis('cert', $item->cert_name . "*" . $item->cert_id);
                  }

                  $varComp = DB::table('comp_exp')->select('compe_name', 'compe_id')->get();
                  foreach ($varComp as $item){
                      Helpers::setRedis('comp_exp', $item->compe_name . "*" . $item->compe_id);
                  }

                  $varHobby = DB::table('hobby')->select('hobby_name', 'hobby_id')->get();
                  foreach ($varHobby as $item){
                      Helpers::setRedis('hobby', $item->hobby_name . "*" . $item->hobby_id);
                  }
  */
                $result =$redis->sscan('ReadTable:username','0', 'match', $thisData.'=*','count', 100000);

                    $countResult = count($result[1]);
                    $first_value = $result[1];
                    //$newArray = array_slice($originalArray, 0, 5, true);
                    $value=null;
               /*     $time_end = microtime(true);
                    printf("city searching took %f seconds\n"."<br>", $time_end - $time_start);
                    print_r ($thisData."<br>");
                    var_dump($result);
var_dump($originalArray);
die();*/
                    $first_value = reset($result[1]);

                    $afterRemoveStar="empty";
                    if (($pos = strpos($first_value, "=")) !== FALSE) {
                        $afterRemoveStar = substr($first_value, $pos+1);
                    }
                    return $afterRemoveStar;
                    break;


            case 'usernameNew':
                $result = DB::table('seekers')->select('user_name','seeker_id')->get();
                $value =null;


                foreach($result as $item ){
                    $redis->sadd('ReadTable:username',$item->user_name.'='.$item->seeker_id);

                }
                return $value;
                break;

        }
    }

    public static function showModal($page, array $data, $message)
    {

        return response()->json(['body' => View::make('seekers.modal.show.' . $page, $data)->render(),
                'message' => $message]
        );

    }

    public static function showModalCompany($page, array $data, $message)
    {

        return response()->json(['body' => View::make('company.modal.show.' . $page, $data)->render(),
                'message' => $message]
        );

    }
}