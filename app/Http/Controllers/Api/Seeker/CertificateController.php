<?php

namespace App\Http\Controllers\Api\Seeker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helpers;use DB;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seekers_id =Auth::user()->seeker_id;
        $seeker_cert = Helpers::getDataSeeker('cert',$seekers_id,false);
        return response()->json(['certificate' => $seeker_cert], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $level = Helpers::getDataSeeker('job_level',null,false);

        return response()->json(['certificate' => null,

        ], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id =Auth::user()->seeker_id;
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
         Helpers::getDataSeeker('cert',$id,true);
        return response()->json(['message' => Helpers::getMessage("saved")
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $seekers_id =Auth::user()->seeker_id;

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


        return response()->json(['certificate' => $seeker_cert
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $seekers_id =Auth::user()->seeker_id;

        $cert_name = trim(strip_tags($request->input('cert_name')));
        $cert_date = $request->input('cert_date');


        if(!empty($cert_name) && !empty($cert_date)){

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
            Helpers::getDataSeeker('cert',$seekers_id,true);
            return response()->json(['message' => Helpers::getMessage("saved")
            ], 200);

        }
        return response()->json(['message' => Helpers::getMessage("error")
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $seekers_id =Auth::user()->seeker_id;

        DB::table('job_certificate')
            ->where('certificate_id',$id)
            ->where('seeker_id',$seekers_id)
            ->delete();

         Helpers::getDataSeeker('cert',$seekers_id,true);
         return response()->json(['message' => Helpers::getMessage("deleted")
        ], 200);

    }
}
