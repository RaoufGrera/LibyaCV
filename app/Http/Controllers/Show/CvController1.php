<?php

namespace App\Http\Controllers\Show;
use App\Notifications\NewNoification;
use App\Seeker;
use Auth;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Helpers;
use App\Http\Controllers\Controller;
use Notifications;

class CvController extends Controller
{
    //
    public function index($user_name){

        if(empty( session('seeker_id'))){


            if(!empty($_GET['request'])){ $request = (int) $_GET['request']; }else{ $request =1; }



            $FindID = DB::table('seekers')->select('seeker_id')->where('user_name',$user_name)->first();//  Helpers::searchRedis('username', $user_name);
            $id = $FindID->seeker_id;

            $job_seeker = Helpers::getDataSeeker('seekers',$id,false);


            if($job_seeker->hide_cv == "0" ){






                    DB::table('seekers')->where('seeker_id',$id)->increment('see_it', 1);//->update(['see_it'=> +3]);


                $isNew= false;

                $seeker_ed = Helpers::getDataSeeker('ed',$id,$isNew);
                $seeker_exp = Helpers::getDataSeeker('exp',$id,$isNew);
                $seeker_lang = Helpers::getDataSeeker('lang',$id,$isNew);
                $seeker_skills = Helpers::getDataSeeker('skills',$id,$isNew);
                $seeker_cert = Helpers::getDataSeeker('cert',$id,$isNew);
                $seeker_train = Helpers::getDataSeeker('train',$id,$isNew);
                $seeker_hobby = Helpers::getDataSeeker('hobby',$id,$isNew);
                $seeker_info = Helpers::getDataSeeker('info',$id,$isNew);


                //  $myCompany = Helpers::getDataSeeker('company',$id,$isNew);
                $seeker_spec = Helpers::getDataSeeker('spec',$id,$isNew);
            }else{
                $seeker_ed=$seeker_exp=$seeker_lang=$seeker_skills=$seeker_cert=$status=$followers=null;
                $seeker_train=$seeker_hobby=$seeker_info=$seeker_spec=$spec_firend=null;
            }
            return view('show.cv_visit')
                //  ->with('myCompany',$myCompany)
                ->with('id',$id)
                ->with('status',null)
                ->with('followers',null)
                ->with('spec_firend',null)
                ->with('user_name',$user_name)
                ->with('job_seeker',$job_seeker)
                ->with('seeker_ed',$seeker_ed)
                ->with('seeker_exp',$seeker_exp)
                ->with('seeker_spec',$seeker_spec)
                ->with('seeker_lang',$seeker_lang)
                ->with('seeker_skills',$seeker_skills)
                ->with('seeker_cert',$seeker_cert)
                ->with('seeker_train',$seeker_train)
                ->with('seeker_hobby',$seeker_hobby)
                ->with('IsEmp',0)

                ->with('seeker_info',$seeker_info);
        }
        $seeker_show_id = session('seeker_id');

        if(!empty($_GET['request'])){ $request = (int) $_GET['request']; }else{ $request =1; }


    //    $returnedData = Helpers::searchRedis('usernameNew', $user_name);

        $FindID = DB::table('seekers')->select('seeker_id')->where('user_name',$user_name)->first();//  Helpers::searchRedis('username', $user_name);
        $id = $FindID->seeker_id;

        $job_seeker = Helpers::getDataSeeker('seekers',$id,true);

        $objDesc = DB::table('job_seeker_req')
            ->select('req_id','see')
            ->where('seeker_id',$job_seeker->seeker_id)
            ->where('req_id',$request)
            ->first();

        $IsEmp = false;
        if($objDesc){
            $IsEmp=true;
            if($objDesc->see == 0){

            DB::table('job_seeker_req')
                ->where('seeker_id',$job_seeker->seeker_id)
                ->where('req_id',$request)
                ->update([
                    'see'=>1
                ]);

                }
        }
        if($job_seeker->hide_cv == "0" || $objDesc){
        $status = 1;
        $spec_firend[] = 2;
        $FirstIRequestTable = null;
        $followers = DB::table('followers_seeker')
            ->where('followers_seeker_id',$seeker_show_id)
            ->where('seeker_id',$id)
            ->first();
        if($user_name !=  session('user_name')){






                $spec_firend = DB::table('firend_spec')
                 ->select('firend_spec_id')
                ->where('firend_id',$seeker_show_id)
                ->where('seeker_id',$id)

                ->get();


             $data = array_map(function ($item) {
                return (array)$item;
            }, $spec_firend->ToArray());

                $array[] = ['0'];
            foreach($data as   $value){
                foreach($value as $key => $item){
                    $array[]  = $item;
                }
            }
                $spec_firend = $array;

            /*
             * This is for see it how many peple visit this page
             * it is saved them in table seeker_show
             * */




            $randNum = rand(1,30);
            if($randNum  > 25){
            DB::table('seeker_show')->insert([
                'seeker_show_id' => $seeker_show_id,
                'seeker_id' => $id,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
            }

                DB::table('seekers')->where('seeker_id',$id)->increment('see_it', 1);//->update(['see_it'=> +3]);

    }
        $isNew= false;

        $seeker_ed = Helpers::getDataSeeker('ed',$id,$isNew);
        $seeker_exp = Helpers::getDataSeeker('exp',$id,$isNew);
        $seeker_lang = Helpers::getDataSeeker('lang',$id,$isNew);
        $seeker_skills = Helpers::getDataSeeker('skills',$id,$isNew);
        $seeker_cert = Helpers::getDataSeeker('cert',$id,$isNew);
        $seeker_train = Helpers::getDataSeeker('train',$id,$isNew);
        $seeker_hobby = Helpers::getDataSeeker('hobby',$id,$isNew);
        $seeker_info = Helpers::getDataSeeker('info',$id,$isNew);


      //  $myCompany = Helpers::getDataSeeker('company',$id,$isNew);
        $seeker_spec = Helpers::getDataSeeker('spec',$id,$isNew);
        }else{
            $seeker_ed=$seeker_exp=$seeker_lang=$seeker_skills=$seeker_cert=$status=$followers=null;
            $seeker_train=$seeker_hobby=$seeker_info=$seeker_spec=$spec_firend=null;
        }
        return view('show.cv')
          //  ->with('myCompany',$myCompany)
            ->with('id',$id)
            ->with('status',$status)
            ->with('followers',$followers)
             ->with('spec_firend',$spec_firend)
            ->with('user_name',$user_name)
            ->with('job_seeker',$job_seeker)
            ->with('seeker_ed',$seeker_ed)
            ->with('seeker_exp',$seeker_exp)
            ->with('seeker_spec',$seeker_spec)
            ->with('seeker_lang',$seeker_lang)
            ->with('seeker_skills',$seeker_skills)
            ->with('seeker_cert',$seeker_cert)
            ->with('seeker_train',$seeker_train)
            ->with('seeker_hobby',$seeker_hobby)
            ->with('IsEmp',$IsEmp)

            ->with('seeker_info',$seeker_info);
    }
    public function index_visit($user_name){


        if(!empty($_GET['request'])){ $request = (int) $_GET['request']; }else{ $request =1; }



        $FindID = DB::table('seekers')->select('seeker_id')->where('user_name',$user_name)->first();//  Helpers::searchRedis('username', $user_name);
        $id = $FindID->seeker_id;

        $job_seeker = Helpers::getDataSeeker('seekers',$id,false);


        if($job_seeker->hide_cv == "0" ){






            $randNum = rand(1,30);


                DB::table('seekers')->where('seeker_id',$id)->increment('see_it', 1);//->update(['see_it'=> +3]);


        $isNew= false;

        $seeker_ed = Helpers::getDataSeeker('ed',$id,$isNew);
        $seeker_exp = Helpers::getDataSeeker('exp',$id,$isNew);
        $seeker_lang = Helpers::getDataSeeker('lang',$id,$isNew);
        $seeker_skills = Helpers::getDataSeeker('skills',$id,$isNew);
        $seeker_cert = Helpers::getDataSeeker('cert',$id,$isNew);
        $seeker_train = Helpers::getDataSeeker('train',$id,$isNew);
        $seeker_hobby = Helpers::getDataSeeker('hobby',$id,$isNew);
        $seeker_info = Helpers::getDataSeeker('info',$id,$isNew);


      //  $myCompany = Helpers::getDataSeeker('company',$id,$isNew);
        $seeker_spec = Helpers::getDataSeeker('spec',$id,$isNew);
        }else{
            $seeker_ed=$seeker_exp=$seeker_lang=$seeker_skills=$seeker_cert=$status=$followers=null;
            $seeker_train=$seeker_hobby=$seeker_info=$seeker_spec=$spec_firend=null;
        }
        return view('show.cv_visit')
          //  ->with('myCompany',$myCompany)
            ->with('id',$id)
            ->with('status',null)
            ->with('followers',null)
             ->with('spec_firend',null)
            ->with('user_name',$user_name)
            ->with('job_seeker',$job_seeker)
            ->with('seeker_ed',$seeker_ed)
            ->with('seeker_exp',$seeker_exp)
            ->with('seeker_spec',$seeker_spec)
            ->with('seeker_lang',$seeker_lang)
            ->with('seeker_skills',$seeker_skills)
            ->with('seeker_cert',$seeker_cert)
            ->with('seeker_train',$seeker_train)
            ->with('seeker_hobby',$seeker_hobby)
            ->with('IsEmp',0)

            ->with('seeker_info',$seeker_info);
    }

    public function firends(Request $request,$user_name){


        $id_user = DB::table('seekers')->select('seeker_id')
            ->where('seekers.user_name', '=', $user_name)->first();
        $id = $id_user->seeker_id;

        $seeker_id = session('seeker_id');
        $ch = false;
        $lastReq = DB::table('followers_seeker')
            ->where('followers_seeker_id', $seeker_id)
            ->where('seeker_id', $id)
            ->first();
        if($lastReq != null) {
            if (strtotime($lastReq->create_date) < strtotime('-59 second')) {
                DB::table('followers_seeker')
                    ->where('seeker_id', $id)
                    ->where('followers_seeker_id', $seeker_id)
                    ->delete();
            } else {
                return response()->json([
                    'count' => 'e',
                    'check' => true,
                ]);
            }


        }else{
        DB::table('followers_seeker')->insert([
            'followers_seeker_id' => $seeker_id,
            'seeker_id' => $id,

            'create_date' => \Carbon\Carbon::now(),
        ]);


            $ch = true;
            $name = session('fname')." ".session("lname");
            $user=session('user_name');
            $date= date('Y-m-d');
            $content = $name." (".$user.") "."  قام بمتابعتك"." ".$date;
            Helpers::AddNote($id,$content,1);

        }
        $req_count = DB::table('followers_seeker')
             ->where('seeker_id', $id)
            ->count();




        return response()->json([
            'check' => $ch,
            'requests' =>$req_count,
        ]);



    }

    public function unfirends($user_name){
        $req_firend_id = session('seeker_id');
      //  $id = Helpers::searchRedis('username', $user_name);
        $FindID = DB::table('seekers')->select('seeker_id')->where('user_name',$user_name)->first();//  Helpers::searchRedis('username', $user_name);
        $id = $FindID->seeker_id;
        DB::table('firends')
            ->where('seeker_id', $id)
            ->where('req_firend_id', $req_firend_id)
            ->delete();

        DB::table('firends')
            ->where('seeker_id', $req_firend_id)
            ->where('req_firend_id', $id)
            ->delete();

        Helpers::getDataSeeker('firends',$req_firend_id,true);
        Helpers::getDataSeeker('firends',$id,true);
        Helpers::getDataSeeker('spec',$id,true);
        Helpers::getDataSeeker('spec',$req_firend_id,true);

        return redirect()->back();


    }

    public function plusSpec($user_name,$spec_id){
        $seeker_id = session('seeker_id');

        //$id = Helpers::searchRedis('username', $user_name);
        $FindID = DB::table('seekers')->select('seeker_id')->where('user_name',$user_name)->first();//  Helpers::searchRedis('username', $user_name);
        $id = $FindID->seeker_id;


        $isDelete = false;
        $isAdd= false;


            $check =  DB::table('firend_spec')
                ->where('firend_id',$seeker_id)
                ->where('seeker_id',$id)
                ->where('firend_spec_id',$spec_id)
                 ->first();


            if($check == null){
                DB::table('firend_spec')->insert([
                    'firend_spec_id' => $spec_id,
                    'firend_id' => $seeker_id,
                    'seeker_id' => $id,
                    'created_at' => \Carbon\Carbon::now(),
                ]);
                $isAdd= true;


                $name = session('fname')." ".session("lname");
                $user=session('user_name');
                $date= date('Y-m-d');;
                $content = $name." (".$user.") "."  قام بالمصادقة علي احد تخصصاتك"." ".$date;
                Helpers::AddNote($id,$content,2);

            }else if($check != null){

                    if (strtotime($check->created_at) < strtotime('-59 second')) {
                        DB::table('firend_spec')
                            ->where('firend_id', $seeker_id)
                            ->where('seeker_id', $id)
                            ->where('firend_spec_id', $spec_id)
                            ->delete();
                        $isDelete=true;
                    }else{
                        return response()->json([
                            'count' => 'e',
                            'check' => true,
                        ]);
                    }
            }


            if($isDelete == true || $isAdd ==true)
                $seeker_spec = Helpers::getDataSeeker('spec',$id,true);
            else
                $seeker_spec = Helpers::getDataSeeker('spec',$id,false);

            $specValue = null;
            $countSpec=0;
            if($seeker_spec != null) {
                foreach ($seeker_spec as $obj) {
                    if ($obj->firend_spec_id == $spec_id) {
                        $countSpec =$obj->spec_count ;
                        break;
                    }
                }
            }


            if($isDelete == false)
                $ch = true;
            else
                $ch = false;

            return response()->json([
                'count' => $countSpec,
                'check' => $ch,
            ]);

    }

    public function showSpec($user_name,$spec_id){



        $myfirends = DB::table('seekers')
            ->select('user_name','fname','lname','image','code_image','gender')
            ->join('firend_spec','firend_spec.firend_id','=','seekers.seeker_id')
            ->where('firend_spec_id','=',$spec_id)
            ->get();


        return view('show.showspec')
            ->with('myfirends',$myfirends);

    }

}
