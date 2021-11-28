<?php

namespace App\Http\Controllers\Seekers;

use DB;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Helpers;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class EducationController extends Controller
{
    private $pageName;

    public function __construct()
    {
        $this->pageName = "ed";

    }

    public function index()
    {

    }

    public function create()
    {


        $ed_type = Helpers::getDataSeeker('job_edt',null,false);
        $domain_type = Helpers::getDataSeeker('job_domain',null,false);

         return view('seekers.modal.add.aed')
            ->with('ed_type',$ed_type)

            ->with('domain_type',$domain_type);
    }

    public function store(Request $request)
    {

        $id = session('seeker_id');

        $validator = Validator::make(Input::all(), [
            'dom_name' => 'required|exists:job_domain,domain_id|max:60',
            'ed_name' => 'required|exists:job_edt,edt_id',
            'univ' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        if ($validator->fails()) {
            $seeker_ed = Helpers::getDataSeeker('ed',$id,false);
            $data = ["seeker_ed" => $seeker_ed,];
            $message = "";
            return  Helpers::showModal($this->pageName,$data,$message);
        }

        $edt_id = trim(strip_tags($request->input('ed_name')));
        $dom_name = trim(strip_tags($request->input('dom_name')));
        $faculty = trim(strip_tags($request->input('faculty')));
        $specialty = trim(strip_tags($request->input('specialty')));
         $univ = trim(strip_tags($request->input('univ')));




        $faculty_id =$univ_id=$sed_id= null;


        if($univ !="") {

            $returnedData = Helpers::getRedis('univ', $univ);
            if ($returnedData != "empty") {
                $univ_id = $returnedData;
            } else {
                $returnedData = DB::table('univ')->select('univ_id')->where('univ_name', $univ)->first();
                if ($returnedData != null) {
                    $univ_id = $returnedData->univ_id;
                } else {
                    $univ_id = DB::table('univ')->insertGetId(['univ_name' => $univ]);
                    Helpers::setRedis('univ', $univ . "=" . $univ_id);
                }
            }
        }

        if($faculty !="") {
            $returnedData = Helpers::getRedis('faculty', $faculty);
            if ($returnedData != "empty") {
                $faculty_id = $returnedData;
            } else {
                $returnedData = DB::table('faculty')->select('faculty_id')->where('faculty_name',$faculty)->first();
                if ($returnedData != null) {
                    $faculty_id = $returnedData->faculty_id;
                }else{
                    $faculty_id = DB::table('faculty')->insertGetId(['faculty_name' => $faculty]);
                    Helpers::setRedis('faculty', $faculty . "=" . $faculty_id);
                }
            }
        }

        if($specialty !="") {

            $returnedData = Helpers::getRedis('spec_ed', $specialty);
            if ($returnedData != "empty") {
                $sed_id = $returnedData;
            } else {
                $returnedData = DB::table('spec_ed')->select('sed_id')->where('sed_name',$specialty)->first();
                if ($returnedData != null) {
                    $sed_id = $returnedData->sed_id;
                }else{
                    $sed_id = DB::table('spec_ed')->insertGetId(['sed_name' => $specialty]);
                    Helpers::setRedis('spec_ed', $specialty . "=" . $sed_id);
                }
            }
        }


        $avg_num = $request->input('avg_num');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $ed_DataTable = Helpers::getDataSeeker('ed',$id,false);



        DB::table('job_ed')->insert([
            'seeker_id' => $id,
            'edt_id' => $edt_id ,
            'domain_id' => $dom_name,
            'faculty_id' => $faculty_id,
            'univ_id' => $univ_id,
            'sed_id' => $sed_id,
            'avg' => $avg_num,
            'start_date' => $start_date,
            'end_date' => $end_date,
             'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);





        $seeker_ed = Helpers::getDataSeeker('ed',$id,true);

        $data = [
            "seeker_ed" => $seeker_ed,
        ];
        $message = "تمت العملية بنجاح.";

        return  Helpers::showModal($this->pageName,$data,$message);
    }

    public function show($id)
    {

    }


    public function edit($id)
    {
        $seekers_id = Session::get('seeker_id');


        $ed_type = Helpers::getDataSeeker('job_edt',null,false);
        $domain_type = Helpers::getDataSeeker('job_domain',null,false);
        $ed_DataTable = Helpers::getDataSeeker('ed',$seekers_id,false);

        $seeker_ed = null;
        if($ed_DataTable != null) {
            foreach ($ed_DataTable as $obj) {
                if ($obj->ed_id == $id) {
                    $seeker_ed = $obj;
                    break;
                }
            }
        }


        return view('seekers.modal.edit.eed')
            ->with('seeker_ed',$seeker_ed)
            ->with('ed_type',$ed_type)
            ->with('domain_type',$domain_type);
    }

    public function update(Request $request, $id)
    {


        $seekers_id = Session::get('seeker_id');

        $edt_id = trim(strip_tags($request->input('ed_name')));
        $dom_name = trim(strip_tags($request->input('dom_name')));
        $faculty = trim(strip_tags($request->input('faculty')));
        $univ = trim(strip_tags($request->input('univ')));
         $specialty = trim(strip_tags($request->input('specialty')));

        $avg_num = $request->input('avg_num');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');


        $univ_id = $faculty_id =  1;
        $sed_id =null;
      //  $faculty_id =$univ_id=$sed_id= null;

         $validator = Validator::make(Input::all(), [
            'dom_name' => 'required|exists:job_domain,domain_id|max:60',
            'ed_name' => 'required|exists:job_edt,edt_id',
            'univ' => 'required|max:90',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        if ($validator->fails()) {
            $seeker_ed = Helpers::getDataSeeker('ed',$seekers_id,true);
            $data = ["seeker_ed" => $seeker_ed,];
            $message = "";
            return  Helpers::showModal($this->pageName,$data,$message);
        }

        if($univ !="") {

            $returnedData = Helpers::getRedis('univ', $univ);
            if ($returnedData != "empty") {
                $univ_id = $returnedData;
            }
            else {
                    $returnedData = DB::table('univ')->select('univ_id')->where('univ_name',$univ)->first();
                    if ($returnedData != null) {
                        $univ_id = $returnedData->univ_id;
                    }else{
                        $univ_id = DB::table('univ')->insertGetId(['univ_name' => $univ]);
                        Helpers::setRedis('univ', $univ . "=" . $univ_id);
                    }
            }
        }

        if($faculty !="") {
            $returnedData = Helpers::getRedis('faculty', $faculty);
            if ($returnedData != "empty") {
                $faculty_id = $returnedData;
            } else {
               $returnedData = DB::table('faculty')->select('faculty_id')->where('faculty_name',$faculty)->first();
                if ($returnedData != null) {
                    $faculty_id = $returnedData->faculty_id;
                }else{
                $faculty_id = DB::table('faculty')->insertGetId(['faculty_name' => $faculty]);
                Helpers::setRedis('faculty', $faculty . "=" . $faculty_id);
                }
            }
        }

        if($specialty !="") {

            $returnedData = Helpers::getRedis('spec_ed', $specialty);
            if ($returnedData != "empty") {
                $sed_id = $returnedData;
            } else {
                $returnedData = DB::table('spec_ed')->select('sed_id')->where('sed_name',$specialty)->first();
                if ($returnedData != null) {
                    $sed_id = $returnedData->sed_id;
                }else{
                    $sed_id = DB::table('spec_ed')->insertGetId(['sed_name' => $specialty]);
                    Helpers::setRedis('spec_ed', $specialty . "=" . $sed_id);
                }
            }
        }



        $ed_DataTable = Helpers::getDataSeeker('ed',$seekers_id,false);

        $last = null;
        if($ed_DataTable != null) {
            foreach ($ed_DataTable as $obj) {
                if ($obj->ed_id == $id) {
                    $last = $obj;
                    break;
                }
            }
        }

        if ($last != null) {
            if (strtotime($last->updated_at) < strtotime('-10 second')) {



        DB::table('job_ed')
            ->where('ed_id', $id)
            ->where('seeker_id', $seekers_id)->update([
                'edt_id' => $edt_id,
                'domain_id' => $dom_name,
                'faculty_id' => $faculty_id,
                'univ_id' => $univ_id,
                'sed_id' => $sed_id,
                'avg' => $avg_num,
                'start_date' => $start_date,
                'end_date' => $end_date,
                 'updated_at' => \Carbon\Carbon::now(),
            ]);

            }else{
                DB::table('block_seeker')->insert([
                    'seeker_id' => $id,
                    'text' => 'اموقف الجافا سكربت ويجرب يحفظ أكثر من مره.',
                    'created_at' => \Carbon\Carbon::now(),
                ]);
            }
        }

        $seeker_ed = Helpers::getDataSeeker('ed',$seekers_id,true);

        $data = [
            "seeker_ed" => $seeker_ed,
        ];
        $message = "";

        return  Helpers::showModal($this->pageName,$data,$message);
    }

    public function destroy($id)
    {
        $seekers_id = Session::get('seeker_id');

        $id = trim($id);




        DB::table('job_ed')
            ->where('ed_id',$id)
            ->where('seeker_id',$seekers_id)
            ->delete();


        $seeker_ed = Helpers::getDataSeeker('ed',$seekers_id,true);

        $data = [
            "seeker_ed" => $seeker_ed,
        ];
        $message = "";

        return  Helpers::showModal($this->pageName,$data,$message);
    }
}
