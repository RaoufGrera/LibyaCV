<?php

namespace App\Http\Controllers\Seekers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Helpers;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TrainingController extends Controller
{

    public function __construct()
    {
        $this->pageName = "train";

    }
    public function index()
    {

    }

    public function create()
    {
        return view('seekers.modal.add.atrain');

    }

    public function store(Request $request)
    {
        $id = session('seeker_id');

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

        $data =[
            "seeker_train" => $seeker_train,
        ];

        return  Helpers::showModal($this->pageName,$data,$message);
    }

    public function show($id)
    {

    }


    public function edit($id)
    {
        $seekers_id = session('seeker_id');

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

        return view('seekers.modal.edit.etrain')
            ->with('seeker_train',$seeker_train);
    }

    public function update(Request $request, $id)
    {
        $seekers_id = session('seeker_id');

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

        $data =[
            "seeker_train" => $seeker_train,
        ];

        return  Helpers::showModal($this->pageName,$data,$message);
    }

    public function destroy($id)
    {
        $seekers_id = session('seeker_id');

        DB::table('job_training')
            ->where('train_id',$id)
            ->where('seeker_id',$seekers_id)
            ->delete();

        $message = "";
        $seeker_train = Helpers::getDataSeeker('train',$seekers_id,true);

        $data =[
            "seeker_train" => $seeker_train,
        ];

        return  Helpers::showModal($this->pageName,$data,$message);
    }
}
