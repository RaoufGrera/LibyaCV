<?php

namespace App\Http\Controllers\Seekers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Helpers;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class InfoController extends Controller
{
    private $pageName;

    public function __construct()
    {
        $this->pageName = "info";
        $this->middleware('guest', ['except' => ['logout', 'getLogout']]);
    }

    public function index()
    {
        //

    }

    public function create()
    {

        return view('seekers.modal.add.ainfo');

    }

    public function store(Request $request)
    {
        //
        $id = session('seeker_id');
        $info_name = trim(strip_tags($request->input('info_name')));
        $info_date = trim(strip_tags($request->input('info_date')));
        $info_text = trim(strip_tags($request->input('info_text')));

        if (empty($info_name) || empty($info_date) || !is_numeric($info_date)) {
            $message = "خطاء في الإدخال";
            $seeker_info = Helpers::getDataSeeker($this->pageName,$id,false);

            $data =[
                "seeker_info" => $seeker_info,
            ];

            return  Helpers::showModal($this->pageName,$data,$message);
        }

        $ed_DataTable = Helpers::getDataSeeker($this->pageName,$id,false);


        DB::table('job_info')->insert([
            'seeker_id' => $id,
            'info_name' => $info_name,
            'info_date' => $info_date,
            'info_text' => $info_text,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);


        $message = "";
        $seeker_info = Helpers::getDataSeeker($this->pageName,$id,true);

        $data =[
            "seeker_info" => $seeker_info,
        ];

        return  Helpers::showModal($this->pageName,$data,$message);
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
        $seekers_id = session('seeker_id');

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

        return view('seekers.modal.edit.einfo')
            ->with('seeker_info', $seeker_info);
    }

    public function update(Request $request, $id)
    {
        //

        $seekers_id = session('seeker_id');

        $info_name = trim(strip_tags($request->input('info_name')));
        $info_date = trim(strip_tags($request->input('info_date')));
        $info_text = trim(strip_tags($request->input('info_text')));

        if (empty($info_name) || empty($info_date) || !is_numeric($info_date)) {
            $message = "خطاء في الإدخال";
            $seeker_info = Helpers::getDataSeeker($this->pageName,$seekers_id,false);

            $data =[
                "seeker_info" => $seeker_info,
            ];

            return  Helpers::showModal($this->pageName,$data,$message);
        }

        DB::table('job_info')
            ->where('info_id', $id)
            ->where('seeker_id', $seekers_id)->update([
                'info_name' => $info_name,
                'info_date' => $info_date,
                'info_text' => $info_text,
            ]);
        $message = "";
        $seeker_info = Helpers::getDataSeeker($this->pageName,$seekers_id,true);

        $data =[
            "seeker_info" => $seeker_info,
        ];

        return  Helpers::showModal($this->pageName,$data,$message);
    }

    public function destroy($id)
    {
        //
        $seekers_id = session('seeker_id');

        DB::table('job_info')
            ->where('info_id', $id)
            ->where('seeker_id', $seekers_id)
            ->delete();

        $message = "";
        $seeker_info = Helpers::getDataSeeker($this->pageName,$seekers_id,true);

        $data =[
            "seeker_info" => $seeker_info,
        ];

        return  Helpers::showModal($this->pageName,$data,$message);
    }
}
