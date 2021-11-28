@inject('company','App\Helpers\CompanyConstant')
<?php
$myCompany = $company->getCompany();
$notes = $company->getNote();

?>
@extends('layouts.header')
@section('title',"نماذج سيرة ذاتية احترافية مجانية")
@section('keywords',"نماذج سيرة ذاتية, تحميل السيرة الذاتية, نماذج سي في, نماذج سيرة ذاتية احترافية, نماذج سيرة ذاتية مجانية,free template cv, cool free resume, template resume 2019")
@section('image',asset('images/blog/blog201922.png'))
@section('url',Request::url())
@section('description',"نماذج للسيرة الذاتية احترافية باللغة العربية والانجليزية قابلة للتعديل مجانا")


@section('content')
    <script data-ad-client="ca-pub-9929016091047307" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <br>

    <style>
        .col-lg-4,.col-md-3{
            padding-top: 15px;
        }
    </style>
<h1 class="center">نماذج سيرة ذاتية مجانية</h1><br>
<div class="container-fluid">
<div class="row">
    <div class="col-lg-4">
        <a href="free-cv-template/arabic-resume">
        <div class="divblog">
        <img width="100%" src="{{asset('images/blog/blogg22.png')}}">
        <span class="spanblog"><h3 class="titleblog"> نماذج سيرة ذاتية احترافية</h3> </span>
        </div>
    </a>
    </div> <div class="col-lg-4">
        <a href="free-cv-template/english-resume">
        <div class="divblog">
        <img width="100%" src="{{asset('images/blog/blogen22.png')}}">
        <span class="spanblog"><h3 class="titleblog">نماذج السيرة الذاتية باللغة الانجليزية</h3> </span>
        </div>
    </a>
    </div> <div class="col-lg-4">
        <a href="free-cv-template/arabic-resume">
        <div class="divblog">
        <img width="100%" src="{{asset('images/blog/blog201922.png')}}">
        <span class="spanblog"><h3 class="titleblog">نماذج للسيرة ذاتية باللغة العربية</h3> </span>
        </div>
    </a>
    </div></div></div>
<br>
<hr>
<br>
    <div class="container">
        <div class="row">

            <div class="col-md-3">
                <a href="/files/free_cv_resume_en_blue/download">
                    <div class="divblog">
                        <img width="100%" src="{{asset('images/blog/template1.jpg')}}">
                        <span class="spanblog"><h2 class="titleblog">نموذج سيرة ذاتية</h2> </span>
                    </div>
                </a>
            </div> <div class="col-md-3">
                <a href="/files/free_resume_with_photo_english_grey/download">
                    <div class="divblog">
                        <img width="100%" src="{{asset('images/blog/template2.jpg')}}">
                        <span class="spanblog"><h2 class="titleblog">نموذج مجاني باللغة الانجليزية</h2> </span>
                    </div>
                </a>

            </div>

            <div class="col-md-3">
                <a href="/files/template_english_resume_with_photo/download">
                    <div class="divblog">
                        <img width="100%" src="{{asset('images/blog/cvenrrg.jpg')}}">
                        <span class="spanblog"><h2 class="titleblog">سيرة ذاتية 2019</h2> </span>
                    </div>
                </a>

            </div>

            <div class="col-md-3">
                <a href="/files/template_arabic_cv/download">
                    <div class="divblog">
                        <img width="100%" src="{{asset('images/blog/template_arabic.jpg')}}">
                        <span class="spanblog"><h2 class="titleblog">نموذج سيرة ذاتية قابلة للتعديل</h2> </span>
                    </div>
                </a>
            </div>

    </div>
    </div>

@stop