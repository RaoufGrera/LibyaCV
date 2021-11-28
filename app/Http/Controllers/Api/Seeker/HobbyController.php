<?php

namespace App\Http\Controllers\Api\Seeker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helpers;
use DB;
class HobbyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $seekers_id =Auth::user()->seeker_id;

        $seeker_hobby = Helpers::getDataSeeker('hobby',$seekers_id,false);
         return response()->json(['hobby' => $seeker_hobby
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json(['hobby' => null,], 200);
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

            $hobby_DataTable = Helpers::getDataSeeker('hobby', $id, false);


                DB::table('job_hobby')->insert([
                    'seeker_id' => $id,
                    'hobby_id' => $hobby_id,
                ]);


        }
        Helpers::getDataSeeker('hobby',$id,true);
        return response()->json(['message' => "saved"
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

        return response()->json(['hobby' => $seeker_hobby
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
        $hobby_name = trim(strip_tags($request->input('hobby_name')));


        $hobby_id=null;
        if($hobby_name!="") {

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



         Helpers::getDataSeeker('hobby',$seekers_id,true);
        return response()->json(['message' => "saved"
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

        DB::table('job_hobby')
            ->where('job_hobby_id',$id)
            ->where('seeker_id',$seekers_id)
            ->delete();

      Helpers::getDataSeeker('hobby',$seekers_id,true);

        return response()->json(['message' => "deleted"
        ], 200);

    }
}
