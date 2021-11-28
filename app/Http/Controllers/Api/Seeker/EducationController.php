<?php

namespace App\Http\Controllers\Api\Seeker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use Validator;
use Illuminate\Support\Facades\Input;

use App\Helpers;

class EducationController extends Controller
{

    public function index()
    {

        $seekers_id =Auth::user()->seeker_id;
        $seekers_id =Auth::guard('api')->user()->seeker_id;
        $seeker_ed = Helpers::getDataSeeker('ed',$seekers_id,false);
        return response()->json(['education' => $seeker_ed], 200);
    }

    public function create()
    {


        $ed_type = Helpers::getDataSeeker('job_edt',null,false);
        $domain_type = Helpers::getDataSeeker('job_domain',null,false);

        return response()->json(['education' => null,
            'ed_type'=>$ed_type,
            'domain'=>$domain_type
        ], 200);
    }


    public function store(Request $request)
    {
        $id =Auth::user()->seeker_id;

        $validator = Validator::make(Input::all(), [
            'dom_name' => 'required|exists:job_domain,domain_name|max:255',
            'ed_name' => 'required|exists:job_edt,edt_name',
            'univ' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message'=>Helpers::getMessage("error")]
                , 200);
        }

        $edt_name = trim(strip_tags($request->input('ed_name')));
        $domain_name = trim(strip_tags($request->input('dom_name')));
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
                $returnedData = DB::table('faculty')->select('faculty_id')->where('faculty_name', $faculty)->first();
                if ($returnedData != null) {
                    $faculty_id = $returnedData->faculty_id;
                } else {
                    $faculty_id = DB::table('faculty')->insertGetId(['faculty_name' => $faculty]);
                    Helpers::setRedis('faculty', $faculty . "=" . $faculty_id);
                }
            }
        }

        if($specialty != ""){
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

        $domainTable = Helpers::getDataSeeker('job_domain',null,false);
        $domain_id = "";
        foreach( $domainTable as $obj ) {
            if (  $obj->domain_name == $domain_name  ) {
                $domain_id = $obj->domain_id;
                break;
            }
        }

        $edtTable = Helpers::getDataSeeker('job_edt',null,false);
        $edt_id = "";
        foreach( $edtTable as $obj ) {
            if (  $obj->edt_name == $edt_name  ) {
                $edt_id = $obj->edt_id;
                break;
            }
        }



        $avg_num = $request->input('avg_num');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $ed_DataTable = Helpers::getDataSeeker('ed',$id,false);


             DB::table('job_ed')->insert([
                'seeker_id' => $id,
                'edt_id' => $edt_id ,
                'domain_id' => $domain_id,
                'faculty_id' => $faculty_id,
                'univ_id' => $univ_id,
                'sed_id' => $sed_id,
                'avg' => $avg_num,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);




          Helpers::getDataSeeker('ed',$id,true);

        return response()->json(['message'=>Helpers::getMessage("saved")], 200);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $seekers_id =Auth::user()->seeker_id;
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

        return response()->json(['education' => $seeker_ed,
            'ed_type'=>$ed_type,
            'domain'=>$domain_type

        ], 200);
    }

    function update(Request $request,$id)
    {
        $seekers_id =Auth::user()->seeker_id;

        $edt_name = $request->input('ed_name');
        $domain_name = $request->input('dom_name');
        $faculty = $request->input('faculty');
         $univ = $request->input('univ');


        $specialty = trim(strip_tags($request->input('specialty')));

        $univ_id = $faculty_id =  1;
        $sed_id =null;
        //  $faculty_id =$univ_id=$sed_id= null;



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

        $avg_num = $request->input('avg_num');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');



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

        $domainTable = Helpers::getDataSeeker('job_domain',null,false);
        $domain_id = "";
        foreach( $domainTable as $obj ) {
            if (  $obj->domain_name == $domain_name  ) {
                $domain_id = $obj->domain_id;
                break;
            }
        }

        $edtTable = Helpers::getDataSeeker('job_edt',null,false);
        $edt_id = "";
        foreach( $edtTable as $obj ) {
            if (  $obj->edt_name == $edt_name  ) {
                $edt_id = $obj->edt_id;
                break;
            }
        }



            if (strtotime($last->updated_at) < strtotime('-10 second')) {

                DB::table('job_ed')
                    ->where('ed_id', $id)
                    ->where('seeker_id', $seekers_id)->update([
                        'edt_id' => $edt_id,
                        'domain_id' => $domain_id,
                        'faculty_id' => $faculty_id,
                        'univ_id' => $univ_id,
                        'sed_id' => $sed_id,
                        'avg' => $avg_num,
                        'start_date' => $start_date,
                        'end_date' => $end_date,
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);
            }else{
                return response()->json(['message'=>Helpers::getMessage("error")]
                    , 200);
            }


        $seeker_ed = Helpers::getDataSeeker('ed',$seekers_id,true);


        return response()->json(['message'=>Helpers::getMessage("saved")]
            , 200);
    }

    public function destroy($id)
    {

        $seekers_id =Auth::user()->seeker_id;

        $id = trim($id);
        DB::table('job_ed')
            ->where('ed_id',$id)
            ->where('seeker_id',$seekers_id)
            ->delete();

        $seeker_ed = Helpers::getDataSeeker('ed',$seekers_id,true);
        return response()->json(['message'=>Helpers::getMessage("deleted")]
            , 200);
    }
}
