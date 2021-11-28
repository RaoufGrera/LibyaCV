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
                <h5 class="title-page"> الإختبارات</h5>
                <br>

                <div class="cont">
                    @if(session('error'))
                        <div class="alert alert-warning">
                            <a href="javascript:void(0);" class="close" data-dismiss="alert"
                               aria-label="close">&times;</a>

                            <strong>تنبيه!</strong> {{  session('error') }}
                        </div>
                    @endif
@foreach($exam as $item)
    <div>
         {{ $item->exam_name }} <a  href="/exam/{{$item->url}}/show" style="float: left" class="btn   btn-info" >مشاهدة الأختبار</a><br>
        <span>{{$item->desc}}</span>
         <hr>

    </div>
@endforeach

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