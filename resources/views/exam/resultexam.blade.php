@inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
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
            <div class="col-md-3">

            </div>
            <div class="col-md-9 ">
                <br>
                <h5 class="title-page"> نتيجة الأختبار</h5>
                <br>

                <div class="cont">
                    @if($isErorr==1 )
                        <div class="alert alert-warning">
                            <a href="javascript:void(0);" class="close" data-dismiss="alert"
                               aria-label="close">&times;</a>

                            <strong>تنبيه!</strong> لايمكن عرض هذه الصفحة.
                        </div>
                    @else
                   <h4>إختبار {{ $exam->exam_name }}</h4>

                    <hr>
                        <span>مدة الأختبار: </span><span>{{ $exam->time }}</span><span> دقيقة</span><br>
                        <span>الوقت المستغرق: </span><span>{{ $resultExam->time_end }}</span><span> دقيقة</span><br>
                    <span>النتيجة: </span><span>{{ $resultExam->exam_result }}</span><span> %</span>
                        @endif
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