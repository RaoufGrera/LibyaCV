<?php
/**
 * Created by PhpStorm.
 * User: Asasna
 * Date: 2/28/2019
 * Time: 4:29 PM
 */
?>
 @inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
@extends('layouts.header')
@section('title',trans("page.job-application"))

@section('content')

    <div class="container">
        <div class="row">
            @include('layouts.seeker')
            <div class="col-md-9 ">
                <br>
                <h5 class="title-page">خدمـاتي</h5>
                <br>

                <div class="cont">
                    @if(session('error'))
                        <div class="alert alert-warning">
                            <a href="javascript:void(0);" class="close" data-dismiss="alert"
                               aria-label="close">&times;</a>

                            <strong>تنبيه!</strong> {{  session('error') }}
                        </div>
                    @endif

                        <div id="services">
                            @include('seekers.modal.show.se')
                        </div>


                </div>
            </div>
        </div>
        <img id="loading" src="{{asset('images/loading.gif')}}" style="display: none" />
        <script language="javascript">
            function deleteItem(a,b,c) {
                if (confirm("هل أنت متأكد من الحذف؟")) {
                    var token = '{{ Session::token() }}';
                    var data = {
                        '_token' : token,
                        '_method' : 'delete',
                    };
                    deleteRest(a,b,c,data);
                    return true;
                } else {
                    return false;
                }
            }

        </script>
    </div>


@stop