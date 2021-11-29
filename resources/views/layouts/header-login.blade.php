<!DOCTYPE html>
<html>
<head>
    <title>libyacv</title>
    <meta charset="utf-8" />
    <meta property="og:url"           content="http://www.libyacv.com/sara" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="باحث عن عمل اسمه محمد" />
    <meta property="og:description"   content="Your description" />
    <meta property="og:image"         content="{{asset('images/1.jpeg')}}" />

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-arabic.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/script.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('facebox.css')}}">


    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no" />







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
                <li><a href="#">الوظائف <span class="sr-only">(current)</span></a></li>
                <li><a href="search-cv">الشركات</a></li>
                <li><a href="search-cv">الدورات</a></li>
                <li><a href="search-cv">السير الذاتية</a></li>

            </ul>
            {!! Form::open(array( 'class'=>'navbar-form navbar-left','url'=>Request::fullUrl(), 'method'=>'GET')) !!}
            <div class="input-group">
                <div class="input-group-btn">
                    <div class="search-dropdown">
                        <button class="button dropdown-toggle" type="button">
                            <span class="toggle-active" style="display: inline-block;">الوظائف</span>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li class="menu-active"><a href="#">الوظائف</a></li>
                            <li><a href="#">الشركات</a></li>
                            <li><a href="#">الدورات</a></li>
                            <li><a href="#">السير الذاتية</a></li>


                        </ul>
                    </div> </div>
                <input    type="text"  name="string" id="search-header" placeholder="أبحث عن وظائف ..." class="form-control" >
                <input   type="hidden" name="string-hide" id="search-hide" class="form-control" >

                <div class="input-group-btn">
                    <button type="submit" class="btn btn-success"><img class="search-img" src="{{asset('images/search.png')}}" /></button>
                </div>

            </div>


            {!! Form::close() !!}

            <ul class="nav navbar-nav navbar-right">
                @if(Auth::guard('seekers')->check())
                    <li class="dropdown">
                        <a href="javascript:void(0)" id="dropdown-profile" class="dropbtn" onclick="myFunction('myDropdown')">  {{ Auth::guard('seekers')->user()->user_name }}  <span class="caret"></span></a>
                        <div class="dropdown-content" id="myDropdown">
                            <a href="profile"><img src="{{asset('images/profile.png')}}"/>  الملف الشخصي</a>
                            <a href="profile/logout"><img src="{{asset('images/logout.png')}}"/>  تسجيل الخروج</a>
                        </div>
                    </li>
                @else
                    <li><a href="signup/user-type">تسجيل</a></li>
                    <li><a href="login">تسجيل الدخول</a></li>
                @endif
            </ul>
        </ul>

    </div><!-- /.container-fluid -->
</nav>

@yield('content')
<footer class="contaner">
    <div style="text-align:center"><p>footerrr</p></div>

</footer>

<script type="text/javascript" src="{{asset('js/index.js')}}"></script>
</body>
</html>