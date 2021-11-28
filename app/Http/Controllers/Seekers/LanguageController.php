<?php

namespace App\Http\Controllers\Seekers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use App\Helpers;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    private $pageName;

    public function __construct()
    {
        $this->pageName = "lang";

    }

    public function index()
    {

    }

    public function create()
    {

        $lang = Helpers::getDataSeeker('job_lang',null,false);
        $level = Helpers::getDataSeeker('job_level',null,false);

        return view('seekers.modal.add.alang')
            ->with('lang',$lang)
            ->with('level',$level);
    }

    public function store(Request $request)
    {
        $id = session('seeker_id');
        $lang_id = $request->input('lang_id');
        $level_id = $request->input('level_id');
        $CheckTable = Helpers::getDataSeeker('job_lang',null,false);

        $langExist = false;
        if($CheckTable != null) {
            foreach ($CheckTable as $obj) {
                if ($obj->lang_id == $lang_id) {
                    $langExist = true;
                    break;
                }
            }
        }
        $CheckTable = Helpers::getDataSeeker('job_level',null,false);

        $levelExist = false;
        if($CheckTable != null) {
            foreach ($CheckTable as $obj) {
                if ($obj->level_id == $level_id) {
                    $levelExist = true;
                    break;
                }
            }
        }


        $ed_DataTable = Helpers::getDataSeeker('lang',$id,false);

        $check = null;
        if($ed_DataTable != null) {
            foreach ($ed_DataTable as $obj) {
                if ($obj->lang_id == $lang_id) {
                    $check = $obj;
                    break;
                }
            }
        }

        if( $check ==null &&($levelExist && $langExist)){
        DB::table('job_lang_seeker')->insert([
            'seeker_id' => $id,
            'lang_id' => $lang_id ,
            'level_id' => $level_id,
        ]);
        }else{
        $message = "خطاء في الإدخال";
        $seeker_lang = Helpers::getDataSeeker($this->pageName,$id,false);
        $data =[
        "seeker_lang" => $seeker_lang,
        ];

        return  Helpers::showModal($this->pageName,$data,$message);
        }
        $message = "";
        $seeker_lang = Helpers::getDataSeeker($this->pageName,$id,true);
        $data =[
            "seeker_lang" => $seeker_lang,
        ];

        return  Helpers::showModal($this->pageName,$data,$message);
    }

    public function show($id)
    {

    }


    public function edit($id)
    {
        $seekers_id = session('seeker_id');
        $lang = Helpers::getDataSeeker('job_lang',null,false);
        $level = Helpers::getDataSeeker('job_level',null,false);


        $ed_DataTable = Helpers::getDataSeeker('lang',$seekers_id,false);

        $seeker_lang = null;
        if($ed_DataTable != null) {
            foreach ($ed_DataTable as $obj) {
                if ($obj->job_lang_id == $id) {
                    $seeker_lang = $obj;
                    break;
                }
            }
        }



        return view('seekers.modal.edit.elang')
            ->with('seeker_lang',$seeker_lang)
            ->with('lang',$lang)
            ->with('level',$level);
    }

    public function update(Request $request, $id)
    {
        $seekers_id = session('seeker_id');

        $lang_id = $request->input('lang_id');
        $level_id = $request->input('level_id');
        $CheckTable = Helpers::getDataSeeker('job_lang',null,false);

        $langExist = false;
        if($CheckTable != null) {
            foreach ($CheckTable as $obj) {
                if ($obj->lang_id == $lang_id) {
                    $langExist = true;
                    break;
                }
            }
        }
        $CheckTable = Helpers::getDataSeeker('job_level',null,false);

        $levelExist = false;
        if($CheckTable != null) {
            foreach ($CheckTable as $obj) {
                if ($obj->level_id == $level_id) {
                    $levelExist = true;
                    break;
                }
            }
        }



        $ed_DataTable = Helpers::getDataSeeker('lang',$seekers_id,false);

        $check = null;
        if($ed_DataTable != null) {
            foreach ($ed_DataTable as $obj) {
                if ($obj->lang_id == $lang_id && $obj->job_lang_id != $id) {
                    $check = $obj;
                    break;
                }
            }
        }

        if($check == null &&  $levelExist && $langExist) {
            DB::table('job_lang_seeker')
                ->where('job_lang_id', $id)
                ->where('seeker_id', $seekers_id)->update([
                    'lang_id' => $lang_id,
                    'level_id' =>$level_id,
                ]);
        }else{
            $message = "خطاء في الإدخال";
            $seeker_lang = Helpers::getDataSeeker($this->pageName,$seekers_id,false);
            $data =[
                "seeker_lang" => $seeker_lang,
            ];

            return  Helpers::showModal($this->pageName,$data,$message);
        }
        $message = "";
        $seeker_lang = Helpers::getDataSeeker($this->pageName,$seekers_id,true);
        $data =[
            "seeker_lang" => $seeker_lang,
        ];

        return  Helpers::showModal($this->pageName,$data,$message);
    }

    public function destroy($id)
    {
        $seekers_id = session('seeker_id');

        DB::table('job_lang_seeker')
            ->where('job_lang_id',$id)
            ->where('seeker_id',$seekers_id)
            ->delete();

        $message = "";
        $seeker_lang = Helpers::getDataSeeker($this->pageName,$seekers_id,true);
        $data =[
            "seeker_lang" => $seeker_lang,
        ];

        return  Helpers::showModal($this->pageName,$data,$message);
    }
}
