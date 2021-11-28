
@extends('layouts.header')
@section('content')
    <?php
    /**
     * Created by PhpStorm.
     * User: Asasna
     * Date: 24/06/2017
     * Time: 12:16 ص
     */?>

    <div class="container">
        <div class="row">
            @include('layouts.admins')
            <div class="col-md-9 ">
                <br>
                <h5 class="title-page">تعديل السؤال جديد</h5>
                <br>
                <style>
                    .txtArea{
                        max-height:350px;width:100%;min-width:130px ;  max-width:550px;height:40px; min-height:40px;
                    }
                </style>
                <div class="cont">
                    @if(session('error'))
                        <div class="alert alert-warning">
                            <a href="javascript:void(0);" class="close" data-dismiss="alert"
                               aria-label="close">&times;</a>

                            <strong>تنبيه!</strong> {{  session('error') }}
                        </div>
                    @endif
                    {!! Form::open(['action' => array('Admins\MangeExamController@updateQuestion', $exam_id,$question_id)  ,'class'=>'form-style-2','method'=>'POST']) !!}

                    <table class="table">

                        <tr>
                            <td><lable>نص السؤال</lable></td>
                            <td><textarea  maxlength="2000"  class="txtArea" rows="80" name="question_name" id="question_name"  >{{ $question->question_name }}</textarea></td>

                        </tr>
                        <tr>
                            <td><lable>الأختيار الأول 1</lable></td>
                            <td><textarea  maxlength="2000" class="txtArea"  rows="80" name="answer_name1" id="answer_name1"  >{{ $question->answer_name1 }}</textarea></td>

                        </tr>
                        <tr>
                            <td><lable>الأختيار الثاني 2</lable></td>
                            <td><textarea  maxlength="2000" class="txtArea"  rows="80" name="answer_name2" id="answer_name2"  >{{ $question->answer_name2 }}</textarea></td>

                        </tr>
                        <tr>
                            <td><lable>الأختيار الثالث 3</lable></td>
                            <td><textarea  maxlength="2000" class="txtArea"  rows="80" name="answer_name3" id="answer_name3"  >{{ $question->answer_name3 }}</textarea></td>

                        </tr>

                        <tr>
                            <td><lable>الأختيار الرابع 4</lable></td>
                            <td><textarea  maxlength="2000" class="txtArea"  rows="80" name="answer_name4" id="answer_name4"  >{{ $question->answer_name4 }}</textarea></td>

                        </tr>


                        <tr>
                            <td>
                                <label  for="is_active">
                                    حالة السؤال

                                </label>
                            </td>
                            <td>
                                <select name="is_active" >
                                    <option value="0" @if($question->isactive == '0') selected @endif>غير مفعل </option>
                                    <option value="1" @if($question->isactive == '1') selected @endif>مفعل</option>
                                </select>
                            </td>
                        </tr>


                        <tr>
                            <td>
                                <label  for="isarabic">
                                    لغة السؤال

                                </label>
                            </td>
                            <td>
                                <select name="isarabic" >
                                    <option value="0" @if($question->isarabic == '0') selected @endif>انجليزي  </option>
                                    <option value="1" @if($question->isarabic == '1') selected @endif>عربي</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label  for="istrue">
                                    الإجابة

                                </label>
                            </td>
                            <td>
                                <select name="istrue" >
                                    <option value="1" @if($question->istrue == '1') selected @endif>الأختيار الأول 1</option>
                                    <option value="2" @if($question->istrue == '2') selected @endif>الأختيار الثاني 2</option>
                                    <option value="3" @if($question->istrue == '3') selected @endif>الأختيار الثالث 3</option>
                                    <option value="4" @if($question->istrue == '4') selected @endif>الأختيار الرابع 4</option>
                                </select>
                            </td>
                        </tr>

                    </table>
                    <br>
                    <button type="submit" class="btn   btn-info" >حفظ</button>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>

    </div>

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