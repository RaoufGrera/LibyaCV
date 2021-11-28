<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use DB;
use App\Helpers;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MangeExamController extends Controller
{
    function showAllExam(){

        $exam = DB::table('exams')
            ->join('job_level','job_level.level_id','=','exams.level_id')
            ->get();

        return view('admins.exam.exams')
            ->with('exam',$exam);

    }

    function createExam(){
        $level = Helpers::getDataSeeker('job_level',null,false);
        $domain = Helpers::getDataSeeker('job_domain',null,false);

        return view('admins.exam.create')
            ->with('level',$level)
            ->with('domain',$domain);
    }

    function storeExam(Request $request){
        $exam_name = trim(strip_tags($request->input('exam_name')));
        $level_id = trim(strip_tags($request->input('level_id')));
        $domain_id = trim(strip_tags($request->input('domain_id')));
        $time = trim(strip_tags($request->input('time')));
        $is_active = trim(strip_tags($request->input('is_active')));
        $price = trim(strip_tags($request->input('price')));


        DB::table('exams')->insert([
            'exam_name' => $exam_name,
            'domain_id' => $domain_id,
            'level_id' => $level_id,
            'isactive' => $is_active,
            'price' => $price,
            'time' => $time,
        ]);

        return redirect('/administrator/exam');

    }

    function editExam($exam_id){

        $exam = DB::table('exams')
            ->where('exam_id','=',$exam_id)->first();

        $level = Helpers::getDataSeeker('job_level',null,false);
        $domain = Helpers::getDataSeeker('job_domain',null,false);

        return view('admins.exam.edit')->with('exam',$exam)->with('level',$level)
            ->with('domain',$domain);

    }

    function updateExam(Request $request,$exam_id){
        $exam_name = trim(strip_tags($request->input('exam_name')));
        $level_id = trim(strip_tags($request->input('level_id')));
        $domain_id = trim(strip_tags($request->input('domain_id')));
        $time = trim(strip_tags($request->input('time')));
        $is_active = trim(strip_tags($request->input('is_active')));
        $price = trim(strip_tags($request->input('price')));
        $desc= trim(strip_tags($request->input('desc')));
        $url= trim(strip_tags($request->input('url')));

        DB::table('exams')
            ->where('exam_id', $exam_id)->update([
                 'exam_name' => $exam_name,
                'domain_id' => $domain_id,
                'level_id' => $level_id,
                'isactive' => $is_active,
                'desc' => $desc,
                'url' => $url,
                'price' => $price,
                'time' => $time,
            ]);


        return redirect('/administrator/exam');

    }


    function manageExam($exam_id){

        $exam = DB::table('exams')
            ->join('job_level','job_level.level_id','=','exams.level_id')
            ->join('job_domain','job_domain.domain_id','=','exams.domain_id')
            ->where('exam_id','=',$exam_id)->first();

        $questions = DB::table('questions')
            ->where('exam_id','=',$exam_id)->get();


        return view('admins.exam.manageexam')->with('exam',$exam)->with('questions',$questions);

    }

    function createQuestion($exam_id){

        return view('admins.exam.createquestion')->with('exam_id',$exam_id);
    }

    function storeQuestion(Request $request,$exam_id){
        $question_name = trim(strip_tags($request->input('question_name')));
        $answer_name1 = trim(strip_tags($request->input('answer_name1')));
        $answer_name2 = trim(strip_tags($request->input('answer_name2')));
        $answer_name3 = trim(strip_tags($request->input('answer_name3')));
        $answer_name4 = trim(strip_tags($request->input('answer_name4')));
        $isarabic= trim(strip_tags($request->input('isarabic')));

        $is_active = trim(strip_tags($request->input('is_active')));
        $istrue = trim(strip_tags($request->input('istrue')));

        DB::table('questions')->insert([
            'question_name' => $question_name,
            'exam_id' => $exam_id,
            'answer_name1' => $answer_name1,
             'answer_name2' => $answer_name2,
            'answer_name3' => $answer_name3,
            'answer_name4' => $answer_name4,
            'istrue' => $istrue,
            'isarabic' => $isarabic,

            'isactive' => $is_active,


        ]);




        return redirect('/administrator/exam/'.$exam_id.'/mange');

    }

    function editQuestion($exam_id,$question_id){

        $question = DB::table('questions')
            ->where('question_id','=',$question_id)->first();


        return view('admins.exam.editquestion')->with('question',$question)->with('exam_id',$exam_id)
            ->with('question_id',$question_id);

    }

    function updateQuestion(Request $request,$exam_id,$question_id){
        $question_name = trim(strip_tags($request->input('question_name')));
        $answer_name1 = trim(strip_tags($request->input('answer_name1')));
        $answer_name2 = trim(strip_tags($request->input('answer_name2')));
        $answer_name3 = trim(strip_tags($request->input('answer_name3')));
        $answer_name4 = trim(strip_tags($request->input('answer_name4')));
        $isarabic= trim(strip_tags($request->input('isarabic')));

        $is_active = trim(strip_tags($request->input('is_active')));
        $istrue = trim(strip_tags($request->input('istrue')));


        DB::table('questions')
            ->where('question_id', $question_id)->update([
                'question_name' => $question_name,

                'answer_name1' => $answer_name1,
                'answer_name2' => $answer_name2,
                'answer_name3' => $answer_name3,
                'answer_name4' => $answer_name4,
                'istrue' => $istrue,
                'isarabic' => $isarabic,

                'isactive' => $is_active,
            ]);


        return redirect('/administrator/exam/'.$exam_id.'/mange');

    }

}
