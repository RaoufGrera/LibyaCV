<?php

namespace App\Http\Controllers\Seekers;

use Illuminate\Http\Request;
use DB;
use View;
use Auth;
use App\Helpers;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HobbyController extends Controller
{

    private $pageName;

    public function __construct()
    {
        $this->pageName = "hobby";

    }

    public function index()
    {

    }

    public function create()
    {
      /*  $hobby = DB::table('hobby')->select('hobby_id','hobby_name')->get();

        foreach ($hobby as $item){
            Helpers::setRedis('hobby', $item->hobby_name . "*" . $item->hobby_id);

        }*/
        return view('seekers.modal.add.ahobby');

    }

    public function store(Request $request)
    {
        $id = session('seeker_id');

        $hobby_name = trim(strip_tags($request->input('hobby_name')));

        if($hobby_name!=""){
        $hobby_id=null;
        $returnedData = Helpers::getRedis('hobby', $hobby_name);
        if ($returnedData != "empty") {
            $hobby_id = $returnedData;
        } else {
            $item = DB::table('hobby')->select('hobby_id')->where('hobby_name', $hobby_name)->first();
            if ($item != null) {
                $hobby_id = $item->hobby_id;
            } else {
                $hobby_id = DB::table('hobby')->insertGetId(['hobby_name' => $hobby_name]);
                Helpers::setRedis('hobby', $hobby_name . "=" . $hobby_id);
            }
        }

        $hobby_DataTable = Helpers::getDataSeeker('hobby',$id,false);

     //   if(count($hobby_DataTable) <5){

                DB::table('job_hobby')->insert([
                    'seeker_id' => $id,
                    'hobby_id' => $hobby_id,
                ]);

        }
        $message = "";
        $seeker_hobby = Helpers::getDataSeeker('hobby',$id,true);


        $data =[
            "seeker_hobby" => $seeker_hobby,
        ];

         return  Helpers::showModal($this->pageName,$data,$message);
    }

    public function show($id)
    {

    }


    public function edit($id)
    {
        $seekers_id = session('seeker_id');

        $ed_DataTable = Helpers::getDataSeeker('hobby',$seekers_id,false);

        $seeker_hobby = null;
        if($ed_DataTable != null) {
            foreach ($ed_DataTable as $obj) {
                if ($obj->job_hobby_id == $id) {
                    $seeker_hobby = $obj;
                    break;
                }
            }
        }


        return view('seekers.modal.edit.ehobby')
            ->with('seeker_hobby',$seeker_hobby);
    }

    public function update(Request $request, $id)
    {
        $seekers_id = session('seeker_id');
        $hobby_name = trim(strip_tags($request->input('hobby_name')));

        if($hobby_name!="") {
            $hobby_id = null;
            $returnedData = Helpers::getRedis('hobby', $hobby_name);

            if ($returnedData != "empty") {
                $hobby_id = $returnedData;
            } else {
                $item = DB::table('hobby')->select('hobby_id')->where('hobby_name', $hobby_name)->first();
                if ($item != null) {
                    $hobby_id = $item->hobby_id;
                } else {
                    $hobby_id = DB::table('hobby')->insertGetId(['hobby_name' => $hobby_name]);
                    Helpers::setRedis('hobby', $hobby_name . "=" . $hobby_id);
                }
            }

            DB::table('job_hobby')
                ->where('seeker_id', $seekers_id)
                ->where('job_hobby_id', $id)
                ->update([
                    'hobby_id' => $hobby_id,
                ]);

        }

        $message ="تم التعديل بنجاح";


        $seeker_hobby = Helpers::getDataSeeker('hobby',$seekers_id,true);


        $data =[
            "seeker_hobby" => $seeker_hobby,
        ];
        return  Helpers::showModal($this->pageName,$data,$message);
    }

    public function destroy($id)
    {
        $seekers_id = session('seeker_id');

        DB::table('job_hobby')
            ->where('job_hobby_id',$id)
            ->where('seeker_id',$seekers_id)
            ->delete();

        $message = "";
        $seeker_hobby = Helpers::getDataSeeker('hobby',$seekers_id,true);


        $data =[
            "seeker_hobby" => $seeker_hobby,
        ];
        return  Helpers::showModal($this->pageName,$data,$message);
    }

}
