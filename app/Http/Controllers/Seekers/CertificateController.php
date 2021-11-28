<?php

namespace App\Http\Controllers\Seekers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Helpers;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CertificateController extends Controller
{
    private $pageName;


    public function __construct()
    {
        $this->pageName = "cert";

    }

    public function index()
    {

    }

    public function create()
    {
        $level = Helpers::getDataSeeker('job_level',null,false);
        return view('seekers.modal.add.acert')
            ->with('level',$level);
    }

    public function store(Request $request)
    {
        $id = session('seeker_id');
        $cert_name = $request->input('cert_name');
        $cert_date = $request->input('cert_date');

        if(!empty($cert_name) && !empty($cert_date) && $cert_date !="" && $cert_name!="") {

            $cert_id = null;
            $returnedData = Helpers::getRedis('cert', $cert_name);

            if ($returnedData != "empty") {
                $cert_id = $returnedData;
            } else {

                $item = DB::table('job_cert')->select('cert_id')->where('cert_name', $cert_name)->first();
                if ($item != null) {
                    $cert_id = $item->cert_id;
                } else {
                    $cert_id = DB::table('job_cert')->insertGetId(['cert_name' => $cert_name]);
                    Helpers::setRedis('cert', $cert_name . "=" . $cert_id);
                }
            }

            DB::table('job_certificate')->insert([
                'seeker_id' => $id,
                'cert_id' => $cert_id,
                'cert_date' => $cert_date
            ]);
        }
        $message = "";
        $seeker_cert = Helpers::getDataSeeker('cert',$id,true);
        $data =[
            "seeker_cert" => $seeker_cert,
        ];

        return  Helpers::showModal($this->pageName,$data,$message);
    }

    public function show($id)
    {

    }


    public function edit($id)
    {
        $seekers_id =session('seeker_id');


        $ed_DataTable = Helpers::getDataSeeker('cert',$seekers_id,false);

        $seeker_cert = null;
        if($ed_DataTable != null) {
            foreach ($ed_DataTable as $obj) {
                if ($obj->certificate_id == $id) {
                    $seeker_cert = $obj;
                    break;
                }
            }
        }


        return view('seekers.modal.edit.ecert')
            ->with('seeker_cert',$seeker_cert);
    }

    public function update(Request $request, $id)
    {
        $seekers_id =session('seeker_id');

        $cert_name = trim(strip_tags($request->input('cert_name')));
        $cert_date = $request->input('cert_date');


        if(empty($cert_name) || empty($cert_date)){

             $cert_id=null;
        $returnedData = Helpers::getRedis('cert', $cert_name);

        if ($returnedData != "empty") {
            $cert_id = $returnedData;
        } else {
            $item = DB::table('job_cert')->select('cert_id')->where('cert_name', $cert_name)->first();
            if ($item != null) {
                $cert_id = $item->cert_id;
            } else {
                $cert_id = DB::table('job_cert')->insertGetId(['cert_name' => $cert_name]);
                Helpers::setRedis('cert', $cert_name . "=" . $cert_id);
            }
        }
                DB::table('job_certificate')
                    ->where('seeker_id',$seekers_id)
                    ->where('certificate_id',$id)
                    ->update([
                        'cert_id' => $cert_id,
                        'cert_date' => $cert_date,
                    ]);


        }
        $message = "";
        $seeker_cert = Helpers::getDataSeeker('cert',$seekers_id,true);

        $data =[
            "seeker_cert" => $seeker_cert,
        ];
        return  Helpers::showModal($this->pageName,$data,$message);

    }

    public function destroy($id)
    {
        $seekers_id =session('seeker_id');

        DB::table('job_certificate')
            ->where('certificate_id',$id)
            ->where('seeker_id',$seekers_id)
            ->delete();

        $message = "";
        $seeker_cert = Helpers::getDataSeeker('cert',$seekers_id,true);

        $data =[
            "seeker_cert" => $seeker_cert,
        ];
        return  Helpers::showModal($this->pageName,$data,$message);
    }
}
