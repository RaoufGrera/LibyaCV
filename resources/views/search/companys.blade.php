@inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();
$titleCity=" في ليبيا"; //trans("page.job-search") .
$thejob="شركات ";
if((isset($_GET['city'])) ){
    if(($_GET['city']!="")){
    $titleCity= "في ".  $_GET['city'];}
}
$titleDomain = "";
if((isset($_GET['domain'])) ){
    if(($_GET['domain']!="")){
        $titleCity= $thejob. "".  $_GET['domain']."" ." ".$titleCity;
    }
 } else{
            $titleCity = $thejob." ".$titleCity;}
?>
@extends('layouts.header')
@section('title',$titleCity.$titleDomain)
@section('keywords',trans("desc.keywords"))
@section('image',asset('images/logo/logofb.jpg'))
@section('url',Request::url())

@section('description',trans('desc.description'))
@section('curl',Request::url())

@section('content')
    <script data-ad-client="ca-pub-9929016091047307" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <script type="application/javascript">
        function Toggle(item) {
            objReq = document.getElementById(item);
            visible = (objReq.style.maxHeight != "500px");
            if (visible) {
                objReq.style.maxHeight = "500px";
            } else {
                objReq.style.maxHeight = "150px";
            }
        }

        function ToggleShow(item, lnk) {

            objItem = document.getElementById(item);
            myStyle = (objItem.style.display != "block");
            if (myStyle) {
                objItem.style.display = "block";
                lnk.getElementsByTagName("span")[1].innerHTML = "-";
            } else {
                lnk.getElementsByTagName("span")[1].innerHTML = "+";
                objItem.style.display = "none";
            }
        }
    </script>
    <?php
    $stringClearHref = '';
    $cityClearHref = '';
    $domainClearHref = '';
    $typeClearHref = '';

    $domainHref = '';
    $allHref = '';

    foreach ($urls as $key => $value) {
        if (empty($value) || $key == 'page')
            continue;


        if ($allHref == '') {
            $value = str_replace(" ", "-", $value);
            $allHref = '?' . $key . '=' . $value;

            continue;
        }
        $value = str_replace(" ", "-", $value);
        $allHref = $allHref . '&' . $key . '=' . $value;


    }

    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="nav-list">
                    <div id="search-value">
                        <div class="search-head">
                            <span class="menus ">حصر النتائج</span>

                        </div>

                        <div class="search-body">
                            @if(!empty($urls['string']))
                                <?php

                                foreach ($urls as $key => $value) {
                                    if (empty($value) || $key == 'string' || $key == 'page')
                                        continue;

                                    if ($stringClearHref == '') {
                                        $stringClearHref = '?' . $key . '=' . $value;
                                        continue;
                                    }
                                    $stringClearHref = $stringClearHref . '&' . $key . '=' . $value;

                                }
                                ?>
                                <span>البحث</span><br>
                                <span class="find-value"> {{ $urls['string'] }}</span>  <a
                                        href="/company/search{{ $stringClearHref }}">إزالة</a><br>
                            @endif

                            @if(!empty($urls['city']))
                                <?php

                                foreach ($urls as $key => $value) {
                                    if (empty($value) || $key == 'city' || $key == 'page')
                                        continue;

                                    if ($cityClearHref == '') {
                                        $cityClearHref = '?' . $key . '=' . $value;
                                        continue;
                                    }
                                    $cityClearHref = $cityClearHref . '&' . $key . '=' . $value;

                                }
                                ?>
                                <span>المدينة</span><br>
                                <span class="find-value"> {{ $urls['city'] }}</span>  <a
                                        href="/company/search{{ $cityClearHref }}">إزالة</a><br>
                            @endif

                            @if(!empty($urls['domain']))
                                <?php

                                foreach ($urls as $key => $value) {
                                    if (empty($value) || $key == 'domain' || $key == 'page')
                                        continue;

                                    if ($domainClearHref == '') {
                                        $domainClearHref = '?' . $key . '=' . $value;
                                        continue;
                                    }
                                    $domainClearHref = $domainClearHref . '&' . $key . '=' . $value;

                                }
                                ?>
                                <span>المجال</span><br>
                                <span class="find-value"> {{ $urls['domain'] }}</span>  <a
                                        href="/company/search{{ $domainClearHref  }}">إزالة</a><br>
                            @endif


                            @if(!empty($urls['type']))
                                <?php

                                foreach ($urls as $key => $value) {
                                    if (empty($value) || $key == 'type' || $key == 'page')
                                        continue;

                                    if ($typeClearHref == '') {
                                        $typeClearHref = '?' . $key . '=' . $value;
                                        continue;
                                    }
                                    $typeClearHref = $typeClearHref . '&' . $key . '=' . $value;

                                }
                                ?>
                                <span>القطاع</span><br>
                                <span class="find-value"> {{ $urls['type'] }}</span>  <a
                                        href="/company/search{{ $typeClearHref }}">إزالة</a><br>
                            @endif


                        </div>
                    </div>

                    <div>
                        <a href="/company/search" class="btn btn-danger btn-block">إزالة معايير البحث</a>
                    </div>
                    <br>
                    <div class="titel-search icon-location" onclick="javascript:ToggleShow('city',this);">
                        <span>المدينة</span><span class="showing">-</span></div>
                    <div id="city" class="select_search" style="display: block;">
                        @if((!isset($_GET['city'])) || ($_GET['city']==""))

                            @foreach($city as $row)
                                <?php
                                $cityHref = '';

                                $cityName = str_replace(" ", "-", $row->city_name);
                                foreach ($urls as $key => $value) {
                                    if ((empty($value) && $key != 'city') || $key == 'page')
                                        continue;


                                    if ($key == 'city') {
                                        if ($cityHref == '') {
                                            $cityHref = '?' . $key . '=' . $cityName;
                                            continue;
                                        }
                                        $cityHref = $cityHref . '&' . $key . '=' . $cityName;
                                        continue;

                                    }
                                    if ($cityHref == '') {
                                        $cityHref = '?' . $key . '=' . $value;

                                        continue;
                                    }
                                    $cityHref = $cityHref . '&' . $key . '=' . $value;


                                }

                                ?>
                                <a class="searcha"
                                   href="/company/search{{  $cityHref }}">{{ $row->city_name }}
                                <!--  <span class="a-count">  $row->city_count  </span>--> </a>
                            @endforeach

                        @else
                            {{ $_GET['city'] }}   ( <a
                                    href="/company/search{{ $cityClearHref }}">إزالة</a>
                            )
                        @endif
                    </div>
                    <div class="titel-search icon-th" onclick="javascript:ToggleShow('domain',this);">
                        <span>المجال</span><span class="showing">+</span></div>
                    <div id="domain" class="select_search" style="display: none;">

                        @if((!isset($_GET['domain'])) || ($_GET['domain']==""))

                            @foreach($domain as $row)
                                <?php
                                $domainName = str_replace(" ", "-", $row->domain_name);

                                $domainHref = '';


                                foreach ($urls as $key => $value) {
                                    if ((empty($value) && $key != 'domain') || $key == 'page')
                                        continue;


                                    if ($key == 'domain') {
                                        if ($domainHref == '') {
                                            $domainHref = '?' . $key . '=' . $domainName;
                                            continue;
                                        }
                                        $domainHref = $domainHref . '&' . $key . '=' . $domainName;
                                        continue;

                                    }
                                    if ($domainHref == '') {
                                        $domainHref = '?' . $key . '=' . $value;

                                        continue;
                                    }
                                    $domainHref = $domainHref . '&' . $key . '=' . $value;


                                }

                                ?>

                                <a class="searcha"
                                   href="/company/search{{ $domainHref }}">{{ $row->domain_name }}
                                <!-- <span class="a-count">  $row->domain_count }}</span>--></a>
                            @endforeach
                        @else
                            {{ $urls['domain'] }}   ( <a
                                    href="/company/search{{ $domainClearHref }}">إزالة</a>
                            )
                        @endif
                    </div>


                </div>
                <br>
                <h2 class="center">نماذج سيرة ذاتية</h2>

                <div class="col-lg-12">

                    <a href="/free-cv-template/english-resume">
                        <div class="divblog">
                            <img width="100%" src="{{asset('images/blog/cveng.png')}}">
                            <span class="spanblog"><h2 class="titleblog">Cool free english resume</h2> </span>
                        </div>
                    </a>
                    <br>
                    <a href="/files/template_arabic_cv/download">
                        <div class="divblog">
                            <img width="100%" src="{{asset('images/blog/template_arabic.jpg')}}">
                            <span class="spanblog"><h2 class="titleblog">Download - تحميل</h2> </span>
                        </div>
                    </a>


                </div><br>
                </div>

                <div class="col-md-6">


                    <style>
                        .ccount{
                            font-size: 14px;

                            background: #F44336;
                            color: #fff;

                            margin-right: 8px;
                            padding: 1px 12px;
                            opacity: 0.8;

                            border-radius: 6px;
                        }
                        .cv-body{
                            border-bottom: 1px solid #cecece;
                            padding: 10px;
                           /* background: #fffde7;*/
                            line-height: 1.9;
                        }
                        .pcomp{
                            border: 1px solid;
                            background: #fe9;
                            padding: 8px;
                            margin-top: 12px;
                            font-size: 13px;
                        }
                        tr{display: block}
                        hr{border-color:#333;}

                        .b{color: #3c3c3c}
                        .col-lg-6{padding: 8px}
                        .texts{
                            margin-left: 8px;}
                        .cv-body{
                            border: 1px solid #cecece;
                            margin-top: 10px;
                            display: grid;
                        }
                        .cv-body>div{
                            border-bottom: 1px solid #dbdbdb;
                            padding-bottom: 8px;
                        }
                        .view{
                            width: 90px;height: 90px;
                        }
.h2{margin: 0}
                    </style>

                    <h5 class="title-page"> الشركات<span  class="ccount">{{$jobCount}} شركة </span></h5>
                    <br>


                    <div class="col-md-12">

                        <div id="IdResults" >

                            @foreach($companyArray as $item )




                                <div class="col-md-12  ">
                                    <div class="cv-body " >

                                        <div href="/c/{{ $item['comp_user_name'] }}/#job" class="center">
                                            <a title="{{ $item['comp_name'] }}" href="/c/{{ $item['comp_user_name'] }}"><img class="view"
                                                                                              src= @if($item['image'] !=""){{asset('images/company/140px_'.$item['code_image'].'_'.$item['image'])}} @else {{asset('images/simple/140px_company.png')}} @endif /></a>
                                            </div>


                                                    <h2 class="display center"><a  id="cvname" href="/c/{{ $item['comp_user_name'] }}">{{$item['comp_name']}} </a> @if($item['isstar'] ==1) <span class="icon-star star">مميز</span> @endif </h2><a  class="icon-location {{ $item['city_color'] }} block" style="color: #FFFFFF;" href="?city={{ $item['city_name'] }}">{{$item['city_name']}}</a> <a class="icon-th block" style="color: #3c3c3c" href="?domain={{ $item['domain_name'] }}"> {{$item['domain_name']}}</a>
                                        @if( $item['phone'] != "")<span class="block icon-mobile"><span> {{ $item['phone'] }}</span> </span>@endif
                                        @if($item['email'] != "")<span class="block icon-mail">{{ $item['email'] }}</span> @endif
                                        @if($item['facebook']!= "" && $item['facebook']!= "https://facebook.com/")   <span class="block icon-facebook-official"><a  style="color: #333333;" href="{{ $item['facebook'] }}">{{ str_limit($item['facebook'], $limit = 26, $end = '...')  }}</a></span> @endif
                                        @if($item['url'] != "" && $item['url'] != "https://")     <a  style="color: #333333;" class="block icon-globe" href="{{ $item['url'] }}">{{ str_limit($item['url'], $limit = 26, $end = '...') }} </a>  @endif

                                        <span class="texts"> <i class="icon-heart" ></i>{{ $item['see_it'] }}</span>
                                        <a href="/c/{{ $item['comp_user_name'] }}/#job" class=" t"> <img class="ser" src="{{ Asset('images/home/ser.png') }}" /> {{$item['job_count']}}</a>



@if($item['services'] !="")
                                        <p class="pcomp">
                 {!! nl2br(e($item['services'])) !!}
                                        </p>
    @endif
</div>
                                </div>

@endforeach
</div>


                        <div class="col-lg-12">
                            <hr>
                            <br>

<div class="center">
@if(count($companyArray) > 9 )
<button id="more" class="btn btn-lg  btn-default center"  onclick="showMore()"><span>مشاهدة المزيد  </span><img id="moreImg" style="display: none" src="{{asset('images/loading.gif')}}"/></button>
@else
<button id="more" class="btn btn-lg  btn-default center"  disabled ><span>إنتهت نتائج البحث  </span></button>

@endif
</div>
                        </div>
<br>
<?php
$href = $allHref;

if ($href == "") {
$href = '?';
} else {
$href = $href . '&';
}
?>
<script type="text/javascript">

var pageNumber = 1;
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
function showMore () {
pageNumber++;
$("#more").prop("disabled", true);
$('#more span').text('الرجاء الإنتظار...');
$("#moreImg").show();
$.ajax({
type:'GET',
url: '/company/saerch<?php echo $href.'page='; ?>'+pageNumber+'',
data: {_token: CSRF_TOKEN},

success:function(data){
var a=0;
if(Object.keys(data).length > 0 ){
    ($.each(data.users, function () {
        var ss ="";
        var u = this.comp_user_name;
        var sss = "";

        if(this.isstar ==1)
            sss="<span class='icon-star star'>مميز</span>";
        var s =
            '<div class="col-md-12"><div class="cv-body"><div class="center" ><a href="/c/'+ this.comp_user_name +'"><img class=" view" src="'+ this.image+'" /></a></div><h2 class="display center"><a id="cvname" href="/c/'+this.comp_user_name+'">'+this.comp_name+'</a>'+sss+'</h2><a  class="icon-location '+this.city_color +'" style="color: #ffffff" href="?city='+this.city_name+'">'+this.city_name+'</a> &nbsp;&nbsp; <a class="icon-th " style="color: #3c3c3c;" href="?domain='+this.domain_name+'">'+this.domain_name+'</a>' +
            '<a href="/c/'+ this.comp_user_name +'/#job" class=" t b" ><img class="ser" src="/images/home/ser.png" />'+ this.job_count+'</a> <span class="texts b"> <i class="icon-heart" ></i>'+ this.see_it +'</span></div>';

        var p ="";
        if(this.services !== ""){
        p= '<p class="pcomp">'+ this.services +'</p>';
        }

        ss = s +p;
        $("#IdResults").append(ss+"</div>");

        a++;
    }));
    if(a > 9){
        $("#more").prop("disabled", false);
        $('#more span').text('مشاهدة المزيد');
    }else{
        $('#more span').text('إنتهت نتائج البحث');
    }
} else
{
    //   $("#IdResults").append("<br><span>خطاء لايمكن تحميل المزيد من النتائج </span>");
    $('#more span').text('إنتهت نتائج البحث');
}
$("#moreImg").hide();

}
});

}
</script>
<?php
/*
    $href = $allHref;
    if ($href == '')
        $href = '?';
    else
        $href = $href . '&';

    $pagination = "";
    $page = (isset($_GET['page']) ? $_GET['page'] : 1);
    $firstpage = 1;
    $lastpage = $page_count;
    $loopcounter = ((($page + 2) <= $lastpage) ? ($page + 2) : $lastpage);
    $startCounter = ((($page - 2) >= 3) ? ($page - 2) : 1);
    if ($page_count >= 1) {
        $get_herf_page = '';
        $pagination .= '<div class="pagen" >';
        if ($startCounter >= 3) {
            $pagination .= '<a  href="' . $_SERVER['PHP_SELF'] . '?page=1' . '&' . $get_herf_page . '">1</a>';
            $pagination .= " ... ";
        }


        for ($i = $startCounter; $i <= $loopcounter; $i++) {

            if ($page == $i)
                $pagination .= '<a class="current">' . $page . '</a>';
            else
                $pagination .= '<a href="search-company' . $href . 'page=' . $i . '">' . $i . '</a>';
        }
        if ($page <= $lastpage - 3) {
            $pagination .= " ... ";
            $pagination .= '<a href="search-company' . $href . 'page=' . $page_count . '">' . $page_count . '</a>';
        }
        $pagination .= '</div>';


    }
    echo $pagination;

*/
?>
</div>
<img id="loading" src="{{asset('images/loading.gif')}}" style="display: none"/>

<a class="facebox" style="display: none"></a>
</div>
            <div class="col-lg-3" style="border-right: 1px solid #ccc">
                <br>
                <h2 class="center">نماذج سيرة ذاتية</h2>

                <div class="col-lg-12">

                    <a href="/free-cv-template/english-resume">
                        <div class="divblog">
                            <img width="100%" src="{{asset('images/blog/cveng.png')}}">
                            <span class="spanblog"><h2 class="titleblog">Cool free english resume</h2> </span>
                        </div>
                    </a>
                    <br>
                    <a href="/files/free_resume_with_photo_english_grey/download">
                        <div class="divblog">
                            <img width="100%" src="{{asset('images/blog/template2.jpg')}}">
                            <span class="spanblog"><h2 class="titleblog">Download - تحميل</h2> </span>
                        </div>
                    </a>
                    <br>
                    <a href="/files/template_arabic_cv/download">
                        <div class="divblog">
                            <img width="100%" src="{{asset('images/blog/template_arabic.jpg')}}">
                            <span class="spanblog"><h2 class="titleblog">Download - تحميل</h2> </span>
                        </div>
                    </a>
                    <br>

                </div>
            </div>
</div>
<nav id="bottom" class="bottom t">
<span class="clicker   icon-up-open"></span>

</nav>
</div>
@stop