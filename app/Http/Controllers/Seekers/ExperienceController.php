<?php

namespace App\Http\Controllers\Seekers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Helpers;
use  Session;
use Validator;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ExperienceController extends Controller
{
    private $pageName;

    public function __construct()
    {
        $this->pageName = "exp";

    }
    public function index()
    {

    }

    public function create()
    {

        $domain_type = Helpers::getDataSeeker('job_domain',null,false);
        return view('seekers.modal.add.aexp')
            ->with('domain_type',$domain_type);
    }

    public function store(Request $request)
    {
        //$trim_if_string = function ($var) { return is_string($var) ? trim($var) : $var; };
        //$request->merge(array_map($trim_if_string, $request->all()));

        $id =session('seeker_id');
        $exp_comp		=	 $request->input('exp_comp');

        $dom_id			=	 $request->input('dom_id');
        $exp_name 		= 	 $request->input('exp_name');
        $exp_desc	 	= 	 $request->input('exp_desc');
        $start_date_y 	= 	 $request->input('start_date_y');
        $start_date_m 	= 	 $request->input('start_date_m');
        $end_date_y 	= 	 $request->input('end_date_y');
        $end_date_m 	= 	 $request->input('end_date_m');
        $start_date		=	$start_date_y."-".$start_date_m."-"."01";
        if($end_date_y == "1"){
            $state ='1';
            $end_date = date("y-m-d");
        }
        else{
            $end_date		=  $end_date_y."-".$end_date_m ."-"."01";
            $state ='0';
        }

        $validator = Validator::make(Input::all(), [
            'dom_id' => 'required|exists:job_domain,domain_id',
             'exp_name' => 'required',
             'exp_comp' => 'required',
            'start_date_y' => 'required',
            'start_date_m' => 'required',
            'end_date_y' => 'required',
            'end_date_m' => 'required',
        ]);
        if ($validator->fails()) {
            $seeker_exp = Helpers::getDataSeeker('exp',$id,false);
            $data = ["seeker_exp" => $seeker_exp,];
            $message = "خطاء في الإدخال";
            return  Helpers::showModal($this->pageName,$data,$message);
        }

        $compe_id=null;
        $returnedData = Helpers::getRedis('comp_exp', $exp_comp);
        if ($returnedData != "empty") {
            $compe_id = $returnedData;
        } else {
            $item = DB::table('comp_exp')->select('compe_id')->where('compe_name', $exp_comp)->first();
            if ($item != null) {
                $compe_id = $item->compe_id;
            } else {
                $compe_id = DB::table('comp_exp')->insertGetId(['compe_name' => $exp_comp]);
                Helpers::setRedis('comp_exp', $exp_comp . "=" . $compe_id);
            }
        }

        $exp_DataTable = Helpers::getDataSeeker('exp',$id,false);




                     DB::table('job_exp')->insert([
                        'seeker_id' => $id,
                        'compe_id' => $compe_id,
                        'domain_id' => $dom_id,
                        'exp_name' => $exp_name,
                        'exp_desc' => $exp_desc,
                        'state' => $state,
                        'start_date' => $start_date,
                        'end_date' => $end_date,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);

                 $sum_exp = DB::table('job_exp')
                     ->select(DB::raw(" SUM(TIMESTAMPDIFF(month, job_exp.start_date,job_exp.end_date)) as sum_exp"))
                     ->where('seeker_id',$id)
                     ->first();

                 DB::table('seekers')->where('seeker_id',$id)->update([
                     'exp_sum' =>$sum_exp->sum_exp,
                 ]);
                 Session::put('exp_sum', $sum_exp->sum_exp);




        $seeker_exp = Helpers::getDataSeeker('exp',$id,true);

        $data = [
            "seeker_exp" => $seeker_exp,
        ];
        $message = "";

        return  Helpers::showModal($this->pageName,$data,$message);

    }

    public function show($id)
    {

    }


    public function edit($id)
    {
        $seekers_id = session('seeker_id');
        $domain_type = Helpers::getDataSeeker('job_domain',null,false);



        $ed_DataTable = Helpers::getDataSeeker('exp',$seekers_id,false);

        $seeker_exp = null;
        if($ed_DataTable != null) {
            foreach ($ed_DataTable as $obj) {
                if ($obj->exp_id == $id) {
                    $seeker_exp = $obj;
                    break;
                }
            }
        }
        return view('seekers.modal.edit.eexp')
            ->with('seeker_exp',$seeker_exp)
            ->with('domain_type',$domain_type);
    }

    public function update(Request $request, $id)
    {
        $seekers_id = session('seeker_id');
        $exp_comp		=	$request->input('exp_comp');
        $dom_id			=	$request->input('dom_id');
        $exp_name 		= 	$request->input('exp_name');
        $exp_desc	 	= 	$request->input('exp_desc');
        $start_date_y 	= 	$request->input('start_date_y');
        $start_date_m 	= 	$request->input('start_date_m');
        $end_date_y 	= 	$request->input('end_date_y');
        $end_date_m 	= 	$request->input('end_date_m');
        $start_date		=	$start_date_y."-".$start_date_m."-"."01";
        if($end_date_y == "1"){
            $state ='1';
            $end_date = date("Y-m-d");}
        else{
            $end_date	=  $end_date_y."-".$end_date_m ."-"."01";
            $state ='0';}

        $ed_DataTable = Helpers::getDataSeeker('exp',$seekers_id,false);

        $last = null;
        if($ed_DataTable != null) {
            foreach ($ed_DataTable as $obj) {
                if ($obj->exp_id == $id) {
                    $last = $obj;
                    break;
                }
            }
        }
        $compe_id=null;
        $returnedData = Helpers::getRedis('comp_exp', $exp_comp);
        if ($returnedData != "empty") {
            $compe_id = $returnedData;
        } else {
            $item = DB::table('comp_exp')->select('compe_id')->where('compe_name', $exp_comp)->first();
            if ($item != null) {
                $compe_id = $item->compe_id;
            } else {
                $compe_id = DB::table('comp_exp')->insertGetId(['compe_name' => $exp_comp]);
                Helpers::setRedis('comp_exp', $exp_comp . "=" . $compe_id);
            }
        }

        $validator = Validator::make(Input::all(), [
            'dom_id' => 'required|exists:job_domain,domain_id',
            'exp_name' => 'required',
            'exp_comp' => 'required',
            'start_date_y' => 'required',
            'start_date_m' => 'required',
            'end_date_y' => 'required',
            'end_date_m' => 'required',
        ]);
        if ($validator->fails()) {
            $seeker_exp = Helpers::getDataSeeker('exp',$id,false);
            $data = ["seeker_exp" => $seeker_exp,];
            $message = "خطاء في الإدخال";
            return  Helpers::showModal($this->pageName,$data,$message);
        }
        if ($last != null) {
            if (strtotime($last->updated_at) < strtotime('-15 second')) {


        DB::table('job_exp')
            ->where('exp_id', $id)
            ->where('seeker_id', $seekers_id)->update([
                'compe_id' => $compe_id ,
                'domain_id' => $dom_id,
                'exp_name' => $exp_name,
                'exp_desc' => $exp_desc,
                'state' => $state,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'updated_at' => \Carbon\Carbon::now(),
            ]);
                $sum_exp = DB::table('job_exp')
                    ->select(DB::raw(" SUM(TIMESTAMPDIFF(month, job_exp.start_date,job_exp.end_date)) as sum_exp"))
                    ->where('seeker_id',$seekers_id)
                    ->first();

                DB::table('seekers')->where('seeker_id',$seekers_id)->update([
                    'exp_sum' =>$sum_exp->sum_exp,
                ]);
                 Session::put('exp_sum', $sum_exp->sum_exp);



            }
            }


        $seeker_exp = Helpers::getDataSeeker('exp',$seekers_id,true);
        $data = [
            "seeker_exp" => $seeker_exp,
        ];
        $message = "";

        return  Helpers::showModal($this->pageName,$data,$message);
    }

    public function destroy($id)
    {
        $seekers_id = session('seeker_id');

        DB::table('job_exp')
            ->where('exp_id',$id)
            ->where('seeker_id',$seekers_id)
            ->delete();


        $seeker_exp = Helpers::getDataSeeker('exp',$seekers_id,true);
        $sum_exp = DB::table('job_exp')
            ->select(DB::raw(" SUM(TIMESTAMPDIFF(month, job_exp.start_date,job_exp.end_date)) as sum_exp"))
            ->where('seeker_id',$seekers_id)
            ->first();

        DB::table('seekers')->where('seeker_id',$seekers_id)->update([
            'exp_sum' =>$sum_exp->sum_exp,
        ]);
        Session::put('exp_sum', $sum_exp->sum_exp);

        $data = [
            "seeker_exp" => $seeker_exp,
        ];
        $message = "";

        return  Helpers::showModal($this->pageName,$data,$message);
    }
}
