<?php

namespace App\Http\Controllers\Api\Seeker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helpers;use DB;
class SpecialtyController extends Controller
{

    public function index()
    {
        $seekers_id =Auth::user()->seeker_id;
        $seeker_spec = Helpers::getDataSeeker('spec',$seekers_id,false);
        return response()->json(['specialty' => $seeker_spec], 200);

    }


    public function create()
    {

        return response()->json(['specialty' => null,], 200);
    }


    public function store(Request $request)
    {
        $id =Auth::user()->seeker_id;

        $spec = trim(strip_tags($request->input('spec_name')));
        if (!empty($spec) && $spec !="") {
            $returnedData = Helpers::getRedis('spec', $spec);

            if ($returnedData != "empty") {

                $spec_id = $returnedData;
                DB::table('spec_seeker')->insert([
                    'seeker_id' => $id,
                    'spec_id' => $spec_id,
                ]);
            } else {

                $item = DB::table('spec')->select('spec_id')->where('spec_name', $spec)->first();
                if ($item != null) {
                    $spec_id = $item->spec_id;
                    DB::table('spec_seeker')->insert([
                        'seeker_id' => $id,
                        'spec_id' => $spec_id,
                    ]);
                } else {
                    $spec_id = DB::table('spec')->insertGetId(['spec_name' => $spec]);

                    Helpers::setRedis('spec', $spec . "=" . $spec_id);

                    DB::table('spec_seeker')->insert([
                        'seeker_id' => $id,
                        'spec_id' => $spec_id,
                    ]);
                }

            }
        }
         Helpers::getDataSeeker('spec', $id, true);

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

        $ed_DataTable = Helpers::getDataSeeker('spec',$seekers_id,false);

        $seeker_spec = null;
        if($ed_DataTable != null) {
            foreach ($ed_DataTable as $obj) {
                if ($obj->spec_seeker_id == $id) {
                    $seeker_spec = $obj;
                    break;
                }
            }
        }

        return response()->json(['specialty' => $seeker_spec,


        ], 200);
    }


    public function update(Request $request, $id)
    {
        $seekers_id =Auth::user()->seeker_id;
        $spec = trim(strip_tags($request->input('spec_name')));

        if (!empty($spec) && $spec !="") {
            $returnedData = Helpers::getRedis('spec', $spec);
            if ($returnedData != "empty") {
                $spec_id = $returnedData;
                DB::table('spec_seeker')
                    ->where('spec_seeker_id', $id)
                    ->where('seeker_id', $seekers_id)
                    ->update([
                        'spec_id' => $spec_id,
                    ]);

            } else {

                $item = DB::table('spec')->select('spec_id')->where('spec_name', $spec)->first();
                if ($item != null) {
                    $spec_id = $item->spec_id;
                    DB::table('spec_seeker')
                        ->where('spec_seeker_id', $id)
                        ->where('seeker_id', $seekers_id)
                        ->update([
                            'spec_id' => $spec_id,
                        ]);
                } else {

                    $spec_id = DB::table('spec')->insertGetId(['spec_name' => $spec]);
                    Helpers::setRedis('spec', $spec . "=" . $spec_id);

                    DB::table('spec_seeker')
                        ->where('spec_seeker_id', $id)
                        ->where('seeker_id', $seekers_id)
                        ->update([
                            'spec_id' => $spec_id,
                        ]);
                }
            }
        }


        Helpers::getDataSeeker('spec', $seekers_id, true);
        return response()->json(['message'=>Helpers::getMessage("saved")]
            , 200);
    }


    public function destroy($id)
    {
        $seekers_id =Auth::user()->seeker_id;
        DB::table('spec_seeker')
            ->where('spec_seeker_id', $id)
            ->where('seeker_id', $seekers_id)
            ->delete();

  Helpers::getDataSeeker('spec',$seekers_id,true);
        return response()->json(['message'=>Helpers::getMessage("deleted")]
            , 200);

    }
}
