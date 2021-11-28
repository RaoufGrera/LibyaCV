@inject('company','App\Helpers\CompanyConstant')
<?php
$myCompany = $company->getCompany();
$notes = $company->getNote();

?>
@extends('layouts.header')
@section('title',"نماذج سيرة ذاتية احترافية باللغة الانجليزية")
@section('keywords',"نماذج سيرة ذاتية, تحميل السيرة الذاتية, نماذج سي في, نماذج سيرة ذاتية احترافية, نماذج سيرة ذاتية مجانية,free template cv, cool free resume, template resume 2019")
@section('image',asset('images/blog/blog2019.png'))
@section('url',Request::url())
@section('description',"نماذج للسيرة الذاتية احترافية باللغة الانجليزية قابلة للتعديل مجانا، لتحميل بيصغة الورد docx")

@section('content')
    <script data-ad-client="ca-pub-9929016091047307" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <br>
    <style>
        .col-lg-4,.col-md-3{
            padding-top: 15px;
        }
    </style>
    <h1 class="center">نماذج سيرة ذاتية باللغة الانجليزية</h1><br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">




                <p>
                    نماذج سيرة ذاتية  بللغة الانجليزية بصيغة ميكروسوفت ورد، مع امكانية تعديل النص والصورة الشخصية مجاناً
                </p>
                <p>
                    <ul>
                    <li>  حجم الصفحة A4</li>
                    <li>اللغة إنجليزية</li>
                    <li>السعر مجانية</li>

                </ul>

                </p>

                <div class="container">
                    <div class="row">

                        <div class="col-md-3">
                            <a href="/files/free_cv_resume_en_blue/download">
                                <div class="divblog">
                                    <img width="100%" src="{{asset('images/blog/template1.jpg')}}">
                                    <span class="spanblog"><h2 class="titleblog">Download - تحميل</h2> </span>
                                </div>
                            </a>
                        </div> <div class="col-md-3">
                            <a href="/files/free_resume_with_photo_english_grey/download">
                                <div class="divblog">
                                    <img width="100%" src="{{asset('images/blog/template2.jpg')}}">
                                    <span class="spanblog"><h2 class="titleblog">Download - تحميل</h2> </span>
                                </div>
                            </a>

                        </div>

                       <div class="col-md-3">
                        <a href="/files/template_english_resume_with_photo/download">
                            <div class="divblog">
                                <img width="100%" src="{{asset('images/blog/cvenrrg.jpg')}}">
                                <span class="spanblog"><h2 class="titleblog">Download - تحميل</h2> </span>
                            </div>
                        </a>

                    </div>
            </div>
        </div>
    </div>
    </div>
    </div>


@stop