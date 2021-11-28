<?php

namespace App\Http\Controllers\Api\Seeker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helpers;
use DB;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seekers_id =Auth::user()->seeker_id;

        $seeker_exp = Helpers::getDataSeeker('exp',$seekers_id,false);
         return response()->json(['experience' => $seeker_exp], 200);
    }


    public function create()
    {
        //$seekers_id =Auth::user()->seeker_id;

      $domain_type = Helpers::getDataSeeker('job_domain',null,false);

        return response()->json(['experience' => null,
            'domain'=>$domain_type

        ], 200);
    }


    public function store(Request $request)
    {
        $id =Auth::user()->seeker_id;
        $exp_comp		=	 $request->input('exp_comp');

        $returnedData = Helpers::getRedis('comp_exp', $exp_comp);
        if ($returnedData != "empty") {
            $compe_id = $returnedData;
        }   else {
            $returnedData = DB::table('comp_exp')->select('compe_id')->where('compe_name',$exp_comp)->first();
            if ($returnedData != null) {
                $compe_id = $returnedData->compe_id;
            }else {
                $compe_id = DB::table('comp_exp')->insertGetId([
                    'compe_name' => $exp_comp,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
                Helpers::setRedis('comp_exp', $exp_comp . "=" . $compe_id);
            }
        }



        $domain_name			=	 $request->input('dom_id');
        $exp_name 		= 	 $request->input('exp_name');
        $exp_desc	 	= 	 $request->input('exp_desc');
        $start_date 	= 	$request->input('start_date');
        $end_date 	= 	$request->input('end_date');
        $state 	= 	$request->input('state');

        if($state == "1")
            $end_date = date("Y-m-d");


        $exp_DataTable = Helpers::getDataSeeker('exp',$id,false);

        $domainTable = Helpers::getDataSeeker('job_domain',null,false);
        $domain_id = "";
        foreach( $domainTable as $obj ) {
            if (  $obj->domain_name == $domain_name  ) {
                $domain_id = $obj->domain_id;
                break;
            }
        }


            DB::table('job_exp')->insert([
                'seeker_id' => $id,
                'compe_id' => $compe_id,
                'domain_id' => $domain_id,
                'exp_name' => $exp_name,
                'exp_desc' => $exp_desc,
                'state' => $state,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

    

         Helpers::getDataSeeker('exp',$id,true);
        return response()->json(['message'=>Helpers::getMessage("saved")]
            , 200);


    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $seekers_id =Auth::user()->seeker_id;
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


        return response()->json(['experience' => $seeker_exp,
             'domain'=>$domain_type

        ], 200);
    }


    public function update(Request $request, $id)
    {
        $seekers_id =Auth::user()->seeker_id;

        $exp_comp		=	$request->input('exp_comp');

        $returnedData = Helpers::getRedis('comp_exp', $exp_comp);
        if ($returnedData != "empty") {
            $compe_id = $returnedData;
        } else {
            $returnedData = DB::table('comp_exp')->select('compe_id')->where('compe_name', $exp_comp)->first();
            if ($returnedData != null) {
                $compe_id = $returnedData->compe_id;
            } else {
                $compe_id = DB::table('comp_exp')->insertGetId([
                    'compe_name' => $exp_comp,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
                Helpers::setRedis('comp_exp', $exp_comp . "=" . $compe_id);
            }
        }

        $dom_name			=	$request->input('dom_id');
        $exp_name 		= 	$request->input('exp_name');
        $exp_desc	 	= 	$request->input('exp_desc');
        $start_date 	= 	$request->input('start_date');
         $end_date 	= 	$request->input('end_date');
        $state 	= 	$request->input('state');
        if($state == "1")
            $end_date = date("y-m-d");


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

        $domainTable = Helpers::getDataSeeker('job_domain',null,false);
        $domain_id = "";
        foreach( $domainTable as $obj ) {
            if (  $obj->domain_name == $dom_name  ) {
                $domain_id = $obj->domain_id;
                break;
            }
        }



            if (strtotime($last->updated_at) < strtotime('-15 second')) {


                DB::table('job_exp')
                    ->where('exp_id', $id)
                    ->where('seeker_id', $seekers_id)->update([
                        'compe_id' => $compe_id ,
                        'domain_id' => $domain_id,
                        'exp_name' => $exp_name,
                        'exp_desc' => $exp_desc,
                        'state' => $state,
                        'start_date' => $start_date,
                        'end_date' => $end_date,
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);
            }



         Helpers::getDataSeeker('exp',$seekers_id,true);

        return response()->json(['message'=>Helpers::getMessage("saved")]
            , 200);

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

        DB::table('job_exp')
            ->where('exp_id',$id)
            ->where('seeker_id',$seekers_id)
            ->delete();
        Helpers::getDataSeeker('exp',$seekers_id,true);
        return response()->json(['message'=>Helpers::getMessage("saved")]
            , 200);

    }
}
