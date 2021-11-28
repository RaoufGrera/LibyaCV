@inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
@extends('layouts.header-admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 cont">

                @if($status ==1)


                <br>
                <h5 class="title-page"> الإختبارات</h5>
                <br>

                <div class="cont">
                    {!! Form::open(['action' => array('Exam\ExamController@endExam', $url)  ,'method'=>'POST']) !!}

                    <input type="hidden" id="questions" name="questions">

                    <style>
                        div#test{ border:#000 1px solid; padding:10px 40px 40px 40px; }
                    </style>
<?php $q_array["question"][] = array();
                    ?>
                    @foreach($question as $item)
                        <?php

                        $qusArray = array($item->question_name,$item->answer_name1,$item->answer_name2,$item->answer_name3,$item->answer_name4,'',$item->question_id);


                        array_push($q_array['question'], $qusArray);

                        ?>
                    @endforeach
                    <?php array_shift($q_array['question']); ?>
                    <script>
                        var pos = 0, test, test_status, question, choice, choices, ch1, ch2, ch3,ch4, answer,q_id ;

                        var questions = <?php echo json_encode($q_array['question'], JSON_UNESCAPED_UNICODE); ?>;
                        function _(x){
                            return document.getElementById(x);
                        }
                        function renderQuestion(){
                            test = _("test");
                            if(pos >= questions.length){
                                test.innerHTML = "<button  type='submit'>عرض النتيجة</button>";
                                _("test_status").innerHTML = "أنتهي الأختبار";

                                 var questionsResult = document.getElementById('questions');
                                 questionsResult.value = JSON.stringify(questions);
                                pos = 0;
                                //correct = 0;
                                return false;
                            }
                            _("test_status").innerHTML = "Question "+(pos+1)+" of "+questions.length;
                            question = questions[pos][0];
                            ch1 = questions[pos][1];
                            ch2 = questions[pos][2];
                            ch3 = questions[pos][3];
                            ch4 = questions[pos][4];
                            test.innerHTML = "<h3>"+question+"</h3>";
                            test.innerHTML += "<input type='radio' id='1' name='choices' value='1'> <label for='1'>"+ch1+"</label><br>";
                            test.innerHTML += "<input type='radio' id='2' name='choices' value='2'><label for='2'>"+ch2+"</label><br>";
                            test.innerHTML += "<input type='radio' id='3' name='choices' value='3'><label for='3'>"+ch3+"</label><br>";
                            test.innerHTML += "<input type='radio' id='4' name='choices' value='4'><label for='4'>"+ch4+"</label><br><br>";
                            test.innerHTML += "<button onclick='checkAnswer()'>Submit Answer</button>";
                        }
                        function checkAnswer(){
                            choices = document.getElementsByName("choices");
                            for(var i=0; i<choices.length; i++){
                                if(choices[i].checked){
                                    choice = choices[i].value;
                                }
                            }
                            if(choice == questions[pos][4]){
                                correct++;
                            }
                            questions[pos][5]=choice;

                            pos++;
                            renderQuestion();
                        }
                        window.addEventListener("load", renderQuestion, false);
                    </script>


                    <h2 id="test_status"></h2>
                    <div id="test"></div>

                    {!! Form::close() !!}


                </div>
            </div>
        </div>

    </div>
    @else
        <div class="alert alert-warning">
            <a href="javascript:void(0);" class="close" data-dismiss="alert"
               aria-label="close">&times;</a>

            <strong>تنبيه!</strong> {{  session('error') }}
        </div>
    @endif

    <script language="javascript">
        function deleteItem() {
            if (confirm("هل أنت متأكد من الحذف؟")) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@stop