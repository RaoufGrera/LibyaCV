<!DOCTYPE html>
<html>
<head>
    <title>libyacv</title>

    <meta id="X-CSRF-TOKEN" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-arabic.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/script.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('facebox.css')}}">


    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no" />

    <link rel="icon" type="image/png" href="{{asset('images/logos.png')}}">

    <img src="{{asset('images/ajax-loader.gif')}}" style="display:none;" />

    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
</head>
<body>


<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="#"><img style="width: 110px;" src="{{asset('images/logo44.png')}}"/></a>
            <!-- <a href="#"><img class="logo" src="http://localhost/libyacv/public/images/logocv2.png"></a>-->
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <ul class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/job/search">الوظائف <span class="sr-only">(current)</span></a></li>
                <li><a href="/search-company">الشركات</a></li>
                <li><a href="/search-cv">الدورات</a></li>
                <li><a href="/cv/search">السير الذاتية</a></li>

            </ul>
            <div id="searchPage">
                {!! Form::open(array( "v-on"=>"submit: false",'class'=>'navbar-form navbar-left','url'=>Request::fullUrl(), 'method'=>'POST')) !!}
                <div class="input-group">
                    <div class="input-group-btn">
                        <div class="search-dropdown">
                            <button class="button dropdown-toggle" type="button">
                                <span class="toggle-active" style="display: inline-block;">السير الذاتية</span>
                                <span class="caret"></span>
                            </button>
                            <ul  class="dropdown-menu">
                                <li><a href="#">الوظائف</a></li>
                                <li><a href="#">الشركات</a></li>
                                <li><a href="#">الدورات</a></li>
                                <li  class="menu-active"><a href="#">السير الذاتية</a></li>


                            </ul>
                        </div> </div>

                    <input
                        class="form-control"

                        type="text"
                        name="string"
                        id="search-header"
                        placeholder="أبحث عن اسم الباحث ..."
                        v-model="query"

                        @keyup="search | debounce 500"
                        autocomplete="off">

                    <ul class="lists"  v-if="query.length >= 2" >

                        <li class="list-search " v-for="user in users">
                            <a href="@{{ user.user_name }}"><img :src="user.image"> @{{{ user.name }}}</a>
                        </li>
                        <li  class="list-search" v-if="query.length >= 2" v-show="users.length < 1">لاتوجد نتائج</li>

                    </ul>
                    <input type="hidden" value="السير الذاتية"  v-model="stringHide" name="stringHide" id="stringHide"  class="form-control"   >

                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-success"><img class="search-img" src="{{asset('images/search.png')}}" /></button>
                    </div>
                </div>


                {!! Form::close() !!}
            </div>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::guard('seekers')->check())
                <li class="dropdown">
                    <a href="javascript:void(0)" id="dropdown-profile" class="dropbtn" onclick="myFunction('myDropdown')">  {{ Auth::guard('seekers')->user()->user_name }}  <span class="caret"></span></a>
                    <div class="dropdown-content" id="myDropdown">
                        <a class="icon-user" href="/profile"> السيرة الذاتية</a>

                        @if((isset($myCompany)) && ($myCompany != NULL ))
                        @foreach($myCompany as $comp)
                        <a class="icon-group" href="/company/{{ $comp->comp_user_name }}"> {{ str_limit($comp->comp_name, $limit = 15, $end = '...') }}</a>
                        @endforeach
                        @else
                        <a class="icon-user" href="/create-company"> إنشاء شركة</a>
                        @endif

                        <a class="icon-logout" href="/profile/logout"> تسجيل الخروج</a>
                    </div>
                </li>
                @elseif(Auth::guard('employers')->check())
                <li class="dropdown">
                    <a href="javascript:void(0)" id="dropdown-profile" class="dropbtn" onclick="myFunction('myDropdown')">  {{ Auth::guard('employers')->user()->user_name }}  <span class="caret"></span></a>
                    <div class="dropdown-content" id="myDropdown">
                        <a href="/company"><img src="{{asset('images/profile.png')}}"/>  الملف الشخصي</a>
                        <a href="/company/logout"><img src="{{asset('images/logout.png')}}"/>  تسجيل الخروج</a>
                    </div>
                </li>
                @else
                <li><a href="/signup">تسجيل</a></li>
                <li><a href="/login">تسجيل الدخول</a></li>
                @endif
            </ul>
        </ul>

    </div><!-- /.container-fluid -->
</nav>

@yield('content')
<footer class="contaner">
    <div style="text-align:center"><p>footerrr</p></div>

</footer>

<script    type="text/javascript" src="{{asset('js/facebox/jquery.js')}}"></script>
<script    type="text/javascript" src="{{asset('js/vue.min.js')}}"></script>
<script    type="text/javascript" src="{{asset('js/vue-resource.min.js')}}"></script>
<script   type="text/javascript" src="{{asset('js/app.js')}}"></script>
<script   type="text/javascript" src="{{asset('js/jquery.circliful.min.js')}}"></script>

<script    type="text/javascript" src="{{asset('js/facebox/facebox.js')}}"></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('a[class*=facebox]').facebox({
            loadingImage : "{{asset('images/ajax-loader.gif')}}",
            closeImage   : ''

        })
    });


</script>
<script type="text/javascript">
    $(function(){
        $('.circlestat').circliful();
    });
</script>
<script type="text/javascript" src="{{asset('js/index.js')}}"></script>
</body>
</html>