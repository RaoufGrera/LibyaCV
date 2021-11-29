<div class="col-md-3">

    <ul class="nav nav-list">




      <!--  <li><a class="btn btn-default btn-block icon-download-alt" href="/profile/download">تحميل السيرة الذاتية</a> </li>-->
        @if(basename($_SERVER['REQUEST_URI']) == 'profile')
       <!-- <li><span><a  href="/profile/download"  class="btn btn-danger btn-block icon-download-alt"  >تحميل السيرة الذاتية   <img src="{{ asset('images/home/printer.png') }}" /></a> </span></li> -->
        @endif

        <br>
        <li><a href="/profile/dashboard"><img src="{{ Asset('images/home/home30.png') }}"> {{ trans("page.dashboard") }}</a></li>

        <!--<li><a href="/dashboard" class="icon-connectdevelop">لوحة الأعدادات</a></li>-->
        <li><a href="/profile" ><img src="{{ Asset('images/home/cv30.png') }}"> {{ trans("page.profile") }}</a></li>
       {{-- <li><a href="/profile/services" ><img src="{{ Asset('images/home/services.png') }}"> خدماتي</a></li>--}}
        @if(basename($_SERVER['REQUEST_URI']) == 'profile')
       <!-- <ul class="listcv"><li><a href="#contact" class="icon-share">معلومات الأتصال</a></li><li><a href="#golas" class="icon-award">الهدف الوظيفي</a></li><li><a href="#education" class="icon-graduation-cap">المؤهل العلمي</a></li><li><a href="#experience" class="icon-briefcase">الخبرة</a></li><li><a href="#language" class="icon-globe">اللغات</a></li><li><a href="#specialtys" class="icon-sitemap">التخصصات</a></li><li><a href="#skills" class="icon-tasks">المهارات</a></li><li><a href="#certificate" class="icon-newspaper">الشهادات</a></li><li><a href="#training" class="icon-vcard">التدريب والدورات</a></li><li><a href="#hobby" class="icon-brush">الهوايات</a></li> <li><a href="#info" class="icon-info">معلومات إضافية</a></li></ul>-->
        @endif

{{--    <li>
     <a href="/profile/profile-visibility" ><img src="{{ Asset('images/home/glass.png') }}"> {{ trans("page.visibility") }}</a>
 </li>
 <li>
     <a href="/profile/settings" ><img src="{{ Asset('images/home/settings30.png') }}">{{ trans("page.setting") }}</a>
 </li>--}}


 @if(session('user_name_company') != "" )

     <li><a href="/company-profile/{{ session('user_name_company') }}/" ><img src="{{ Asset('images/home/mycomp.png') }}"> الشركة ( {{ session('user_name_company') }} )</a></li>
     <li  ><a href="/company-profile/{{ session('user_name_company') }}/job/create" ><img src="{{ Asset('images/home/addjobs.png') }}"> أعلن عن وظيفة </a></li>

     <li><a href="/company-profile/{{ session('user_name_company') }}/job/" ><img src="{{ Asset('images/home/list.png') }}"> إدارة الوظائف </a></li>
     <br>
     @else
     <li>
         <a class="icon-building" href="/create-company">إضافة شركة</a>
     </li>
 @endif





</ul>
<style>
 .nav-list{
     padding: 20px 12px 0 0 ;
 }
 .nav-list > li {
     border-bottom: 1px solid #eee;
 }
  li img{
     width: 26px;
     margin-left: 10px;
 }
</style>

</div>