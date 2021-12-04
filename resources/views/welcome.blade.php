<?php $notes=null ?>
{{--@if( Auth::guard('users')->check()) @endif--}}
@inject('company','App\Helpers\CompanyConstant')
<?php
$notes = $company->getNote();
?>

@extends('layouts.header')
@section('title',trans("page.welcome"))
@section('keywords',trans("desc.keywords"))
@section('image',asset('images/simple/newlogo2.png'))
@section('url',trans('desc.url'))
@section('description',trans('desc.description'))

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 testimonials">
                <div class="col-md-12 testin" >
                <?php
 
                ?> 
                <div  @if( !Auth::guard('users')->check()) class="col-md-6 " @else class="col-md-12" @endif >


                                   <h1 class="center" style="font-size: 28px;    color:  #373737; ">وظائف شاغرة في </h1>
                    <p style="text-align: center;font-size: 17px; color: #373737;"><span itemprop="description">نشر وبحث عن وظائف شاغرة في ليبيا، وتصميم السيرة الذاتية باللغة العربية.</span></p>

                    <div style="display: block;text-align: center; margin-bottom: 8px">
                    <a  href='https://play.google.com/store/apps/details?id=libyacvpro.libya_cv'><img style="margin: 9px;" width="194px" alt='Get it on Google Play' src='{{ asset('images/simple/en_badge.png') }}'/></a>
                    <a href="https://facebook.com/LibyaCV" title="Facebook" style="    padding: 16px 16px;" class="btn btn-facebook btn-lg"><i class="icon-facebook-official"></i> تابعنا علي فيسبوك</a>
                    <a href="/donate" title="Facebook" style="/* padding: 16px 16px; */margin: 4px;" class="btn btn-default btn-lg"><span style="
                        font-size: 18px;font-weight: 500;">Donate cryptocurrency</span><br><img style="/* margin: 9px; */width: 60px;" width="194px" alt="Donate cryptocurrency" src="{{ asset('images/simple/clog.png') }}"> </a>
                    </div>
                 </div>
    @if( !Auth::guard('users')->check())
        <div class="col-md-6">

            <div class="centers">
                <style>
                    .centers-body{
                        padding: 10px;
                    }
                    .centers{
                        margin-top: 10px;
                        max-width: 390px;
                    }
                    .form-control1 {
                        display: block;
                        width: 100%;
                        height: 34px;
                        padding: 6px 6px;
                        font-size: 95%;
                        line-height: 1.42857143;
                        color: #555;
                        background-color: #fff;
                        background-image: none;
                        border: 1px solid #dfdfdf;
                        border-radius: 2px;}
                </style>


                <div class="centers-body">
                    <form method="POST" id="myForm122" action="/register/main"  accept-charset="UTF-8" class="form-style-2">
                        {{ csrf_field() }}

                        <div>

                            <table class="login-table" style="
    width: 100%;
">
                                <tbody>
                                <tr>

                                    <td style="
    width: 100%;
    text-align: center;
"><input type="text" id="fname" class="form-control1" autocomplete="off" name="fname" placeholder="الاسم" style="
    /* height: 40px; */
    margin-bottom: 5px;
    display: inline-block;
    width: 49%;
" /> <input id="lname" type="text" class="form-control1" name="lname" placeholder="اللقب" style="
    width: 49%;
    /* height: 36px; */
    display: inline-block;
    margin-bottom: 5px;
"/> </td>

                                </tr>

                                <tr>

                                    <td><input type="email"  autocomplete="off" class="form-control1" id="email" name="email" placeholder="البريد الإلكتروني" style="
    /* height: 40px; */
    margin-bottom: 5px;
    width: 100%;
"> </td>

                                </tr>

                                <tr>

                                    <td><input type="password" autocomplete="off" id="password" placeholder="الرقم السري" class="form-control1" name="password" style="
    /* height: 40px; */
    margin-bottom: 5px;
