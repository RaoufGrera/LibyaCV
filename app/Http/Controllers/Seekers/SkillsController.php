<?php

namespace App\Http\Controllers\Seekers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Helpers;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SkillsController extends Controller
{

    public function __construct()
    {
        $this->pageName = "skills";

    }
    public function index()
    {

    }

    public function create()
    {

        $level = Helpers::getDataSeeker('job_level',null,false);
        return view('seekers.modal.add.askills')
            ->with('level',$level);
    }

    public function store(Request $request)
    {
        $id = session('seeker_id');

        $skills_name = trim(strip_tags($request->input('skills_name')));
        $level_id = trim(strip_tags($request->input('level_id')));

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

        if (empty($skills_name) || empty($level_id) || !$levelExist ) {
            $message = "";
            $seeker_skills = Helpers::getDataSeeker('skills',$id,false);

            $data =[
                "seeker_skills" => $seeker_skills,
            ];

            return  Helpers::showModal($this->pageName,$data,$message);
        }

        DB::table('job_skills')->insert([
            'seeker_id' => $id,
            'skills_name' => $skills_name,
            'level_id' => $level_id,
        ]);
        $message = "";
        $seeker_skills = Helpers::getDataSeeker('skills',$id,true);

        $data =[
            "seeker_skills" => $seeker_skills,
        ];

        return  Helpers::showModal($this->pageName,$data,$message);
    }

    public function show($id)
    {

    }


    public function edit($id)
    {
        $seekers_id =session('seeker_id');

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


        return view('seekers.modal.edit.eskills')
            ->with('seeker_skills',$seeker_skills)
            ->with('level',$level);
    }

    public function update(Request $request, $id)
    {
        $seekers_id = session('seeker_id');
        $skills_name = trim(strip_tags($request->input('skills_name')));
        $level_id = trim(strip_tags($request->input('level_id')));


        if (empty($skills_name) || empty($level_id) ) {
            $message = "خطاء في الإدخال";
            $seeker_skills = Helpers::getDataSeeker('skills',$seekers_id,false);

            $data =[
                "seeker_skills" => $seeker_skills,
            ];

            return  Helpers::showModal($this->pageName,$data,$message);
        }

        DB::table('job_skills')
            ->where('skills_id', $id)
            ->where('seeker_id', $seekers_id)->update([
                'skills_name'    =>     $skills_name,
                'level_id'       =>      $level_id,
            ]);
        $message = "";
        $seeker_skills = Helpers::getDataSeeker('skills',$seekers_id,true);

        $data =[
            "seeker_skills" => $seeker_skills,
        ];

        return  Helpers::showModal($this->pageName,$data,$message);
    }

    public function destroy($id)
    {
        $seekers_id = session('seeker_id');
        DB::table('job_skills')
            ->where('skills_id',$id)
            ->where('seeker_id',$seekers_id)
            ->delete();

        $message = "";
        $seeker_skills = Helpers::getDataSeeker('skills',$seekers_id,true);

        $data =[
            "seeker_skills" => $seeker_skills,
        ];

        return  Helpers::showModal($this->pageName,$data,$message);
    }
}
