<!DOCTYPE html>
<html>
<head>
    <title>libyacv</title>

    <meta id="X-CSRF-TOKEN" content="{{ csrf_token() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-arabic.css')}}">
    <link rel="stylesheet" media="screen" type="text/css" href="{{asset('css/script.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('facebox.css')}}">

    <script    type="text/javascript" src="{{asset('js/facebox/jquery.js')}}"></script>


    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>

    <link rel="icon" type="image/png" href="{{asset('images/logos.png')}}">

    <img src="{{asset('images/ajax-loader.gif')}}" style="display:none;"/>

    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">

                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="\"><img style="width: 90px;" alt="شعار" src="{{asset('images/logo/lcv2.png')}}"/></a>
            <!-- <a href="#"><img class="logo" src="http://localhost/libyacv/public/images/logocv2.png"></a>-->
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <ul class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li><a href="/company/search">الشركات</a></li>
                <li><a href="/job/search">الوظائف </a></li>
                <li><a href="/cv/search">السير الذاتية</a></li>
                <li><a href="/exam">أختبارات</a></li>

            </ul>

            <div id="searchPage">
                {!! Form::open(array('class'=>'navbar-form navbar-left','url'=>'/search', 'method'=>'POST')) !!}


                <?php
                $str = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $last = explode("/", $str, 3);
                $s_url = 'السير الذاتية';
                $s_p = "البحث عن طريق اسم الباحث";

                $job = ($last[1] == 'job' ? 'الوظائف' : '');
                if (isset($last[1])) {
                    switch ($last[1]) {
                        case 'cv':
                        case 'user':
                            $s_url = 'السير الذاتية';
                            $s_p = "البحث عن طريق اسم الباحث";
                            break;
                        case 'company' :
                            $s_url = 'الشركات';
                            $s_p = "البحث عن طريق اسم الشركة";
                            break;
                        case 'job' :
                            $s_url = 'الوظائف';
                            $s_p = "البحث عن طريق اسم الوظيفة";
                            break;

                        case 'course' :
                            $s_url = 'الدورات';
                            $s_p = "البحث عن طريق اسم الدورة";
                            break;

                        default :
                            $s_url = 'السير الذاتية';
                            $s_p = "البحث عن طريق اسم الباحث";
                    }
                }
                ?>
                <div class="input-group">
                    <div class="input-group-btn">
                        <div class="search-dropdown">
                            <button class="button dropdown-toggle" type="button">
                                <span class="toggle-active" style="display: inline-block;">{{ $s_url }}</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">الوظائف</a></li>
                                <li><a href="#">الشركات</a></li>
                                <li><a href="#">الدورات</a></li>
                                <li class="menu-active"><a href="#">السير الذاتية</a></li>


                            </ul>
                        </div>
                    </div>

                    <input
                            class="form-control"
                            placeholder='{{ $s_p }}'
                            type="text"
                            name="keyword"

                            id="keyword"
                            autocomplete="off">
                    <input type="hidden" value="{{ $s_url }}" name="stringHide" id="stringHide" class="form-control">

                    <ul id="results" class="lists">

                    </ul>

                    <div class="input-group-btn">
                        <img id="s_l" class="sh" src="{{asset('images/ajax-loader.gif')}}"/>

                        <button type="submit" class="btn btn-success"><img class="search-img" alt="بحث"
                                                                           src="{{asset('images/web/search.png')}}"/>
                        </button>
                    </div>
                </div>


                {!! Form::close() !!}
            </div>

             <div id="topset">
                <ul class="nav navbar-nav navbar-right">
                    @if(!empty(session('seeker_id')))
                        <?php
                        $isArray=0;
                        if(is_int($notes) && session('count_note') != 0){
                            $isArray=1;
                        }
                        ?>
                        <span id="peta" style="display: none">{{$isArray}}</span>
                        <li class="dropdown"><span id="count" class="note">{{ session('count_note') }}</span>
                            <a href="javascript:void(0)" id="dropdown-notification"
                                                 onclick="myFunction('myNotification')" class="topicon">
                                <img height="36" width="36" src="{{asset('images/simple/alarm.png')}}"/>
                            </a>
                            <div id='myNotification' style="min-width: 186px;right: -20px" class="dropdown-content">
                               @if($isArray == 0)
                                <span><a> <div class="loading text-center">
                                    <img class="image" src="http://libyacv.dev/images/ajax-loader.gif">
                                    <span>الرجاء الإنتظار</span>
                                </div></a></span>
                                   @else
                                    @foreach($notes as $item)
                                       <span><a class="cu">{{ $item->data }}</a></span>
                                    @endforeach
                                    <span><a class='dani' href='/profile/notification'>مشاهدة كل الإشعارات</a></span>
                               @endif
                             </div>
                        </li>
                        <!-- <li class="dropdown"><a href="javascript:void(0)"  id="dropdown-la1ng" onclick="myFunction('myMsg')" class="icon-mail topicon"></a></li> -->

                        <li class="dropdown">
                            <a href="javascript:void(0)" id="dropdown-lang"
                                                onclick="myFunction('myLang')" class="topicon">
                                <img height="36" width="36" src="{{asset('images/simple/shopicon.png')}}"/>
                            </a>
                            <content id='myLang' style="left: -50px" class="dropdown-content">
                                <span> <a class="cu">رصيدك {{ session('price') }} درهم</a></span>

                                <span> <a href="/profile/store">تعبئة الرصيد</a></span>

                                <span> <a href="/profile/store">المتجر</a></span>
                            </content>
                        </li>

                        <li class="dropdown">
                            <a href="javascript:void(0)" id="dropdown-profile" class="dropbtn"
                               onclick="myFunction('myDropdown')"><img
                                        src="@if(session('image') != "") {{asset('images/seeker/40px_'.session('code_image') .'_'.session('image') )}} @else @if(session('gender') =='m') {{asset('images/simple/40px_male.png')}} @else {{asset('images/simple/40px_female.png')}}  @endif @endif">
                                <span class="caret"></span></a>
                            <div class="dropdown-content" style="left: -10px" id="myDropdown">
                                <span><a class="icon-newspaper" href="/profile"> السيرة الذاتية</a></span>
                                @if($myCompany != NULL )

                                        <span class="divider"></span>
                                        <span><a class="icon-building"
                                               href="/company-profile/{{ $myCompany->comp_user_name }}"> {{ str_limit($myCompany->comp_name, $limit = 15, $end = '...') }}</a>
                                        </span>
                                        <span><a class="icon-group"
                                               href="/company-profile/{{ $myCompany->comp_user_name }}/job-application">طلبات
                                                التوظيف</a></span>
                                        <li class="divider"></li>

                                @else
                                    <span><a class="icon-user" href="/create-company"> إنشاء شركة</a></span>
                                @endif
                                <span><a class="icon-user" href="/profile/job-application">طلبات التوظيف</a></span>
                                <span><a class="icon-cog-2" href="/profile/settings">الإعدادات</a></span>
                                <span><a class="icon-logout" href="/profile/logout"> تسجيل الخروج</a></span>
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
                            <button onclick="location.href = '/login';" class="btn btn-block btn-info">دخول</button>
                        </li>
                    @endif
                </ul>

            </div>
        </ul>
    </div><!-- /.container-fluid -->

</nav>

@yield('content')

<hr class="notprint">
<footer class="contaner notprint">
    <div style="text-align:center"><p>جميع الحقوق محفوظة لموقع Libyacv.com - 2016</p></div>

</footer>



<script type="text/javascript" src="{{asset('js/app.js')}} " async></script>
<script type="text/javascript" src="{{asset('js/jquery.circliful.min.js')}}"></script>

<script type="text/javascript" src="{{asset('js/facebox/facebox.js')}}" ></script>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('a[class*=facebox]').facebox({
            loadingImage: "{{asset('images/ajax-loader.gif')}}",
            closeImage: ''

        })
    });


</script>
<script type="text/javascript">
    $(function () {
        $('.circlestat').circliful();
    });
</script>
<script type="text/javascript" src="{{asset('js/index.js')}}"  ></script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->

</body>
</html>