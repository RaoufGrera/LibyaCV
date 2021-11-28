<?php

namespace App\Http\Controllers\Api\Seeker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helpers;
use DB;

class SkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seekers_id =Auth::user()->seeker_id;
        $seeker_skills = Helpers::getDataSeeker('skills',$seekers_id,false);
        return response()->json(['skills' => $seeker_skills], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $level = Helpers::getDataSeeker('job_level',null,false);
        return response()->json(['skills' => null,
             'level'=>$level

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


        $skills_name = trim(strip_tags($request->input('skills_name')));
        $level_name = trim(strip_tags($request->input('level_name')));



        if (empty($skills_name) || empty($level_name) ) {
            return response()->json(['message'=>Helpers::getMessage("error")]
                , 200);
        }

        $CheckTable = Helpers::getDataSeeker('job_level',null,false);

        $level_id= null;
        if($CheckTable != null) {
            foreach ($CheckTable as $obj) {
                if ($obj->level_name == $level_name) {
                    $level_id= $obj->level_id;

                    break;
                }
            }
        }

        DB::table('job_skills')->insert([
            'seeker_id' => $id,
            'skills_name' => $skills_name,
            'level_id' => $level_id,
        ]);

        $seeker_skills = Helpers::getDataSeeker('skills',$id,true);
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

        $level = Helpers::getDataSeeker('job_level',null,false);


        $ed_DataTable = Helpers::getDataSeeker('skills',$seekers_id,false);

        $seeker_skills = null;
        if($ed_DataTable != null) {
            foreach ($ed_DataTable as $obj) {
                if ($obj->skills_id == $id) {
                    $seeker_skills = $obj;
                    break;
                }
            }
        }


        return response()->json(['skills' => $seeker_skills,
            'level'=>$level,

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
        $skills_name = trim(strip_tags($request->input('skills_name')));
        $level_name = trim(strip_tags($request->input('level_name')));


       

        $CheckTable = Helpers::getDataSeeker('job_level',null,false);

        $level_id= null;
        if($CheckTable != null) {
            foreach ($CheckTable as $obj) {
                if ($obj->level_name == $level_name) {
                    $level_id= $obj->level_id;

                    break;
                }
            }
        }

        DB::table('job_skills')
            ->where('skills_id', $id)
            ->where('seeker_id', $seekers_id)->update([
                'skills_name'    =>     $skills_name,
                'level_id'       =>      $level_id,
            ]);
        Helpers::getDataSeeker('skills',$seekers_id,true);

        return response()->json(['message'=>Helpers::getMessage("saved")]
            , 200);
    }

    public function destroy($id)
    {
        $seekers_id = Auth::user()->seeker_id;
        DB::table('job_skills')
            ->where('skills_id',$id)
            ->where('seeker_id',$seekers_id)
            ->delete();

        $seeker_skills = Helpers::getDataSeeker('skills',$seekers_id,true);

        return response()->json(['message'=>Helpers::getMessage("deleted")]
            , 200);
    }

}
