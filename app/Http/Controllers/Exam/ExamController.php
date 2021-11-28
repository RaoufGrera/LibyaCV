<?php

namespace App\Http\Controllers\Exam;

use Illuminate\Http\Request;
use App\Helpers;
use DB;
use Session;
use Flash;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seeker_id=session('seeker_id');

        $exam = DB::table('exams')
            ->get();

        return view('exam.exams')
            ->with('exam',$exam);
    }

    public function showExam($url){
        $seeker_id=session('seeker_id');
        $myCompany = NULL;

        $isErorr=0;
        $exam = DB::table('exams')->where('url', '=', $url)->first();

        return view('exam.infoexam')->with('exam',$exam)
            ->with('isErorr',$isErorr) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function endExam(Request $request,$url)
    {
        $seeker_id = session('seeker_id');
        $myCompany = NULL;


        $exam = DB::table('exams')->where('url', '=', $url)->first();
        $exam_id = $exam->exam_id;
        $search_this = json_decode(trim(strip_tags($request->input('questions'))));


        print_r($search_this);
        $question = DB::table('questions')->where('exam_id', '=', $exam_id)
            ->get();

        $q_array["question"][] = array();
        foreach ($question as $item) {
            $qusArray = array($item->question_name, $item->answer_name1, $item->answer_name2, $item->answer_name3, $item->answer_name4, $item->istrue, $item->question_id);


            array_push($q_array['question'], $qusArray);
        }
        array_shift($q_array['question']);
        echo "<hr>";
        print_r($q_array['question']);

        /* $result = array_map("unserialize", array_intersect(serialize_array_values($search_this),serialize_array_values($q_array['question'])));

         echo "\n\n\n";
         echo var_dump($result);-*/
        $rr = $q_array['question'];
        $result = array();

        $results = array_map("unserialize",
            array_diff(array_map('serialize', $search_this), array_map('serialize', $rr)));

        $results = count($results);

        $results = ($results / count($question)) * 100;

        $results= 100 -$results;
        $examSeeker = DB::table('seeker_exam')
            ->where('exam_id', $exam_id)
            ->where('seeker_id', $seeker_id)->orderBy('seeker_exam_id', 'DESC')->first();

        $from_time = strtotime($examSeeker->create_date);
        $now_time =Now();


        $to_time = strtotime($now_time);
      //  $interval = date_diff($from_time,$to_time);

        $seconds = abs( $to_time -$from_time );


        $divisor_for_minutes = $seconds % (60 * 60);
        $minutes = floor($divisor_for_minutes / 60);

        // extract the remaining seconds
        $divisor_for_seconds = $divisor_for_minutes % 60;
        $seconds = ceil($divisor_for_seconds);

        $theRealTime = $minutes.".".$seconds;

        if ($minutes > $exam->time)
        {
            DB::table('seeker_exam')->where('seeker_exam.seeker_exam_id','=',$examSeeker->seeker_exam_id)
                ->update([
                'exam_result' => 0,
                'time_end' => $theRealTime,
                 'totaltime' => $exam->time,
            ]);

        }

        DB::table('seeker_exam')->where('seeker_exam.seeker_exam_id','=',$examSeeker->seeker_exam_id)
            ->update([

            'exam_result' => $results,
            'time_end' => $theRealTime,
                'totaltime' => $exam->time,
        ]);



        return redirect('/exam/'.$url.'/result');



    }

    public  function  resultExam($url){
        $myCompany = NULL;
        if (!empty(session('seeker_id'))) {
            $seeker_id = session('seeker_id');
            $myCompany = Helpers::getDataSeeker('seekerCompany', $seeker_id, false);

        }
        $exam = DB::table('exams')->where('url', '=', $url)->first();

        $resultExam = DB::table('seeker_exam')
            ->where('exam_id',$exam->exam_id)
            ->where('seeker_id', $seeker_id)->orderBy('seeker_exam_id', 'DESC')->first();

        return view('exam.resultexam')
            ->with('resultExam',$resultExam)


            ->with('exam',$exam)
            ->with('isErorr',0)
            ->with('myCompany',$myCompany)
            ->with('company',$myCompany);

    }
    public function startExam(Request $request,$url)
    {
        $seeker_id=session('seeker_id');





        $exam =  DB::table('exams')->select('exam_id')->where('url','=',$url)->first();
        $exam_id =$exam->exam_id;
       // $question = DB::table('questions')->where('exam_id','=',$exam_id)
         //   ->get();
       /* DB::table('seeker_exam')
            ->where('exam_id', $exam_id)
            ->where('seeker_id', $seeker_id)->delete();*/
        DB::table('seeker_exam')->insert([
            'exam_id' => $exam_id,
            'seeker_id' => $seeker_id,
            'exam_result' => '0',
            'time_end' => '0',
            'create_date' => Now(),
        ]);
       Session::put('statusexam',1);

        return redirect('/exam/'.$url);

    }
    public  function  backExam($url){
        $status =0;
        if(session()->has('statusexam') ){
            if(session('statusexam') == 1){

            session()->forget('statusexam');

            $exam =  DB::table('exams')->select('exam_id')->where('url','=',$url)->first();
        $exam_id =$exam->exam_id;
        $question = DB::table('questions')->where('exam_id','=',$exam_id)
            ->get();
            $status =1;
            }else{
                $status =$question=$exam=0;

            }
        }
        else{
            $status =$question=$exam=0;
        }


        return view('exam.startexam')->with('statusexam')->with('status',$status)
            ->with('question',$question)
            ->with('url',$url)
            ->with('exam',$exam);
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
