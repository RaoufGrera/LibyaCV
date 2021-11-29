<!DOCTYPE html>
<html lang="ar">
<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="{{url('/manifest.json')}}">
    <meta name="theme-color" content="#fff"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- icons for IOS devices --}}
    <link rel="apple-touch-icon" sizes="60x60" href="/icons/icon_192_48.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/icons/icon_192_48.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/icons/icon_192_48.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/icons/icon_192_48.png">
    <link rel="apple-touch-icon" sizes="167x167" href="/icons/icon_192_48.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/icons/icon_192_48.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
   
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

    

    <link rel="icon" type="image/png" href="{{asset('images/simple/redlogo.png')}}">
    <link rel='shortcut icon' type='image/x-icon' href="{{asset('images/simple/ini.png')}}">

    <img src="{{asset('images/ajax-loader.gif')}}" style="display:none;"/>
    <!-- <meta property="og:image" content=" {asset('images/logo/logofb.jpg' " /> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>
    -->

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
    <link rel="canonical" href="@yield('curl')">
    @yield('json')
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-118379751-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-118379751-1');
    </script>

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
               /* display: none;*/
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
              /*  display: none;*/
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
        .navbar{
           /* border-bottom: 3px solid #a910109e;*/
            border-top: 0;
        }
    
        #chacnge   li,#chacnge  li a{
            display: inline-block;
            padding: 4px 2px;
        }
    
    </style>
<nav class="navbar navbar-default  navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
 


                <a style="
                text-align: center;
                display: block;
                text-decoration: none;
                margin: 0 auto;
                " href="/"><span style="
        display: block;
        font-size: 20px;
        font-stretch: 600;
        color: #000;
        padding-left: 3px;
        font-weight: 500;
        margin: 6px  6px 0 6px;
    ">Libya<span style="
        color: #ffffff;
        background: #FF5722;
        padding: 0 4px;
        margin-left: 2px;
        position: relative;

    ">CV</span></span> </a>
        </div>
        <style>

            .see{
                font-size: 20px;
                margin: 15px;
                float: left;    color: #1c1c1c;
            }
            .titleblog{
                display: inline-block;
            }
            .spanblog{
                display: block;
                padding: 4px;
                text-align: center;
                padding-right: 8px;
                border-top: 1px solid #413f3f;
            }
            .divblog{
                border: 1px solid #a1a1a1;
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

        </style>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <ul id="chacnge" style="padding: 0;text-align: center;" >
            <ul style="font-size:16px;font-weight: 500;display: inline-block;" class="nav navbar-nav">

                <li><a href="/job/search">الوظائف<span class="head_number">{{ $notes['desc'] }}</span> </a></li>


                <li><a href="/company/search">الشركات<span class="head_number">{{ $notes['company'] }}</span></a></li>
                <li><a href="/cv/search">السير <span class="head_number">{{ $notes['seekers'] }}</span></a></li>
    
                {{--  <li><a href="/services/search">الخدمات <span class="head_number">{{ $notes['services'] }}</span></a></li>--}}
              {{--  <li><a href="/free-cv-template">نماذج سيرة ذاتية </a></li> --}}



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
                 <ul class="nav navbar-nav navbar-right" style="display: inline-block;margin-right:1px;font-size: 14px;
                 font-weight: 500;">

            
                    @if(!empty(session('seeker_id')))
                        {{--   <li style="margin-left: 6px;     margin-top: 7px;"><a style="padding: 7px;" class="btn btn-default btn-sm" href="/profile/services"><img class="ser" src="{{ Asset('images/home/ser.png') }}" />خدماتي </a>
                          </li>--}}

                        @if(session('user_name_company') == "")
                        <!--   <li style="margin-left: 6px;     margin-top: 7px;"><a style="padding: 7px;" class="btn btn-default btn-sm" href="/profile/job/create"><span class="icon-plus">نشر وظيفة</span></a>
                      </li> -->
                        @endif
<style>
    #myDropdown span a {
        display: block;
        text-align: right;

    }
    </style>

                        <li id="dn" class="dropdown">
                            <a href="javascript:void(0)" id="dropdown-profile" class="dropbtn"
                               onclick="myFunction('myDropdown')">
                              <span>Account</span>
                          {{--      <img
                                        src="@if(session('image') != "") {{asset('images/seeker/40px_'.session('code_image') .'_'.session('image') )}} @else @if(session('gender') =='m') {{asset('images/simple/40px_male.png')}} @else {{asset('images/simple/40px_female.png')}}  @endif @endif">--}}
                                <span class="caret"></span></a>
                            <div class="dropdown-content" style="left: -10px;top: 35px;" id="myDropdown">
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
                            <button onclick="location.href = '/login';" class="btn btn-block btn-primary">دخول</button>
                        </li>
                    @endif
                </ul>

           
        </ul>
    </div><!-- /.container-fluid -->