"></td>
                                </tr>
                                <tr>

                                </tr>
                                <tr>

                                    <td>   <input type="submit" value="إنشاء حساب" class="btn btn-block btn-success"/>
                                        <p style="margin-top: 4px;"> إذا لديك حساب اضغظ <a href="/login">دخول</a>  او <a href="/password/email">استعادة كلمة السر</a></p>
                                        <a href="/login/facebook" class="btn btn-face font-md btn-block icon-facebook-official"  >تسجيل عن طريق الفيسبوك</a>
                                        <a href="/login/google" class="btn   btn-block font-md  btn-danger icon-gplus-squared" >تسجيل عن طريق الجوجل</a>
                                    </td>

                                </tr>


                                </tbody>
                            </table>
                        </div>

                    </form>

                </div>
            </div>

        </div>
   @else
         <!--       <div class="col-md-6">

                <div class="centers">
<style>

    .ody{
        padding-bottom: 7px;
        background: #f3f3f3;
    }
    .ody span{
        font-size: 110%;
        padding: 4px 0;
        display: block;
        text-align: center;
    }
    .centers{
        max-width: 450px;
        border: 1px solid #c2c2c2;
    }
    .form-control1 {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 6px;
        font-size: 95%;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #dfdfdf;
        border-radius: 2px;}
    .pp{
        margin-bottom: 7px;
        border-bottom: 1px solid #d4d4d4;
        width: 100%;
    }
    .co{
        padding-top: 12px;
        font-size: 18px;
        background-color: #fdfdfd;
        border-bottom: 1px solid #ddd;
    }
    h2{
        font-size: 20px;
    }
    .co  .col-md-3:last-child {
        border-left: 0;
    }
    .co  .col-md-3 {
        border-left: 1px solid #dadada;
    }
