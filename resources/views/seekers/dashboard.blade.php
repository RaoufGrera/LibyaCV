@inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
@extends('layouts.header')
@section('content')
@section('title', trans("page.dashboard"))

<script type="application/javascript">
    function Toggle(item) {
        objReq = document.getElementById(item);
        visible = (objReq.style.display != "none")
        if (visible) {
            objReq.style.display = "none";
        } else {
            objReq.style.display = "block";
        }
    }
</script>
<style>
    .btn-default{color:#e7e7e7;background-color:#fff;border-color:#e5e5e5;box-shadow: 1px 1px;}
    .btn-default span{color:#333;}
</style>
<div class="container">
    <div class="row">
        @include('layouts.seeker')
        <div class="col-md-9 ">
            <br>
            <h5 class="title-page"> الملف الشخصي</h5>
            <br>

            <div class="col-md-12">





                <div class="col-md-3 m10"><a class="btn btn-block btn-default" href="/profile">
                        <img style=" padding: 10px;" src="{{ Asset('images/home/cv30.png') }}">
                        <br><span>{{ trans('page.cv') }}</span></a>
                </div>
                {{--<div class="col-md-3 m10"><a class="btn btn-block btn-default" href="/profile/services">
                        <img style=" padding: 10px;" src="{{ Asset('images/home/ser.png') }}">
                        <br><span>خدماتي</span></a>
                </div>
                <div class="col-md-3 m10"><a class="btn btn-block btn-default" href="/profile/profile-visibility">
                        <img style=" padding: 10px;" src="{{ Asset('images/home/glass.png') }}">
                       <br><span>{{ trans('page.visibility') }}</span></a>
                </div>

                <div class="col-md-3 m10"><a class="btn btn-block btn-default" href="/profile/download">
                        <img style=" padding: 10px;" src="{{ Asset('images/home/printer30.png') }}">
                        <br><span>{{ trans('page.download') }}</span></a>
                </div>
                <div class="col-md-3 m10"><a class="btn btn-block btn-default" href="/profile/settings">
                        <img style=" padding: 10px;" src="{{ Asset('images/home/settings30.png') }}">
                        <br><span>{{ trans('page.setting') }}</span></a>
                </div>--}}
                @if(session('user_name_company') == "" )
                <div class="col-md-3 m10"><a class="btn btn-block btn-default" href="/create-company">
                        <img style=" padding: 10px;" src="{{ Asset('images/home/newcomp.png') }}">
                        <br><span>{{ trans('page.add-company') }}</span></a>
                </div>
                    @else      <div class="col-md-3 m10"><a class="btn btn-block btn-default" href="/company-profile/{{ session('user_name_company') }}">
                        <img style=" padding: 10px;" src="{{ Asset('images/home/mycomp.png') }}">
                        <br><span>{{ trans('page.company-profile') }}</span></a>
                </div>
                <div class="col-md-3 m10"><a class="btn btn-block btn-default" href="/company-profile/{{ session('user_name_company') }}/job/create">
                        <img style=" padding: 10px;" src="{{ Asset('images/home/addjobs.png') }}">
                        <br><span>{{ trans('page.Add-job') }}</span></a>
                </div>
                <div class="col-md-3 m10"><a class="btn btn-block btn-default" href="/company-profile/{{ session('user_name_company') }}/job">
                        <img style=" padding: 10px;" src="{{ Asset('images/home/list.png') }}">
                        <br><span>{{ trans('page.my-job') }}</span></a>
                </div>
                    @endif

            </div>

            <br>

           {{-- <div class="col-md-12">


            </div>

            <br>

            @if(session('user_name_company') != "" )





            <div class="col-md-12">
                <div class="col-md-3 m10"><a class="btn btn-block btn-default" href="/company-profile/{{ session('user_name_company') }}">
                        <img style=" padding: 10px;" src="{{ Asset('images/home/mycomp.png') }}">
                        <br><span>{{ trans('page.company-profile') }}</span></a>
                </div>
                <div class="col-md-3 m10"><a class="btn btn-block btn-default" href="/company-profile/{{ session('user_name_company') }}/job/create">
                        <img style=" padding: 10px;" src="{{ Asset('images/home/addjobs.png') }}">
                        <br><span>{{ trans('page.Add-job') }}</span></a>
                </div>
                <div class="col-md-3 m10"><a class="btn btn-block btn-default" href="/company-profile/{{ session('user_name_company') }}/job">
                        <img style=" padding: 10px;" src="{{ Asset('images/home/list.png') }}">
                        <br><span>{{ trans('page.my-job') }}</span></a>
                </div>

            </div>



                @endif--}}
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <ins class="adsbygoogle"
                 style="display:block; text-align:center;"
                 data-ad-layout="in-article"
                 data-ad-format="fluid"
                 data-ad-client="ca-pub-9929016091047307"
                 data-ad-slot="4652769808"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>
    <br>
    <br>
    <br>
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