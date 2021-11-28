<?php

namespace App\Http\Controllers\Api\Seeker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helpers;use DB;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $seekers_id = Auth::user()->seeker_id;

        $seeker_info = Helpers::getDataSeeker('info',$seekers_id,false);

        return response()->json(['info' => $seeker_info

        ], 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json(['info' => null
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
        $id = Auth::user()->seeker_id;
        $info_name = trim(strip_tags($request->input('info_name')));
        $info_date = trim(strip_tags($request->input('info_date')));
        $info_text = trim(strip_tags($request->input('info_text')));

        if (empty($info_name) || empty($info_date) || !is_numeric($info_date)) {
             return response()->json(['message'=>Helpers::getMessage("error")]
                , 200);
        }

        $ed_DataTable = Helpers::getDataSeeker('info',$id,false);



            DB::table('job_info')->insert([
                'seeker_id' => $id,
                'info_name' => $info_name,
                'info_date' => $info_date,
                'info_text' => $info_text,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);


         Helpers::getDataSeeker('info',$id,true);
        return response()->json(['message'=>Helpers::getMessage("saved")]
            , 200);

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
        $seekers_id = Auth::user()->seeker_id;
        $ed_DataTable = Helpers::getDataSeeker('info',$seekers_id,false);

        $seeker_info = null;
        if($ed_DataTable != null) {
            foreach ($ed_DataTable as $obj) {
                if ($obj->info_id == $id) {
                    $seeker_info = $obj;
                    break;
                }
            }
        }

        return response()->json(['info' => $seeker_info

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
        $seekers_id = Auth::user()->seeker_id;
        $info_name = trim(strip_tags($request->input('info_name')));
        $info_date = trim(strip_tags($request->input('info_date')));
        $info_text = trim(strip_tags($request->input('info_text')));

        if ($info_name =="" || empty($info_date) || !is_numeric($info_date)) {
            $message = "خطاء في الإدخال";
            $seeker_info = Helpers::getDataSeeker('info',$seekers_id,false);

            return response()->json(['message'=>Helpers::getMessage("error")]
                , 200);
        }

        DB::table('job_info')
            ->where('info_id', $id)
            ->where('seeker_id', $seekers_id)->update([
                'info_name' => $info_name,
                'info_date' => $info_date,
                'info_text' => $info_text,
            ]);
        Helpers::getDataSeeker('info',$seekers_id,true);

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
        $seekers_id = Auth::user()->seeker_id;
        DB::table('job_info')
            ->where('info_id', $id)
            ->where('seeker_id', $seekers_id)
            ->delete();

         Helpers::getDataSeeker('info',$seekers_id,true);

        return response()->json(['message'=>Helpers::getMessage("deleted")]
            , 200);

    }
}