</style>


                    <div class="ody" >
                        <img class="pp" src="{ { asset('images/simple/print.png') }}" />
                        <span >مثال على شكل السيرة الذاتية</span>

                   </div>
                </div>

                </div>-->
    @endif

            </div>

            </div>
            </div>
            </div>

            <style>
                .v{
                    margin: 15px 0;
                    padding: 0;
                    border: 0 solid #C2C2C1;
                    border-radius: .25rem;
                    box-shadow: 0 1px 3px 0 #f5f7f9, 0 0 0 1px #D4D4D5;
                }
                .v > a {
                    font-size: 100%;
                    color: #0480d3;
                }
                .v >  span {
                    color: #5d5d5d;
                    display: block;
                    font-size: 93%;
                }
                .v img{
                    width:100%;
                }
                mark {
                    font-size: 24px;
    color: inherit;
    padding: 0;
    background: none;
    /* background-image: linear-gradient(
-120deg
, rgba(255, 193, 7, 0.4) 0%, rgba(255, 193, 7, 0.4) 100%); */
    background-image: linear-gradient(
-120deg
, #ffe080 0%, #ffe080 100%);
    background-repeat: no-repeat;
    background-position: 100% 80%;
    position: relative;
    -webkit-animation-delay: 1s;
    animation-delay: 1s;
    background-size: 100% .3em;
}
            </style>
            <div class="container">


                <div class="row">
                    <br>
                    <br>


                    <h2 class="center"> <mark>المدن
                    </mark></h2>
                    <div  class="col-md-12   center oo sdh cont">

                          {!!html_entity_decode($dataCity)!!}



                    </div>



                    <div class="col-md-12 center oo sdh cont"><hr><br> </div>



                    <h2 class="center"> <mark>المجالات
                    </mark></h2>
                    <div  class="col-md-12 center oo sdh cont">

                        <?php echo $dataDomain ;?>


                    </div>
                </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                    <div class="col-lg-12 cs" >
                        <h3 class="center">خدماتنا</h3><span class="shr"></span>
                        <br>
                        <div class="row">

                            <div class="col-lg-12 center sdh">

                                <div class="col-lg-3">
                                    <div  class="sdh">
                                        <img src="{{ asset('images/home/jobs.png') }}" /><br></div>
                                    <h2>أنشر وظيفتك الشاغرة</h2><span class="shr"></span>
                                    <p>نمتلك قالب مميز وبسيط لكتابة الوظيفة الشاغرة، تستطيع من خلاله من نشر وظيفتك الشاغرة لكل زوار الموقع وتطبيق الاندرويد.</p>
                                </div>


                                <div class="col-lg-3">
                                    <div  class="sdh">
                                        <img src="{{ asset('images/home/application.png') }}" /><br>
                                    </div>
                                    <h2>تقدم  لوظيفتك الأن </h2><span class="shr"></span>
                                    <p>مايفصلك عن التقدم لأي وظيفة ضغظة زر فقط، بإمكانك التقدم لأي وظيفة ترغب بها من اي مكان من خلال الموقع او تطبيق الاندرويد.</p>
                                </div>

                                <div class="col-lg-3">
                                    <div class="sdh">
                                        <img src="{{ asset('images/home/cv_8.png') }}" /><br>
                                    </div>
                                    <h2>قم ببناء سيرتك المميزه </h2><span class="shr"></span>
                                    <p>يوفر لك النظـام قالب مميز ومتكامل وسهل الأستخـذام، وذلك لبنـاء سيرتك الذاتيـة مع تقديـم نصائح وتوجيهات وارشـادات في كيفية كتابتها.</p>
                                </div>

                                <div class="col-lg-3">
                                    <div class="sdh">
                                        <img src="{{ asset('images/home/printer.png') }}" /><br>
                                    </div>
                                    <h2>احتفظ بسيرتك الذاتية</h2><span class="shr"></span>
                                    <p>بإمكانك الحصول علي نسخة من سيرتك الذاتية بصيغة PDF سواء من خلال الموقع او تطبيق الاندرويد وذلك حتي تتمكن من ارسالها او طباعتها.</p>
                                </div>

                            </div>
                </div>
                </div>
                        <div id="counter" class="col-lg-12 hidden-xs hidden-sm center co sdh" >


                            <?php echo $dataStatic ;?>

                        </div>


                        <div class="col-lg-12 testimonials" >
                            <div  class="col-lg-8" style="    padding: 20px 5px;">
                                <h1 style="font-size: 34px">تطبيق ليبيا سـ فِ</h1><br><p style="font-size: 110%;">أحصل علي تطبيق [ ليبيا سي في ] من متجر قوقل للتطبيقات لتتمكن من الحصول علي خدمات التالية:- </p>
                                <ul>
                                    <li> إنشاء السيرة الذاتية من خلال تطبيق الاندرويد وامكانية طباعة السيرة بتصميم افضل.</li>
                                    <li> البحث عن كل الوظائف الشاغرة، في ليبيا.</li>
                                    <li> الحصول علي تنبيهات فورية علي جهازك عند وجود وظيفة شاغرة لشركة تتابعها.</li>
                                    <li> البحث عن الشركات ومعرفة خدماتها ومعلومات التواصل معها.</li>
                                    <li> إنشاء شركة وإضافة اعلانات توظيف والتحكم في طلبات التوظيف بكل سهولة.</li>
                                    <li> والكثير من الخدمات الاخري.</li>
                                </ul>

                                <a style="display: block;text-align: center;" href='https://play.google.com/store/apps/details?id=libyacvpro.libya_cv'><img style="margin: 9px;" width="194px" alt='Get it on Google Play' src='{{ asset('images/simple/en_badge.png') }}'/></a>

                            </div>
                                <div style="padding: 0 8px;
    height: 420px;
    /* text-align: center; */
    margin: 0 auto;" class="col-lg-4">
                                <img width="380" style="    bottom: 0px;
    width: 310px;
    position: absolute;
  " src="{{asset('images/libyacvapp5.png')}}" style="bottom: 0;position: absolute;" />
                                </div>


                        </div>
                        <div class="col-lg-12 " style="

    /* background: url('/images/new/cubes.png') left center repeat; */
    margin-top: 70px;
    margin-bottom: 10px;
    border-top: 0;
    background-color: #ffffff;
    ">

                            <style>

                                .ody{
                                    padding-bottom: 7px;
                                    background: #f3f3f3;

                                }
                                .ody span{
                                    font-size: 110%;
                                    padding: 4px 0;
                                    display: block;
                                    text-align: center;

                                }
                                .centerscv{
                                    max-width: 580px;
                                    border: 1px solid #c2c2c2;    margin: 0 auto;
                                }

                                .pp{
                                    margin-bottom: 7px;
                                    border-bottom: 1px solid #d4d4d4;
                                    width: 100%;
                                }
                                .co{
                                    padding-bottom: 30px;
                                    padding-top: 30px;
                                    font-size: 18px;
                                    background-color: #fdfdfd;
                                    border-bottom: 1px solid #ddd;
                                }


                            </style>
                            <div class="centerscv">



                                <div class="ody">
                                    <img class="pp" src="{{ asset('images/simple/print.png') }}">
                                    <span>مثال على شكل السيرة الذاتية</span>

                                </div>
                            </div>

                        </div>
                    </div>


     </div>
    <style>

        .btn-facebook {
            background: #3B5998;
            border-radius: 0;
            color: #fff;
            border-radius: 8px;
            border-width: 1px;
            border-style: solid;
            border-color: #263961;
        }
        .btn-facebook:link, .btn-facebook:visited {
            color: #fff;
        }
        .btn-facebook:active, .btn-facebook:hover {
            background: #263961;
            color: #fff;
        }
        .translate, .albida, .cleanhouse, .data, .delever,
        .docotor, .eng, .gr, .law, .lham,
        .media, .misrata, .money, .otherwork, .pitza,
        .sabha, .salesmaket, .sek, .skin, .tarhona,
        .tech, .zawia, .zlitn, .homs, .beng,
        .tripoli
        { max-width: 100%; background-size: 100%;   background-image: url('/images/simple/scc.jpg'); }

        .translate { background-position: 0 0%; background-size: 100%; }
        .albida { background-position: 0 4.007204%; background-size: 100.401606%; }
        .cleanhouse { background-position: 0 8.014408%; background-size: 100.401606%; }
        .data { background-position: 0 12.021612%; background-size: 100.401606%; }
        .delever { background-position: 0 16.028816%; background-size: 100.401606%; }
        .docotor { background-position: 0 20.03602%; background-size: 100.401606%; }
        .eng { background-position: 0 24.043224%; background-size: 100.401606%; }
        .gr { background-position: 0 28.050428%; background-size: 100.401606%; }
        .law { background-position: 0 32.014388%; background-size: 100.401606%; }
        .lham { background-position: 0 35.929761%; background-size: 100.401606%; }
        .media { background-position: 0 39.936965%; background-size: 100.401606%; }
        .misrata { background-position: 0 43.944169%; background-size: 100.401606%; }
        .money { background-position: 0 47.951373%; background-size: 100.401606%; }
        .otherwork { background-position: 0 51.958577%; background-size: 100.401606%; }
        .pitza { background-position: 0 55.965781%; background-size: 100.401606%; }
        .sabha { background-position: 0 59.972985%; background-size: 100.401606%; }
        .salesmaket { background-position: 0 63.980189%; background-size: 100.401606%; }
        .sek { background-position: 0 67.987393%; background-size: 100.401606%; }
        .skin { background-position: 0 71.994597%; background-size: 100.401606%; }
        .tarhona { background-position: 0 76.001801%; background-size: 100.401606%; }
        .tech { background-position: 0 80.009005%; background-size: 100.401606%; }
        .zawia { background-position: 0 84.016209%; background-size: 100.401606%; }
        .zlitn { background-position: 0 88.023413%; background-size: 100.401606%; }
        .homs { background-position: 0 91.989199%; background-size: 100.806452%; }
        .beng { background-position: 0 95.992796%; background-size: 101.626016%; }
        .tripoli { background-position: 0 100%; background-size: 101.626016%; }

    </style>
@stop
@section('last')
    <script type="text/javascript">

        function ToggleShow(item){

            objItem = document.getElementById(item);
            $('#'+item).slideToggle('slow');


        }
        const scrollTop = Math.max(window.pageYOffset, document.documentElement.scrollTop, document.body.scrollTop)

        var isLoading = true;
        $(function() {
            var oTop = $('#counter').offset().top - window.innerHeight;
            $(window).scroll(function(){

                if(isLoading){
                    var pTop =  Math.max(window.pageYOffset, document.documentElement.scrollTop, document.body.scrollTop)

                     if( pTop > oTop ){
                        start_count();
                        isLoading = false;
                    }
                }
            });
        });

        function start_count(){
            var target = 50;
            var number = 5;

            var interval = setInterval(function() {
                $('#number').text(number);
                if (number >= target) clearInterval(interval);
                number++;
            }, 8);
        }






    </script>

 @stop