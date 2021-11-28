<?php

namespace App\Http\Controllers\Api\Seeker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helpers;use DB;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->seeker_id;

        $seeker_train = Helpers::getDataSeeker('train',$id,false);
        return response()->json(['training' => $seeker_train,], 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json(['training' => null,], 200);

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

        $train_name = $request->input('train_name');
        $train_comp = $request->input('train_comp');
        $train_date = $request->input('train_date');

        DB::table('job_training')->insert([
            'seeker_id' => $id,
            'train_name' => $train_name,
            'train_comp' => $train_comp,
            'train_date' => $train_date,
        ]);
        $message = "";
        $seeker_train = Helpers::getDataSeeker('train',$id,true);
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

        $ed_DataTable = Helpers::getDataSeeker('train',$seekers_id,false);

        $seeker_train = null;
        if($ed_DataTable != null) {
            foreach ($ed_DataTable as $obj) {
                if ($obj->train_id == $id) {
                    $seeker_train = $obj;
                    break;
                }
            }
        }

        return response()->json(['training' => $seeker_train,], 200);

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

        $train_name = $request->input('train_name');
        $train_comp = $request->input('train_comp');
        $train_date = $request->input('train_date');


        DB::table('job_training')
            ->where('train_id', $id)
            ->where('seeker_id', $seekers_id)->update([
                'train_name' => $train_name,
                'train_comp' => $train_comp,
                'train_date' => $train_date,
            ]);
        $message = "";
        $seeker_train = Helpers::getDataSeeker('train',$seekers_id,true);
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

        DB::table('job_training')
            ->where('train_id',$id)
            ->where('seeker_id',$seekers_id)
            ->delete();

        $message = "";
        $seeker_train = Helpers::getDataSeeker('train',$seekers_id,true);
        return response()->json(['message'=>Helpers::getMessage("deleted")]
            , 200);

    }
}
