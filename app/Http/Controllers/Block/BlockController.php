<?php

namespace App\Http\Controllers\Block;

use Illuminate\Http\Request;
use DB;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BlockController extends Controller
{
    public function showBlockCv($user_name){
        return view('modal.block')
            ->with('user_name',$user_name);
    }
    public function postBlockCv(Request $request,$user_name){
        $seeker_id = session('seeker_id');

        $user = trim(strip_tags($user_name));
        $text = trim(strip_tags($request->input('text')));
        $seeker_block = DB::table('seekers')->select('seeker_id')
            ->where('user_name',$user)->first();
        $message = "لم تتم عملية الأبلاغ بنحاح، لديك تنبيه محاولة اخري سيتم حظرك من الموقع";
        if(empty($seeker_block)){
            return response()->json(['message' => $message]);
        }
        if($seeker_block->seeker_id == $seeker_id)
            return response()->json(['message' => $message]);

        $message = "شكرا لك علي الإبلاغ، سوف نحرص علي مراجعة تقريرك. ";
        DB::table('block_seeker')
            ->insert([
                'seeker_id' => $seeker_id,
                'seeker_block' => $seeker_block->seeker_id,
                'text' => $text,
            ]);
        return response()->json(['message' => $message]);

    }

    public function showBlockCompany($user_name){
        return view('modal.block_company')
            ->with('user_name',$user_name);
    }

    public function postBlockCompany(Request $request,$user_name){

        $message = "لم تتم عملية الأبلاغ بنحاح، لديك تنبيه محاولة اخري سيتم حظرك من الموقع";

        if(empty(session('seeker_id')))
            return response()->json(['message' => $message]);
        $seeker_id = session('seeker_id');
        $user = trim(strip_tags($user_name));
        $text = trim(strip_tags($request->input('text')));
        $seeker_block = DB::table('companys')
            ->select('companys.comp_id')
            ->join('managers','managers.comp_id','=','companys.comp_id')
            ->where('comp_user_name',$user)->first();

        if(empty($seeker_block)){
            return response()->json(['message' => $message]);
        }

        $message = "شكرا لك علي الإبلاغ، سوف نحرص علي مراجعة تقريرك. ";

        DB::table('block_company')
            ->insert([
                'seeker_id' => $seeker_id,
                'comp_id' => $seeker_block->comp_id,
                'text' => $text,
            ]);
        return response()->json(['message' => $message]);

    }

    public function showBlockJob($user_name){
        return view('modal.block_job')
            ->with('user_name',$user_name);
    }

    public function postBlockJob(Request $request,$user_name){
        $message = "شكرا لك علي الإبلاغ، سوف نحرص علي مراجعة تقريرك. ";

        if(empty(session('seeker_id')))
            return response()->json(['message' => $message]);
        $seeker_id = session('seeker_id');
        $user = trim(strip_tags($user_name));
        $text = trim(strip_tags($request->input('text')));
        $seeker_block = DB::table('job_description')
            ->select('desc_id')
            ->where('desc_id',$user)->first();

        $message = "لم تتم عملية الأبلاغ بنحاح، لديك تنبيه محاولة اخري سيتم حظرك من الموقع";
        if(empty($seeker_block)){
            return response()->json(['message' => $message]);
        }


        $message = "شكرا لك علي الإبلاغ، سوف نحرص علي مراجعة تقريرك. ";
        DB::table('block_desc')
            ->insert([
                'seeker_id' => $seeker_id,
                'desc_id' => $seeker_block->desc_id,
                'text' => $text,
            ]);
        return response()->json(['message' => $message]);

    }

    public function showBlockCourse($user_name){
        return view('modal.block_course')
            ->with('user_name',$user_name);
    }

    public function postBlockCourse(Request $request,$user_name){
        $seeker_id = session('seeker_id');
        $user = trim(strip_tags($user_name));
        $text = trim(strip_tags($request->input('text')));
        $seeker_block = DB::table('companys')
            ->select('companys.comp_id')
            ->join('managers','managers.comp_id','=','companys.comp_id')
            ->where('comp_user_name',$user)->first();

        $message = "لم تتم عملية الأبلاغ بنحاح، لديك تنبيه محاولة اخري سيتم حظرك من الموقع";
        if(empty($seeker_block)){
            return response()->json(['message' => $message]);
        }


        $message = "شكرا لك علي الإبلاغ، سوف نحرص علي مراجعة تقريرك. ";
        DB::table('block_company')
            ->insert([
                'seeker_id' => $seeker_id,
                'comp_id' => $seeker_block->comp_id,
                'text' => $text,
            ]);
        return response()->json(['message' => $message]);

    }
}
