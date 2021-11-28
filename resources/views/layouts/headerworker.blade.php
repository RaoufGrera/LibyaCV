<!DOCTYPE html>
<html lang="ar">
<head>
    <title>@yield('title') - Libya CV</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="{{url('/manifest.json')}}">
    <meta name="theme-color" content="#ffdf7e"/>

    {{-- icons for IOS devices --}}
    <link rel="apple-touch-icon" sizes="60x60" href="/icons/apple-60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/icons/apple-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/icons/apple-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/icons/apple-152.png">
    <link rel="apple-touch-icon" sizes="167x167" href="/icons/apple-167.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/icons/apple-180.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/service-worker.js');
            });
        }
    </script>

    <meta id="X-CSRF-TOKEN" content="{{ csrf_token() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <link rel="alternate" href="https://www.libyacv.com" hreflang="ar-ly" />
    <meta name='googlebot' content='index,follow' />

    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap_v1.css')}}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="Abdalraouf_Grera" name="author">
    <link href="https://fonts.googleapis.com/css?family=Tajawal:200,300,400,500,700,800,900&amp;subset=arabic" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>

    <link rel="icon" type="image/png" href="{{asset('images/simple/logo_blue.png')}}">
    <link rel='shortcut icon' type='image/x-icon' href="{{asset('images/simple/cv.png')}}">

    <img src="{{asset('images/ajax-loader.gif')}}" style="display:none;"/>
    <!-- <meta property="og:image" content=" {asset('images/logo/logofb.jpg' " /> -->

    <meta property="og:type"               content="website" />
    <meta property="og:description" content="@yield('description')">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:url" content="@yield('url')">
    <meta property="og:image" content="@yield('image')">
    <meta name='revisit-after' content='1 days' />
    <meta name="copyright" content="LibyaCV" />
    <meta name="expires" content="never" />
    <meta http-equiv="Content-Language" content="ar-ly" />
    <meta property="fb:app_id" content="340370763039912" />
    <link rel="canonical" href="https://www.libyacv.com/">
    @yield('json')
<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-118379751-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-118379751-1');
    </script>
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: "ca-pub-9929016091047307",
          enable_page_level_ads: true
     });
</script> -->


    {{--  <script>
         (adsbygoogle = window.adsbygoogle || []).push({
             google_ad_client: "ca-pub-9929016091047307",
             enable_page_level_ads: true
         });
     </script>--}}

</head>
<body>
<style>

    body{
        padding-top: 49px;

    }

    @media screen and (max-width: 992px) {
        #conno{
            padding-right: 0px;
            padding-left: 0px;
        }
        body {
            padding-top: 90px;
        }
        .navbar-header{
            display: none;
        }
    }

    @media screen and (max-width: 600px) {
        body {
            padding-top: 90px;
        }
        #conno{
            padding-right: 0px;
            padding-left: 0px;
        }
        .navbar-header{
            display: none;
        }
    }
    .navbar{
        /*  border-top: none;*/
    }
    .navbar-fixed-top {
        top: 0;
        position: fixed;
        right: 0;
        left: 0;
        z-index: 99;
    }
    .head_number{
        position: absolute;
        font-size: 85%;
        background: #F44336;
        color: #fff;
        line-height: 1.4;
        left: 4px;
        padding: 1px 6px;
        opacity: 0.8;
        border-radius: 25px;
        top: -1px;
        display: none;
    }

    #chacnge   li,#chacnge  li a{
        display: inline-block;
        padding: 2px 2px;
    }

</style>