</nav>

@yield('content')

<style>
footer {
    margin-top: 20px;
    background-color: hsl(0, 100%, 87%);
    border-top: 1px solid #3c3c3c;
    padding: 30px 20px 15px 20px;
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
    .titel-search {
    margin-top: 10px;
    padding: 3px 6px 5px;
    border-right: 3px solid #FF5722;
    background-color: #fff;
    cursor: pointer;
}
.title-page {
    padding-right: 10px;
    border-right: 5px solid #FF5722;
}
.ccount {
    font-size: 14px;
    background: #FF5722;}
    .ba{
        text-align: center;
        margin: 0 auto;
        display: block;
        padding: 8px 26px;
        font-size: 30px;
    }.f{font-size: 92%;}.f hr{border-color:#6a6a6a}
</style>
<footer style="    background-color: #FF5722;border:0;" class="contaner  col-md-12 center  notprint foot">

 

    <div style="color:#fff" class="col-md-12 f">
         Libyacv - 2020
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

<script type="text/javascript">
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/service-worker.js');
                initPush();
               
            });
        }

       
        function initPush() {
    if (!navigator.serviceWorker.ready) {
        return;
    }

    new Promise(function (resolve, reject) {
        const permissionResult = Notification.requestPermission(function (result) {
            resolve(result);
        });

        if (permissionResult) {
            permissionResult.then(resolve, reject);
        }
    })
        .then((permissionResult) => {
            if (permissionResult !== 'granted') {
                throw new Error('We weren\'t granted permission.');
            }
            subscribeUser();
        });
    }
        function subscribeUser() {
    navigator.serviceWorker.ready
        .then((registration) => {
            const subscribeOptions = {
                userVisibleOnly: true,
                applicationServerKey: urlBase64ToUint8Array(
                    'BMgTxvXcIQilJIU8qVxP-JeyuRM5d-RPEg-ZGtsIO9eUu2ru_7V0gBRh_Oq5sg8s0UkKMR5vAwWLmhY1GMc12vQ'
                )
            };

            return registration.pushManager.subscribe(subscribeOptions);
        })
        .then((pushSubscription) => {
            storePushSubscription(pushSubscription);
        });
}

function urlBase64ToUint8Array(base64String) {
    var padding = '='.repeat((4 - base64String.length % 4) % 4);
    var base64 = (base64String + padding)
        .replace(/\-/g, '+')
        .replace(/_/g, '/');

    var rawData = window.atob(base64);
    var outputArray = new Uint8Array(rawData.length);

    for (var i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}

function storePushSubscription(pushSubscription) {
    const token = document.querySelector('meta[name=csrf-token]').getAttribute('content');

    fetch('/push', {
        method: 'POST',
        body: JSON.stringify(pushSubscription),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-Token': token
        }
    })
        .then((res) => {
          //  return res.json();
        })
        .then((res) => {
          //  console.log(res)
        })
        .catch((err) => {
          //  console.log(err)
        });
}

    </script>
</body>
</html>