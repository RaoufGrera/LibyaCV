@inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
@extends('layouts.header')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-9 ">
                <br>
                <h5 class="title-page">إختبار <span>{{ $exam->exam_name }}</span></h5>
                <br>

                <div class="cont">
                    @if($isErorr==1 )
                        <div class="alert alert-warning">
                            <a href="javascript:void(0);" class="close" data-dismiss="alert"
                               aria-label="close">&times;</a>

                            <strong>تنبيه!</strong> لايمكن عرض هذه الصفحة.
                        </div>
                    @else

                        {!! Form::open(['action' => array('Exam\ExamController@startExam', $exam->url)  ,'class'=>'form-style-2','method'=>'POST']) !!}
                        {{ $exam->exam_name }} <button type="submit" style="float: left" class="btn   btn-info" >@if($exam->price =='0')<span>البدء في الأختبار</span> @else <span>شراء والبدء في الأختبار</span> @endif </button><br>

                        {!! Form::close() !!}}

                        <span>نبذه عن الأختبار: </span><br>
                        <span>{{ $exam->desc }}</span><br>

                        <span>مدة الأختبار: </span><span>{{ $exam->time }}</span><span> دقيقة</span><br>
                        <span>عدد الأسئلة: </span><span>{{ $exam->countq }}</span><span> سؤال</span><br>
                        <span>السعر: </span><span>{{ $exam->price }}</span><span> د.ل</span><br>

                        <hr>
                    <span>مقدم الأختبار</span><h3>{{ $exam->owner }}</h3>
                    <p>{{ $exam->ownerdesc }}</p>

                     @endif
                </div>
            </div>
        </div>

    </div>

@stop