<nav class="navbar navbar-default navbar-fixed-top" id="mNavbar">
    <div id="conno" class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">



            <a style="text-align: center;
    display: block;
    margin: 0 auto;"  @if(!empty(session('seeker_id'))) href="/" @else  href="/" @endif ><img style="    margin-left: 10px;    margin-top: -2px;width: 55px;display: inline-block" alt="Libyacv logo" src="{{asset('images/simple/web.png')}}"/> </a>
            <!-- <a href="#"><img class="logo" src="http://localhost/libyacv/public/images/logocv2.png"></a>-->
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <ul id="chacnge" style="padding: 0;text-align: center;" >
            <ul style="font-size:15px;font-weight: 500;display: inline-block;" class="nav navbar-nav">


                <li><a href="/company/search">الشركات<span class="head_number">{{ $notes['company'] }}</span></a></li>
                <li><a href="/job/search">الوظائف<span class="head_number">{{ $notes['desc'] }}</span> </a></li>
                {{--  <li><a href="/services/search">الخدمات <span class="head_number">{{ $notes['services'] }}</span></a></li> --}}

                <li><a href="/cv/search">السير الذاتية<span class="head_number">{{ $notes['seekers'] }}</span></a></li>


            </ul>

            <ul class="nav navbar-nav navbar-right" style="display: inline-block;margin-right:1px;font-size: 14px;
    font-weight: 500;">

            @if(!empty(session('seeker_id')))
                {{--   <li style="margin-left: 6px;     margin-top: 7px;"><a style="padding: 7px;" class="btn btn-default btn-sm" href="/profile/services"><img class="ser" src="{{ Asset('images/home/ser.png') }}" />خدماتي </a>
                  </li>--}}

                @if(session('user_name_company') == "")
                    <!--   <li style="margin-left: 6px;     margin-top: 7px;"><a style="padding: 7px;" class="btn btn-default btn-sm" href="/profile/job/create"><span class="icon-plus">نشر وظيفة</span></a>
                      </li> -->
                    @endif


                    <li id="dn" class="dropdown">
                        <a href="javascript:void(0)" id="dropdown-profile" class="dropbtn"
                           onclick="myFunction('myDropdown')"><img
                                    src="@if(session('image') != "") {{asset('images/seeker/40px_'.session('code_image') .'_'.session('image') )}} @else @if(session('gender') =='m') {{asset('images/simple/40px_male.png')}} @else {{asset('images/simple/40px_female.png')}}  @endif @endif">
                            <span class="caret"></span></a>
                        <div class="dropdown-content" style="left: -10px" id="myDropdown">
                            <span><a href="/profile/dashboard"><img width="18" src="{{ Asset('images/home/home30.png') }}">  {{ trans("page.dashboard") }}</a></span>
                            <span><a   href="/profile"><img width="18" src="{{ Asset('images/home/cv30.png') }}"> {{ trans("page.profile") }}</a></span>
                            @if(session('user_name_company') != "" )

                                <span class="divider"></span>
                                <span><a
                                            href="/company-profile/{{ session('user_name_company') }}"><img width="18" src="{{ Asset('images/home/mycomp.png') }}"> شركة (  {{ str_limit(session('user_name_company'), $limit = 15, $end = '...') }} )</a>
                                            </span>



                            @endif
                            <span><a  href="/profile/settings"><img width="18" src="{{ Asset('images/home/settings30.png') }}">  الإعدادات</a></span>
                            <span><a class=" icon-cancel" href="/profile/logout"> تسجيل الخروج</a></span>
                        </div>
                    </li>
                @elseif(Auth::guard('admins')->check())
                    <li><a href="/administrator/dashboard">لوحة التحكم</a></li>
                    <li><a href="/administrator/logout">خروج</a></li>

                @else
                    <li class="login">
                        <button onclick="location.href = '/register';" class="btn btn-block btn-default">إنشاء
                            حساب
                        </button>
                    </li>
                    <li class="login">
                        <button onclick="location.href = '/login';" class="btn btn-block btn-primary">دخول</button>
                    </li>
                @endif
            </ul>

            <style>
                .ser{
                    width: 19px;margin-left: 6px;
                }
                .bbr{
                    border-left: 1px solid #ddd;
                    border-right: 1px solid #ddd;
                }

            </style>

        </ul>
    </div><!-- /.container-fluid -->

</nav>

@yield('content')

<style>
    footer{
        margin-top: 60px;
        background-color: #ffdc73;
        border-top: 1px solid #3c3c3c;
        padding: 80px 20px 15px 20px;
        /* color: #fff; */
    }
    .lcount{
        position: absolute;
        font-size: 78%;
        background: #F44336;
        color: #fff;
        line-height: 1.4;
        padding: 1px 6px;
        opacity: 0.8;
        border-radius: 25px;
        top:1px;
    }
    footer a{
        color: #0d0d0d;
    }
    footer a:hover{
        color:#000000;
    }
    .sww{
        font-size: 20px;
        /* font-weight: 600; */
        color: #fbfbfb;
        display: block;
    }
    footer p {
        color: #0d0d0d;


    }.l{font-size: 30px;margin-top: 25px;}
    .icon-facebook-official:before,icon-twitter:before{
        margin: 4px;
    }
    .ba{
        text-align: center;
        margin: 0 auto;
        display: block;
        padding: 8px 26px;
        font-size: 30px;
    }.f{font-size: 92%;}.f hr{border-color:#6a6a6a}
</style>
<footer class="contaner  col-md-12 center  notprint foot">

    <div class="col-md-4">

        <span class="center " style="font-size: 18px">[ ليبيـا <span  >سي في</span> ]</span>
        <p>موقـع للتوظيـف الإلكتروني، يسمح للباحثين عن عمل من إنشـاء سيرهم الذاتيـة والتقدم لأي وظيفة شاغـرة معـروضة داخل النظام. كما يوفر الموقع لأصحاب العمل من عرض وظائفهم الشاغرة والحصول والتحكم في طلبات التوظيف.</p>
        <a  href="/policy">ساسية الخصوصية</a> - <a href="/terms">الشروط والأحكام</a>

    </div>

    <div class="col-md-4 col-md-offset-3">
        <div class="l"><a href="https://www.facebook.com/libyacv" class="icon-facebook-official"  ></a> <a href="https://t.me/libyajobs" class="icon-telegram"></a> </div>
        <a style="display: block;text-align: center; margin-bottom: 4px;" href='https://play.google.com/store/apps/details?id=libyacvpro.libya_cv'><img width="180px" alt='Get it on Google Play' src='{{ asset('images/simple/en_badge.png') }}'/></a>

        <span>info@libyacv.com</span>

    </div>

    <div class="col-md-12 f">
        <hr style="color:#ddd">
        جميع الحقوق محفوظة Libyacv - 2019
    </div>
</footer>

<script    type="text/javascript" src="{{asset('js/facebox/jquery.js')}}"></script>



<script type="text/javascript" src="{{asset('js/index.js')}}" async ></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('a[class*=facebox]').facebox({
            loadingImage: "{{asset('images/ajax-loader.gif')}}",
            closeImage: ''

        })
    });




</script>

<a class="facebox" style="display: none"></a>

@yield('last')
</body>
</html>