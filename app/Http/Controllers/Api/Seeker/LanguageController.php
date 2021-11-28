<?php

namespace App\Http\Controllers\Api\Seeker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Helpers;


class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $pageName;

    public function __construct()
    {
        $this->pageName = "lang";
    }

    public function index(){
        $seekers_id =Auth::user()->seeker_id;
        $seeker_lang = Helpers::getDataSeeker('lang',$seekers_id,false);
        return response()->json(['language' => $seeker_lang], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lang = Helpers::getDataSeeker('job_lang',null,false);
        $level = Helpers::getDataSeeker('job_level',null,false);


        return response()->json(['language' => null,
            'lang_type'=>$lang,
            'level'=>$level

        ], 200);
    }


    public function store(Request $request)
    {
        $id   =Auth::user()->seeker_id;
        $lang_name= $request->input('lang_id');
        $level_name= $request->input('level_id');
        $CheckTable = Helpers::getDataSeeker('job_lang',null,false);

        $langExist = false;
        $lang_id= null;
        if($CheckTable != null) {
            foreach ($CheckTable as $obj) {
                if ($obj->lang_name == $lang_name) {
                    $langExist = true;
                    $lang_id= $obj->lang_id;
                    break;
                }
            }
        }
        $CheckTable = Helpers::getDataSeeker('job_level',null,false);

        $levelExist = false;
        $level_id= null;
        if($CheckTable != null) {
            foreach ($CheckTable as $obj) {
                if ($obj->level_name == $level_name) {
                    $levelExist = true;
                    $level_id= $obj->level_id;

                    break;
                }
            }
        }


        $ed_DataTable = Helpers::getDataSeeker('lang',$id,false);


        if($levelExist && $langExist){
            DB::table('job_lang_seeker')->insert([
                'seeker_id' => $id,
                'lang_id' => $lang_id ,
                'level_id' => $level_id,
            ]);
        }else{

            return response()->json(['message'=>Helpers::getMessage("error")]
                , 200);
        }

        $ed_DataTable = Helpers::getDataSeeker('lang',$id,true);

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
        $seekers_id =Auth::user()->seeker_id;
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

        return response()->json(['language' => $seeker_lang,
            'lang_type'=>$lang,
            'level'=>$level

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

        $lang_name= $request->input('lang_id');
        $level_name= $request->input('level_id');
        $CheckTable = Helpers::getDataSeeker('job_lang',null,false);

        $langExist = false;
        $lang_id= null;
        if($CheckTable != null) {
            foreach ($CheckTable as $obj) {
                if ($obj->lang_name == $lang_name) {
                    $langExist = true;
                    $lang_id= $obj->lang_id;
                    break;
                }
            }
        }
        $CheckTable = Helpers::getDataSeeker('job_level',null,false);

        $levelExist = false;
        $level_id= null;
        if($CheckTable != null) {
            foreach ($CheckTable as $obj) {
                if ($obj->level_name == $level_name) {
                    $levelExist = true;
                    $level_id= $obj->level_id;

                    break;
                }
            }
        }
        $ed_DataTable = Helpers::getDataSeeker('lang',$seekers_id,false);

        if($levelExist && $langExist) {
            DB::table('job_lang_seeker')
                 ->where('seeker_id', $seekers_id)
                ->where('job_lang_id', $id)
                ->update([
                    'lang_id' => $lang_id,
                    'level_id' =>$level_id,
                ]);
         }else{
             return response()->json(['message'=>Helpers::getMessage("error")]
                , 200);
        }

        Helpers::getDataSeeker('lang',$seekers_id,true);
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

        DB::table('job_lang_seeker')
            ->where('job_lang_id',$id)
            ->where('seeker_id',$seekers_id)
            ->delete();

         Helpers::getDataSeeker($this->pageName,$seekers_id,true);

        return response()->json(['message'=>Helpers::getMessage("deleted")]
            , 200);
    }
}
