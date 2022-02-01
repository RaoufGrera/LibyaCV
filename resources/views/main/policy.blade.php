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
           
                   <h5 class="title-page"> التسجيل باستخدام الفيسبوك </h5>
                   <li>  .نقوم بإضافة "بريدك الالكتروني" و"اسمك علي الفيسبوك" الي الحساب الشخصي الخاص بك في التطبيق ولتسهيل عملية تسجيل الدخول ولتسهيل تعبئة بيانات السيرة الذاتية باسم والبريد الألكتروني </li>
                   <li> بإمكانك حذف هذه البيانات وكل البيانات التي تدخلها للنظام بنفسك من خلال خدمة حذف الحساب نهائياً من التطبيق</li>


                   <h5 class="title-page"> حذف الحساب نهائيا من النظام </h5>

                   <li>من القائمة المنسدلة لأيقونة الحساب علي يمين التطبيق تختار اعدادات</li>
                   <li>سيتم فتح شاشة الاعدادات وبإمكانك الضغظ علي زر حذف الحساب لحذف كل البيانات التي ادخلتها وحذف حسابك بالكامل من التطبيق </li>
                 
   


                 </div>
        </div>

    </div>
@stop