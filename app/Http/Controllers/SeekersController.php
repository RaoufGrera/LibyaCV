<?php

namespace App\Http\Controllers;

use App\Desc;
use App\Jobs\NoteAddJob;
use App\SeekerPrice;
use Illuminate\Http\Request;
use Hash;
use DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Redis;
use Session;
use Validator;
use Illuminate\Support\Facades\Input;

use App\easyphpthumbnail;
use App\Http\Requests;
use App\Helpers;
use App\Search;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use View;


class SeekersController extends Controller
{
    //
    /*public function __construct(){
        $this->middleware('auth');
    }*/


    public function __construct()
    {
         $this->middleware('guest', ['except' => ['logout', 'getLogout']]);

    }

    public function createjob()
    {
        $seeker_id = session('seeker_id');

        $domain= Helpers::getDataSeeker('job_domain',null,false);
        $city =Helpers::getDataSeeker('job_city',null,false);





        return view('seekers.post-job')
             ->with('domain', $domain)
            ->with('city', $city);



    }
    public function storejob(Request $request)
    {


        $seeker_id = session('seeker_id');

        $i = 0;

        $job_name = trim(strip_tags($request->input('job_name')));
        $job_desc = trim(strip_tags($request->input('job_desc')));
        /*        $job_skills = trim(strip_tags($request->input('job_skills')));*/
        $city_id = trim(strip_tags($request->input('city_id')));
        $domain_id = trim(strip_tags($request->input('domain_id')));

        $is_active =1; // 0 is active..  1 is not active
        $how_receive = 1; // 0 is active..  1 is not active
        date_default_timezone_set('Africa/Tripoli');


        $email = trim(strip_tags($request->input('email'))); // 0 is active..  1 is not active
        $phone = trim(strip_tags($request->input('phone'))); // 0 is active..  1 is not active
        $website = trim(strip_tags($request->input('website'))); // 0 is active..  1 is not active


        $isNeedMore = false;
        $isOK = false;
        if($how_receive == 1){
            $isNeedMore = true;
            if($email !="" && $email != null){
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error = "خطاء في كتابة البريد الإلكتروني، لتجنب الخطاء قم بكتابة البريد الإلكتروني بشكل صحيح او قم بمسح النص داخل الحقل بالكامل.";


                    return redirect('/profile/job/create')
                        ->with('error', $error)
                        ->withInput();


                    //  return redirect('/company-profile/' . $user . '/job/create')   ->with('error', $error);
                }
                $isOK = true;
            }

            if($website !="" && $website != null){
                if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
                    $error = "خطاء في كتابة الموقع الإلكتروني، لتجنب الخطاء قم بكتابة الموقع بشكل صحيح او قم بمسح النص داخل الحقل بالكامل.";
                    return redirect('/profile/job/create')
                        ->with('error', $error)
                        ->withInput();
                }
                $isOK = true;
            }
            if($phone !="" && $phone != null){
                if (ctype_digit($phone) && (
                        ($phone[0] =="0" && strlen($phone) ==10) ||
                        ($phone[0] !="0" && strlen($phone) ==9)
                    ) ){
                    $isOK = true;

                }else{
                    $error = "خطاء في كتابة رقم الهاتف، لتجنب الخطاء قم بكتابة رقم الهاتف بشكل صحيح او قم بمسح النص داخل الحقل بالكامل.";
                    return redirect('/profile/job/create')
                        ->with('error', $error)
                        ->withInput();
                }

            }

        }


        if($how_receive == 1 && !$isOK){
            $error = "خطاء، الرجاء ادخال طريقة لتقدم علي الوظيفة";
            return redirect('/profile/job/create')
                ->with('error', $error)
                ->withInput();
        }


        $validator = Validator::make(Input::all(), [
            'domain_id' => 'required|exists:job_domain,domain_id',
            'city_id' => 'required|exists:job_city,city_id',
        ]);
        if ($validator->fails()) {
            $error = "خطاء في الإدخال.";
            return redirect('/profile/job/create')
                ->with('error', $error)
                ->withInput();
        }

        if($how_receive == 0){
            $email = "";$phone = ""; $website = "";

        }
        $p=1;




        $job_start = date("Y-m-d");

        $timestamp = Now('Africa/Tripoli');
        //  $job_end = date('Y-m-d', strtotime("+40 days"));


                $job_end = date('Y-m-d', strtotime("+40 days"));

        //  $job_end = date('Y-m-d', strtotime("+30 days"));
        $minDesc= DB::table('job_description')->min('desc_down');
        $job_stop = rand(37,389);
        $job_stop  = $job_stop + 12;
        if($minDesc == 0)
            $l=99999999999999;
        else
            $l=$minDesc-1;

        $desc = Desc::create([
            'job_name' => $job_name,
            'job_desc' => $job_desc,
            /*            'job_skills' => $job_skills,*/
            'city_id' => $city_id,
            'domain_id' => $domain_id,
            'email' => $email,
            'phone' => $phone,
            'website' => $website,
            'job_stop' => $job_stop,

            'is_active' => 1,
            'how_receive' => 1,
            'created_at' => $timestamp,
            'job_start' => $job_start,
            'job_end' => $job_end,
            'desc_down' => $l,
            'manager_id' =>185,

        ]);


        $desc->comp_name ="وظائف ليبيا" ;
        NoteAddJob::dispatch($desc)
            ->delay(now()->addMinutes(1));




        return redirect('/job/search');
    }

    public  function allSeen(){


        //
        if(empty(session('seeker_id')))
            $id = Auth::guard('users')->user()->seeker_id;
        else
            $id =session('seeker_id');

        if(session('count_note') != 0){
        DB::table('notifications')->where('seeker_id',$id)->where('read_at',null)->update([
             'read_at'=>Now(),
        ]);
        Session::put('count_note',0);
        }
        $notes = DB::table('notifications')->where('seeker_id',$id)->orderby('id','desc')->take(6)->get();

        return response()->json([
            'users' => $notes,
        ]);

    }
    public function notification(){
        if(empty(session('seeker_id')))
            $id = Auth::guard('users')->user()->seeker_id;
        else
            $id =session('seeker_id');
        $notes = DB::table('notifications')->where('seeker_id',$id)->orderby('id','desc')->take(20)->get();

        return view('seekers.notification')->with('notesData',$notes);
    }
    public  function  test(){

      //  $user = Auth::guard('seekers')->user();
       // $user->notify(new \App\Notifications\NewNoification());

        $user = Auth::guard('seekers')->user();
        foreach ($user->notifications as $not){
            var_dump($not->type);
        }
    }

    public function index()
    {
        /*$value = "ممجاستير";
         $myid = DB::insertGetId('INSERT INTO job_edt (edt_name) SELECT  "'.$value.'" FROM job_edt WHERE NOT EXISTS( SELECT edt_name FROM job_edt WHERE edt_name = "'. $value.'" ) LIMIT 1');
        echo $myid;
        die();*/
        $time_start = microtime(true);



        $isNew = false;
        //$myid = DB::table('job_edt')->insertGetId(['edt_name' => 'ممجاستير']);

        //$redis = Redis::connection();

      //  $id = Auth::guard('seekers')->user()->seeker_id;





          if(session()->has('seeker_id')){
              $id = session('seeker_id');
              $job_seeker = Helpers::getDataSeeker('seekers',$id,$isNew);

          } else{

              $id = Auth::guard('users')->user()->seeker_id;//Auth::user()->seeker_id;
              $job_seeker = Helpers::getDataSeeker('seekers',$id,!$isNew);
          }
//
   //     $seekers_id =Auth::user()->seeker_id;

        $domain_type = Helpers::getDataSeeker('job_domain',null,false);


     /*   $dataTable = DB::table('job_domain')->select('job_domain.domain_id','domain_name',DB::Raw(' IFNULL( `seeker_id` , 0 ) as have'))

            ->leftjoin('seeker_note_firebase','seeker_note_firebase.domain_id','job_domain.domain_id')
            ->get();*/



        $seeker_ed = Helpers::getDataSeeker('ed',$id,$isNew);
        $seeker_exp = Helpers::getDataSeeker('exp',$id,$isNew);
        $seeker_lang = Helpers::getDataSeeker('lang',$id,$isNew);
        $seeker_spec = Helpers::getDataSeeker('spec',$id,$isNew);
        $seeker_skills = Helpers::getDataSeeker('skills',$id,$isNew);
        $seeker_cert = Helpers::getDataSeeker('cert',$id,$isNew);
        $seeker_train = Helpers::getDataSeeker('train',$id,$isNew);
        $seeker_hobby = Helpers::getDataSeeker('hobby',$id,$isNew);
        $seeker_info = Helpers::getDataSeeker('info',$id,$isNew);


        $match = 0;

        if ($job_seeker->image != '')
            $match = $match + 10;

        if ($job_seeker->goal_text != '')
            $match = $match + 5;


        if ( $seeker_ed != null)
            $match = $match + 20;

        if ($seeker_exp != null)
            $match = $match + 15;

        if ( $seeker_lang != null)
            $match = $match + 5;

        if ( $seeker_spec!= null)
            $match = $match + 10;

        if ( $seeker_skills!= null)
            $match = $match + 10;

        if ( $seeker_cert!= null)
            $match = $match + 5;

        if ($seeker_train!= null)
            $match = $match + 5;

        if ( $seeker_hobby!= null)
            $match = $match + 3;



        if ( $seeker_info!= null)
            $match = $match + 10;


        if (session('match')!= $match) {

            DB::table('seekers')
                ->where('seeker_id', $id)->update([
                    'match' => $match,
                ]);
            $job_seeker = Helpers::getDataSeeker('seekers',$id,!$isNew);

        }





        return view('seekers.profile')
            ->with('id', $id)
            ->with('job_seeker', $job_seeker)

            ->with('seeker_ed', $seeker_ed)
            ->with('seeker_exp', $seeker_exp)
            ->with('seeker_lang', $seeker_lang)
            ->with('seeker_spec', $seeker_spec)
            ->with('seeker_skills', $seeker_skills)
            ->with('seeker_cert', $seeker_cert)
            ->with('seeker_train', $seeker_train)
            ->with('seeker_hobby', $seeker_hobby)
             ->with('match', $match)
              ->with('seeker_info', $seeker_info);
    }


    public function visibility()
    {
        $id = session('seeker_id');


        $visits = DB::table('seekers')->select('see_it')->where('seeker_id',$id)->first();


         return view('seekers.visibility')
             ->with('visits', $visits);
    }

    public function req()
    {
        $id = session('seeker_id');


        $myjobs = DB::table('job_description')
            ->select('job_seeker_req.seeker_id', 'job_description.desc_id','image','code_image','job_description.see_it',
                'job_name', 'managers.manager_id','job_seeker_req.req_id', 'companys.comp_id', 'req_date', 'comp_name','job_end','req_event','see', 'comp_user_name')
            ->join('job_seeker_req', 'job_seeker_req.desc_id', '=', 'job_description.desc_id')
            ->join('managers', 'managers.manager_id', '=', 'job_description.manager_id')
            ->join('companys', 'companys.comp_id', '=', 'managers.comp_id')
            ->where('job_seeker_req.seeker_id', '=', $id)
             ->get();

        return view('seekers.req')
             ->with('myjobs', $myjobs);
    }
    public function deleteReq($req_id){

        $id = session('seeker_id');

        DB::table('job_seeker_req')
            ->where('req_id',$req_id)
            ->where('seeker_id',$id)
            ->delete();

        return response()->json([
            'check' =>true,
        ]);


    }


    //Edit Goal
    public function editGoal()
    {
        $seekers_id = session('seeker_id');


        $goal = Helpers::getDataSeeker('seekers',$seekers_id,false);

        return view('seekers.modal.edit.egoal')
            ->with('goal', $goal);


    }

    //Edit Contact
    public function editContact()
    {
        $seekers_id = session('seeker_id');

        $contact = Helpers::getDataSeeker('seekers',$seekers_id,false);

        return view('seekers.modal.edit.econtact')
            ->with('contact', $contact);


    }

    public function searchAll(Request $request){

        $query = $request->input('keyword');

        $checkSearch = $request->input('stringHide');


        switch ($checkSearch) {
            case  "السير الذاتية" :
                return redirect('/cv/search?string='.$query);
                break;

            case "الشركات" :
                return redirect('/company/search?string='.$query);
                break;

            case "الوظائف" :
                return redirect('/job/search?string='.$query);
                break;

            case "الدورات" :
                return redirect('/course/search?string='.$query);
                break;
        }


    }
    public function search(Request $request)
    {


        $query = $request->input('keyword');

        $checkSearch = $request->input('stringHide');


        switch ($checkSearch) {
            case  "السير الذاتية" :

                $users = DB::select( DB::raw("SELECT CONCAT_WS(' ',`fname`,`lname`) as `name`,`phone`,
                                        IF(image = '' || image is null,IF(gender ='m', '/images/simple/40px_male.png', '/images/simple/40px_female.png'),CONCAT_WS(CONCAT('/images/seeker/40px','_',`code_image`,'_'),\"\",`image`)) as image
                     ,CONCAT_WS('/user/','',`user_name`) as `user_name` FROM seekers WHERE MATCH (fname,lname) AGAINST ('$query') limit 5"));

                $time_start = microtime(true);
             /*   $users = DB::table('seekers')
                    ->select(DB::raw('CONCAT_WS(" ",`fname`,`lname`) as `name`,`phone`,
                    ("/images/simple/40px_male.png") as image
                     ,CONCAT_WS("/user/","",`user_name`) as `user_name`'))
                    ->where('fname', 'LIKE',  $query . '%')
                    ->take(5)
                    ->skip(0)
                    ->get();*/

                break;

            case "الشركات" :
                $users = DB::table('companys')
                    ->select(DB::raw('CONCAT_WS("/c/","",`comp_user_name`) as `user_name`,
                      `comp_name` as `name`
                      ,IF(image = "" || image is null,"/images/simple/40px_company.png",CONCAT_WS(CONCAT("/images/company/40px","_",`code_image`,"_"),"",`image`)) as image '))
                    ->where('comp_name', 'LIKE', '%' . $query . '%')
                    ->take(5)
                    ->skip(0)
                    ->get();
                break;

            case "الوظائف" :
                $users = DB::table('job_description')
                    ->select(DB::raw('CONCAT_WS("/job/","",`desc_id`) as `user_name`,
                      `job_name` as `name`
                      ,IF(image = "" || image is null,"/images/simple/40px_company.png",CONCAT_WS(CONCAT("/images/company/40px","_",`code_image`,"_"),"",`image`)) as image '))
                    ->join('managers', 'managers.manager_id', '=', 'job_description.manager_id')
                    ->join('companys', 'companys.comp_id', '=', 'managers.comp_id')
                    ->where('job_end', '>=', NOW())
                    ->where('job_name', 'LIKE', '%' . $query . '%')
                    ->take(5)
                    ->skip(0)
                    ->get();
                break;
        }


        return response()->json([
            'users' => $users,
        ]);
    }

    public function univ(Request $request)
    {


        $query = $request->input('keyword');

        $users = Helpers::searchRedis('univ',$query);


        return response()->json([
            'data' => $users,
        ]);
    }

    public function exp(Request $request)
    {


        $query = $request->input('keyword');
        $users = Helpers::searchRedis('comp_exp',$query);


        return response()->json([
            'data' => $users,
        ]);
    }

    public function cert(Request $request)
    {


        $query = $request->input('keyword');
        $users = Helpers::searchRedis('cert',$query);
        return response()->json([
            'data' => $users,
        ]);
    }

    public function faculty(Request $request)
    {
        $query = $request->input('keyword');
        $users = Helpers::searchRedis('faculty',$query);
        return response()->json([
            'data' => $users,
        ]);
    }

    public function spec(Request $request)
    {
        $query = $request->input('keyword');
        $users = Helpers::searchRedis('spec',$query);

        return response()->json([
            'data' => $users,
        ]);
    }

    public function specCompany(Request $request)
    {
        $query = $request->input('keyword');

        $users = Helpers::searchRedis('spec',$query);


        return response()->json([
            'data' => $users,
        ]);
    }

    public function specEd(Request $request)
    {
        $query = $request->input('keyword');

        $users = Helpers::searchRedis('spec_ed',$query);


        return response()->json([
            'data' => $users,
        ]);
    }
    public function hobby(Request $request)
    {
        $query = $request->input('keyword');

        $users = Helpers::searchRedis('hobby',$query);


        return response()->json([
            'data' => $users,
        ]);
    }
    //Update Goal
    public function updateGoal(Request $request)
    {



        $seekers_id = session('seeker_id');
        $goal_text = $request->input('goal_text');
        $message = "تم التعديل نجاح";
        DB::table('seekers')
            ->where('seeker_id', $seekers_id)->update([
                'goal_text' => $goal_text
            ]);



        $job_seeker = Helpers::getDataSeeker('seekers',$seekers_id,true);

        return response()->json(array('body' => View::make('seekers.modal.show.goal')
            ->with('job_seeker',$job_seeker)->render(),
            'message' => $message)
        );

    }

    public function showGoal(){
        $id = session('seeker_id');


        $goal = Helpers::getDataSeeker('seekers',$id,false);
        return view('seekers.goal')
            ->with('goal');
    }
    public function updateContact(Request $request)
    {
        $seeker_id = session('seeker_id');
        $facebook = $request->input('facebook');
        $website = $request->input('website');
        $twitter = $request->input('twitter');
        $instagram = $request->input('instagram');
        $linkedin = $request->input('linkedin');
        $goodreads = $request->input('goodreads');

        DB::table('seekers')
            ->where('seeker_id', $seeker_id)->update([
                'website' => $website,
                'facebook' => $facebook,
                'twitter' => $twitter,
                'instagram' => $instagram,
                'linkedin' => $linkedin,
                'goodreads' => $goodreads,
            ]);
        $message = "";

        $job_seeker = Helpers::getDataSeeker('seekers',$seeker_id,true);

        $data =[
            "job_seeker" => $job_seeker,
        ];
        return  Helpers::showModal('contact',$data,$message);
    }

    public function editImageSeeker()
    {
        $seeker_id = session('seeker_id');


        return view('seekers.modal.edit.eimageseeker')
            ->with('seeker_id', $seeker_id);
    }

    public function deleteImageSeeker()
    {
        $seeker_id = session('seeker_id');
        DB::table('seekers')
            ->where('seeker_id', $seeker_id)
            ->update([
                'image' => "",
                'code_image'=>""
            ]);
         Helpers::getDataSeeker('seekers',$seeker_id,true);

        return redirect('/profile');
    }

    public function updateImageSeeker(Request $request)
    {

        $seeker_id = session('seeker_id');
        $code_image =  session('code_image');


        $code = str_random(15);

        if($request->file('image') == NULL)
            $imageType = NULL;
        else
            $imageType = $request->file('image')->getClientOriginalExtension();


        if ((($imageType == "jpeg")
                || ($imageType == "JPEG")
                || ($imageType == "JPG")
                || ($imageType == "jpg")
                || ($imageType == "PNG")
                || ($imageType == "png"))
            && ($request->file('image')->getSize() < 700000)
        ) {

            $imageName = $seeker_id . '.jpg';


            $filename300 = base_path() . '/public/images/seeker/300px_'.$code_image.'_'. $imageName;
            $filename140 = base_path() . '/public/images/seeker/140px_'.$code_image .'_'. $imageName;
            $filename40 = base_path() . '/public/images/seeker/40px_'.$code_image .'_'. $imageName;

            if (file_exists($filename300)) {
                if (!unlink($filename300)) {
                    die("حدث خطاء أثناء حذف الصورة القديمة");
                }

            }
            if (file_exists($filename140)) {
                if (!unlink($filename140)) {
                    die("حدث خطاء أثناء حذف الصورة القديمة");
                }

            }
            if (file_exists($filename40)) {
                if (!unlink($filename40)) {
                    die("حدث خطاء أثناء حذف الصورة القديمة");
                }

            }
            $filename = base_path() . '/public/images/seeker_new/'.'_'.$code.'_'.$imageName;

            $newNameImage =  '_'.$code.'_'.$imageName;

            $request->file('image')->move(
                base_path() . '/public/images/seeker_new/', $newNameImage
            );


            if (file_exists($filename)) {
                $img = Image::make($filename);

                $img->resize(300, 300);


// insert a watermark
        //        $img->insert('public/watermark.png');

// save image in desired format
                $img->save(base_path() . '/public/images/seeker/300px'.$newNameImage);
                $img->resize(140, 140);

                $img->save(base_path() . '/public/images/seeker/140px'.$newNameImage);
                $img->resize(40, 40);

                $img->save(base_path() . '/public/images/seeker/40px'.$newNameImage);
             /*   $thumb = new easyphpthumbnail();


                $thumb->Thumbsize = 300;

                $thumb->Thumbsaveas = 'jpg';
                $thumb->Thumblocation = 'images/seeker/300px';
                $thumb->Createthumb($filename, 'file');

                $thumb->Thumbsize = 140;
                $thumb->Thumbsaveas = 'jpg';
                $thumb->Thumblocation = 'images/seeker/';
                $thumb->Thumbprefix = '140px';
                $thumb->Createthumb($filename, 'file');

                $thumb->Thumbsize = 40;
                $thumb->Thumbsaveas = 'jpg';
                $thumb->Thumblocation = 'images/seeker/';
                $thumb->Thumbprefix = '40px';
                $thumb->Createthumb($filename, 'file');*/
                //  $thumb =  base_path() . '/public/images/seeker/'.$imageName;

                DB::table('seekers')
                    ->where('seeker_id', $seeker_id)
                    ->update([
                        'image' => $imageName,
                        'code_image' => $code,

                    ]);

            }
        } else {

            $job_seeker =  Helpers::getDataSeeker('seekers',$seeker_id,true);


            $message="";

            $data = [
                "job_seeker" => $job_seeker,
            ];

            return Helpers::showModal('image', $data, $message);
         }
         // Helpers::getDataSeeker('seekers',$seeker_id,true);

        $job_seeker =  Helpers::getDataSeeker('seekers',$seeker_id,true);


        $message="";

        $data = [
            "job_seeker" => $job_seeker,
         ];

        return Helpers::showModal('image', $data, $message);


    }

    public function editCv()
    {
        $seekers_id = session('seeker_id');

        $info = Helpers::getDataSeeker('seekers',$seekers_id,false);

        return view('seekers.modal.add.ucv')
            ->with('info', $info);

    }
    public function updateCv()
    {
        $seekers_id = session('seeker_id');


        $sum_exp = DB::table('job_exp')
            ->select(DB::raw(" SUM(TIMESTAMPDIFF(month, job_exp.start_date,job_exp.end_date)) as sum_exp"))
->where('seeker_id',$seekers_id)
            ->first();

        $minCV= DB::table('seekers')->min('cv_down');
        DB::table('seekers')->where('seeker_id',$seekers_id)->update([
            'cv_down'=>$minCV-1,
            'updated_at'=>\Carbon\Carbon::now(),
            'exp_sum' =>$sum_exp->sum_exp,
        ]);
      Helpers::getDataSeeker('seekers',$seekers_id,true);

        return redirect('/profile')->with('ok', 'تم تحديث السيرة الذاتية بنجاح');


    }
    //Edit Info
    public function editInfo()
    {


        $seekers_id = session('seeker_id');
        $city = Helpers::getDataSeeker('job_city',null,false);
        $edt = Helpers::getDataSeeker('job_edt',null,false);
        $domain = Helpers::getDataSeeker('job_domain',null,false);
        $info = Helpers::getDataSeeker('seekers',$seekers_id,false);


        $now =\Carbon\Carbon::now();
        $plusDate = $now->subMonths(2);
        $date =  Carbon::parse($info->phoned_date);
        $isDate=$isSuccsed=$isPhone = false;

        if($info->phoned_date != null)
            $isDate = true;

            if($isDate) {
                if ($plusDate->gt($date))
                    $isSuccsed = true;
            }else{
                $isSuccsed = true;
            }

        $info->phoned_date = true; // $isSuccsed;


            $info->match = $date;

        return view('seekers.modal.edit.einfoseeker')
            ->with('info', $info)
            ->with('city', $city)
            ->with('domain', $domain)
            ->with('edt', $edt);

    }

    //Update Info
    public function updateInfo(Request $request)
    {
        $seekers_id = session('seeker_id');
        $fname = $request->input('fname');
        $lname = "";
        $about = $request->input('about');

        $birth_day = $request->input('fdate2') . "-" . $request->input('fdate1') . "-" . $request->input('fdate');


        $address = $request->input('address');
        $city_id = $request->input('city');
        $edt_id = $request->input('edt');
        $phone = $request->input('phone');
        $domain_id = $request->input('domain');
        $email1 = $request->input('email');

        $gender = $request->input('sex');

        if($gender != 'm')
            $gender='f';


        $validator = Validator::make(Input::all(), [
            'domain' => 'required|exists:job_domain,domain_id',
            'edt' => 'required|exists:job_edt,edt_id',
            'city' => 'required|exists:job_city,city_id',
            'fdate2' => 'required',
            'fname' => 'required',
           // 'lname' => 'required',
            'fdate1' => 'required',
            'fdate' => 'required',


             'sex' => 'required',
        ]);
        if ($validator->fails()) {
             $job_seeker = Helpers::getDataSeeker('seekers',$seekers_id,false);

            $data = ["job_seeker" => $job_seeker,];
            $message = "خطاء في الإدخال";
            return  Helpers::showModal('infoseeker',$data,$message);
        }

     /*   $phoneDate = DB::table('seekers')->select('phoned_date','phone')->where('seeker_id',$seekers_id)->first();
        $isDate=$isSuccsed=$isPhone = false;

        if($phoneDate->phoned_date != null)
            $isDate = true;*/


        $plusPhone = "0"+$phone;
        if (ctype_digit($phone) && (
                ($phone[0] =="0" && strlen($phone) ==10) ||
                ($phone[0] !="0" && strlen($phone) ==9)
            ) )
            $isPhone= true;

      /*  $now =\Carbon\Carbon::now();
        $plusDate = $now->subMonths(2);
       /*  $date =  Carbon::parse($phoneDate->phoned_date);
        if($isPhone) {
            if($isDate) {
                if ($plusDate->gt($date))
                    $isSuccsed = true;
            }else{
                $isSuccsed = true;
            }
        }*/
     //   $count = DB::table('seekers')->select('phone')->where('seeker_id','!=',$seekers_id)->where('phone',$phone)->count();

     //   if($isSuccsed && $count == 0 ){

            DB::table('seekers')
                ->where('seeker_id', $seekers_id)->update([
                    'fname' => $fname,
                    'lname' => $lname,
                    'about' => $about,
                    'address' => $address,
                    'phone' => $phone,
                    'city_id' => $city_id,
                    'email1'=>$email1,
                    'edt_id' => $edt_id,
                    'domain_id' => $domain_id,
                    'birth_day' => $birth_day,
                    'gender' => $gender,
                 //   'phoned_date' =>\Carbon\Carbon::now()
                ]);
     /*   }else{
            DB::table('seekers')
                ->where('seeker_id', $seekers_id)->update([
                    'fname' => $fname,
                    'lname' => $lname,
                    'about' => $about,
                    'address' => $address,
                    //'phone' => $phone,
                    'city_id' => $city_id,

                    'nat_id' => $nat_id,
                    'domain_id' => $domain_id,
                    'birth_day' => $birth_day,
                    'gender' => $gender,
                 ]);
        }
/*/


   // if(!$isSuccsed && $count != 0)
            $message = "تم حفظ البيانات بنجاح.";
           // else
         //       $message = "تم حفظ البيانات بنجاح، لكن لن يتم تحديث رقم الهاتف حتي "." ".$phoneDate->phoned_date ;

            $job_seeker = Helpers::getDataSeeker('seekers',$seekers_id,true);


            $data =[
                "job_seeker" => $job_seeker,
            ];
            return  Helpers::showModal('infoseeker',$data,$message);
        }

    public function friends()
    {
        $seekers_id = session('seeker_id');
       /*  $firends = DB::table('seekers')->select('user_name', 'gender','fname', 'lname', 'image','code_image')
            ->where(function ($query) use ($seekers_id) {
                return $query->whereRaw('seekers.seeker_id in (  select  req_firend_id from firends where firends.seeker_id =' . $seekers_id . ' AND status = 1 )')
                    ->ORwhereRaw('seekers.seeker_id in ( select seeker_id from firends   where firends.req_firend_id =' . $seekers_id . ' AND status = 1)');
            })->where('seeker_id', '!=', $seekers_id)
            ->get();*/
        $firends = DB::table('followers_seeker')
            ->select('fname','lname','user_name','image','code_image','gender')
            ->join('seekers','seekers.seeker_id','followers_seeker.seeker_id')
            ->where('followers_seeker_id',$seekers_id)
            ->get();

        $req_firends = DB::table('followers_seeker')
            ->select('fname','lname','user_name','image','code_image','gender')
            ->join('seekers','seekers.seeker_id','followers_seeker.followers_seeker_id')
            ->where('followers_seeker.seeker_id',$seekers_id)
            ->get();




        return view('seekers.firends')
            ->with('firends', $firends)
           ->with('reqf', $req_firends);
    }


    public function destroyImageSeeker(){
        $seeker_id = session('seeker_id');
        $checkComp = DB::table('seekers')
            ->select('seeker_id','image','code_image')
            ->where('seeker_id',$seeker_id)
            ->first();


        if(!empty($checkComp)){
            if($checkComp->image != ''){
            $code_image = $checkComp->code_image;
            $comp_id = $checkComp->seeker_id;
            $imageName = $comp_id . '.jpg';

            $filename300 = base_path() . '/public/images/seeker/300px_'.$code_image.'_'. $imageName;
            $filename140 = base_path() . '/public/images/seeker/140px_'.$code_image .'_'. $imageName;
            $filename40 = base_path() . '/public/images/seeker/40px_'.$code_image .'_'. $imageName;


            if (file_exists($filename300)) {
                if (!unlink($filename300)) {

                }

            }
            if (file_exists($filename140)) {
                if (!unlink($filename140)) {

                }

            }
            if (file_exists($filename40)) {
                if (!unlink($filename40)) {

                }

            }

            DB::table('seekers')
                ->where('seeker_id',$seeker_id)
                ->update([
                    'image' => '',
                ]);
            }
        }
       $job_seeker =  Helpers::getDataSeeker('seekers',$seeker_id,true);


        $message="";

        $data = [
            "job_seeker" => $job_seeker,
            "user" => $seeker_id
        ];

        return Helpers::showModal('image', $data, $message);

    }

    public function showStore(){

        $store=DB::table('store')->where('isvalid','=',1)->get();


         return view('seekers.store')->with('store',$store) ;

    }

    public  function showCompany(){
        $company = session('user_name_company');
         return view('seekers.store.buycompany')->with('company',$company);
    }


    public  function showCv(){
        //$seeker_id = session('seeker_id');
         return view('seekers.store.buycv');
    }


    public  function showDownloadCv(){
         return view('seekers.store.downloadcv');
    }

    public function printPdf(){
        $seeker_id = session('seeker_id');

        if(session('price') < 3000)
            return response()->json(['message' => "خطاء في اجراء العملية"]);


        if(session('pay_cv') =='1')
            return response()->json(['message' => "قد قمت بشراء هذه الخدمة من قبل."]);

        $priseAfterPay= session('price') - 3000;
        DB::table('seekers')->where('seeker_id',$seeker_id)->update([
            'price' => $priseAfterPay,
            'pay_cv' => '1',
        ]);

        $date= date('Y-m-d');;
        $content =  " تم تفعيل خدمة تحميل السيرة الذاتية بنجاح"." ".$date;
        Helpers::AddNote($seeker_id,$content,3);

         Helpers::getDataSeeker('seekers',$seeker_id,true);


        $message = "تمت عملية الشراء بنجاح، سوف تتمكن من تحميل سيرتك الذاتية. ";
        return response()->json(['message' => $message]);

    }


    public function payCompany(Request $request){
        $seeker_id = session('seeker_id');

        if(session('price') < 35000)
            return response()->json(['message' => "خطاء في اجراء العملية"]);



        $myCompany = Helpers::getDataSeeker('seekerCompany',$seeker_id,false);
        $company_id = $myCompany->comp_id;
        $company= DB::table('companys')->select('endstar')->where('comp_id',$company_id)->first();

         $companyStarPlus = Carbon::now()->addDays(20);
        if($company->endstar >= Carbon::now())
            return response()->json(['message' => "الشركة قيد التمييز حتي تاريخ"." ".$companyStarPlus]);

        DB::table('companys')->where('comp_id',$myCompany->comp_id)
            ->update([
                'isstar'=>1,
                'stardate'=> Carbon::now(),
                'endstar'=>  $companyStarPlus,
            ]);

        DB::table('store_company')->insert([
            'company_id' => $company_id,
            'seeker_id' =>$seeker_id,
            'price' => '35000',
            'createdate'=>Carbon::now(),
        ]);

        $priseAfterPay= session('price') - 35000;
        DB::table('seekers')->where('seeker_id',$seeker_id)->update([
            'price' => $priseAfterPay,
        ]);

        $date= date('Y-m-d');;
        $content =  " تم تمييز الشركة الخاصة بك بنجاح"." ".$date;
        Helpers::AddNote($seeker_id,$content,3);

        Helpers::getDataSeeker('seekers',$seeker_id,true);

        $message = "تمت عملية الشراء بنجاح، سوف نقوم بتمييز الشركة لمدة 20 يومًا بداءً من اليوم. ";
        return response()->json(['message' => $message]);

    }

    public function payCv(Request $request){
        $seeker_id = session('seeker_id');

        if(session('price') < 80000)
            return response()->json(['message' => "خطاء في اجراء العملية"]);



        DB::table('seekers')->where('seeker_id',$seeker_id)
            ->update([
                'allcv'=> 1,
                'allcvstartdate'=> Carbon::now(),
                'allcvenddate'=>  Carbon::now()->addDays(30),
            ]);

        DB::table('store_allcv')->insert([
            'seeker_store_id' =>$seeker_id,
            'seeker_id' =>$seeker_id,
            'price' => '80000',
            'createdate'=>Carbon::now(),
        ]);

        $priseAfterPay= session('price') - 80000;
        DB::table('seekers')->where('seeker_id',$seeker_id)->update([
            'price' => $priseAfterPay,
        ]);
        $date= date('Y-m-d');;
        $content =  "تم تفعيل خدمة مشاهدة كل السير الذاتية بنجاح"." ".$date;
        Helpers::AddNote($seeker_id,$content,3);

        Helpers::getDataSeeker('seekers',$seeker_id,true);

        $message = "تمت عملية الشراء بنجاح، ستتمكن من استخدام البحث المتخصص ورؤية كل السير الذاتية لمدة 30 يومًا بداءً من اليوم. ";
        return response()->json(['message' => $message]);

    }


    public  function showJob(){
        $seeker_id = session('seeker_id');

        $job = DB::table('job_description')
            ->select('desc_id','job_name')
            ->join('managers','managers.manager_id','=','job_description.manager_id')
            ->where('managers.seeker_id','=',$seeker_id)
            ->where('job_end','>=',Carbon::now())
            ->Where('starenddate','<=',Carbon::now())
             ->get();
        return view('seekers.store.buyjob')->with('job',$job);
    }
    public function payJob(Request $request){
        $seeker_id = session('seeker_id');
        $job=trim(strip_tags($request->input('job')));

        $job_desc = DB::table('job_description')->select('job_end')->where('desc_id',$job)->first();




        if($job_desc ==null || session('price') < 15000)
            return response()->json(['message' => "خطاء في اجراء العملية"]);

        $dateTable=$datePlus = Carbon::now()->addDays(10);

        if($job_desc->job_end >= $datePlus)
            $dateTable = $job_desc->job_end;

        DB::table('job_description')->where('desc_id',$job)
            ->update([
                'isstar'=>1,
                'starstartdate'=> Carbon::now(),
                'starenddate'=>  $datePlus,
                'job_end'=>  $dateTable,

            ]);


        DB::table('store_job')->insert([
             'seeker_id' =>$seeker_id,
            'price' => '15000',
            'job_id' => $job,
            'createdate'=>Carbon::now(),


        ]);

        $priseAfterPay= session('price') - 15000;
        DB::table('seekers')->where('seeker_id',$seeker_id)->update([
            'price' => $priseAfterPay,
        ]);
        $date= date('Y-m-d');;
        $content =  " تم تمييز الوظيفة الشاغرة بنجاح"." ".$date;
        Helpers::AddNote($seeker_id,$content,3);

        Helpers::getDataSeeker('seekers',$seeker_id,true);

        $message = "تمت عملية الشراء بنجاح، سيتم تمييز الوظيفة الشاغرة المختارة لمدة 10 أيام بداءً من اليوم. ";
        return response()->json(['message' => $message]);

    }

}