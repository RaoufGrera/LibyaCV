@inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
@extends('layouts.header')
@section('title',trans("page.policy"))
@section('keywords',trans("desc.keywords"))
@section('image',asset('images/logo/logofb.jpg'))
@section('url',trans('desc.url'))
@section('description',trans('desc.description'))
@section('content')

    <div class="container">
        <div class="row">
             <div class="col-md-12 ">
                <br>
                <h5 class="title-page"> سياسة الخصوصية </h5>
              
               التطبيق لايقوم بجمع بيانات المستخدمين <br>
               بإمكان اي شخص الاطلاع علي التطبيق واستخدامه لا نقوم بحفظ او جمع او الاطلاع ولا يطلب التطبيق من المستخدمين اي بيانات لاستخدام التطبيق
               <br>
               التطبيق لغرض الاطلاع والأستفادة فقط.

                 </div>
        </div>

    </div>
@stop