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
              
                   
                    البيانات الموجودة داخل النظام
يمكن للزوار الاطلاع علي جميع الوظائف الشاغرة والسير الذاتية التي تم الموافقة علي ظهورها من قبل المستخدم لعامة الزوار
                   <li>يمكن للمستخدم التحكم في ظهور سيرته الذاتية واخفائها من نتائج البحث ومن العرض داخل النظام</li>
           



                 </div>
        </div>

    </div>
@stop