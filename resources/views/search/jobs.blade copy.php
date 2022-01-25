@inject('company','App\Helpers\CompanyConstant')
<?php
$myCompany = $company->getCompany();
$notes = $company->getNote();
$titleCity=" في ليبيا"; //trans("page.job-search") .
$thejob="وظائف شاغرة ";
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
function is_english($str)
{
     if (preg_match('/[^\W_ ]/', $str)) // '/[^a-z\d]/i' should also work.
        return true;
    else
        return false;
}
    ?>
@extends('layouts.header')
@section('title',$titleCity.$titleDomain)
@section('keywords',"باحثين عن عمل, وظائف ليبيا, وظائف شاغرة بنغازي، وظائف شاغرة، عمل، طرابلس ،بنغازي، ليبيا ،libyacv ، وظيفة". $titleCity.",".$titleDomain)
@section('image',asset('images/logo/logofb.jpg'))
@section('url',Request::url())

@section('description',"وظائف شاغرة في ليبيا، الموقع الأول للوظائف الشاغرة، اطلع علي اخر الوظائف الموجودة في ليبيا وتحصل علي عمل داخل ليبيا")
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
        function ToggleShow(item,lnk){

            objItem = document.getElementById(item);
            myStyle = (objItem.style.display != "block");
            if(myStyle){
                objItem.style.display = "block";
                lnk.getElementsByTagName("span")[1].innerHTML  = "-";
            }else{
                lnk.getElementsByTagName("span")[1].innerHTML = "+";
                objItem.style.display = "none";
            }
        }
    </script>
    <?php
    $stringClearHref='';
    $cityClearHref='';
    $domainClearHref='';

   /* $companyClearHref = '';
    $edtClearHref = '';
    $statusClearHref = '';
    $typeClearHref='';
    $specClearHref='';*/

    $domainHref='';
    $allHref='';

    foreach($urls as $key => $value){
        if(empty($value) || $key =='page')
            continue;


        if($allHref == ''){
          //  $value = str_replace(" ", "-", $value);
            $allHref = '?'.$key.'='.$value;

            continue ;
        }
        //$value = str_replace(" ", "-", $value);
        $allHref = $allHref.'&'.$key.'='.$value;


    }

    ?>

    <div class="container">
        <div class="row">

            <div class="col-lg-3">
                <div class="nav-list">

                    <div id="search-value">
                        <div class="search-head">
                            <span class="menus ">حصر النتائج</span>

                        </div>

                        <div class="search-body">
                            @if(!empty($urls['string']))
                                <?php

                                foreach($urls as $key => $value){
                                    if(empty($value)  || $key =='string'|| $key== 'page')
                                        continue;

                                    if($stringClearHref == ''){
                                        $stringClearHref = '?'.$key.'='.$value;
                                        continue ;
                                    }
                                    $stringClearHref = $stringClearHref.'&'.$key.'='.$value;

                                }
                                ?>
                                <span>البحث</span><br>
                                <span class="find-value"> {{ $urls['string'] }}</span>  <a
                                        href="/job/search{{ $stringClearHref }}">إزالة</a><br>
                            @endif

                            @if(!empty($urls['city']))
                                <?php

                                foreach($urls as $key => $value){
                                    if(empty($value)  || $key =='city'|| $key== 'page')
                                        continue;

                                    if($cityClearHref == ''){
                                        $cityClearHref = '?'.$key.'='.$value;
                                        continue ;
                                    }
                                    $cityClearHref = $cityClearHref.'&'.$key.'='.$value;

                                }
                                ?>
                                <span>المدينة</span><br>
                                <span class="find-value"> {{ $urls['city'] }}</span>  <a
                                        href="/job/search{{ $cityClearHref }}">إزالة</a><br>
                            @endif

                            @if(!empty($urls['domain']))
                                <?php

                                foreach($urls as $key => $value){
                                    if(empty($value)  || $key =='domain'|| $key== 'page')
                                        continue;

                                    if($domainClearHref == ''){
                                        $domainClearHref = '?'.$key.'='.$value;
                                        continue ;
                                    }
                                    $domainClearHref = $domainClearHref.'&'.$key.'='.$value;

                                }
                                ?>
                                <span>المجال</span><br>
                                <span class="find-value"> {{ $urls['domain'] }}</span>  <a
                                        href="/job/search{{ $domainClearHref  }}">إزالة</a><br>
                            @endif



                        </div>
                    </div>

                    <div class="titel-search icon-location" onclick="javascript:ToggleShow('city',this);"><span>المدينة</span><span class="showing">+</span></div>
                    <div id="city" class="select_search" style="display: none;">
                        @if((!isset($_GET['city'])) || ($_GET['city']==""))

                            <?php  ?>
                            @foreach($city as $item )
                                <?php
                                $cityHref='';
                                 $cityName = $item->city_name ;
                                 foreach($urls as $key => $value){
                                    if((empty($value) && $key !='city') ||  $key== 'page')
                                        continue;


                                    if($key == 'city'){
                                        if($cityHref == ''){
                                            $cityHref = '?'.$key.'='.$cityName;
                                            continue ;
                                        }
                                        $cityHref = $cityHref.'&'.$key.'='.$cityName;
                                        continue ;

                                    }
                                    if($cityHref == ''){
                                        $cityHref = '?'.$key.'='.$value;

                                        continue ;
                                    }
                                    $cityHref = $cityHref.'&'.$key.'='.$value;


                                }

                                ?>
                                <a class="searcha"
                                   href="search{{  $cityHref }}">{{ $item->city_name }} <span style="float: left">[ {{ $item->city_count }} ]</span>
                                   </a>
                            @endforeach

                        @else
                            <?php
                            $cityClearHref='';

                            foreach($urls as $key => $value){
                                if(empty($value)  || $key =='city'|| $key== 'page')
                                    continue;

                                if($cityClearHref == ''){
                                    $cityClearHref = '?'.$key.'='.$value;
                                    continue ;
                                }
                                $cityClearHref = $cityClearHref.'&'.$key.'='.$value;

                            }
                            ?>
                            {{ $_GET['city'] }}   ( <a
                                    href="/job/search{{ $cityClearHref }}">إزالة</a>
                            )
                        @endif
                    </div>
                    <div class="titel-search icon-th"  onclick="javascript:ToggleShow('domain',this);"><span>المجال</span><span class="showing">+</span></div>
                    <div id="domain" class="select_search" style="display: none;">

                        @if((!isset($_GET['domain'])) || ($_GET['domain']==""))

                            @foreach($domain as $item)
                                <?php
                               // $domainName = str_replace(" ", "-", $item->domain_name);
                                $domainName =  $item->domain_name ;

                                $domainHref='';


                                foreach($urls as $key => $value){
                                    if((empty($value) && $key !='domain') ||  $key== 'page')
                                        continue;


                                    if($key == 'domain'){
                                        if($domainHref == ''){
                                            $domainHref = '?'.$key.'='.$domainName;
                                            continue ;
                                        }
                                        $domainHref = $domainHref.'&'.$key.'='.$domainName;
                                        continue ;

                                    }
                                    if($domainHref == ''){
                                        $domainHref = '?'.$key.'='.$value;

                                        continue ;
                                    }
                                    $domainHref = $domainHref.'&'.$key.'='.$value;


                                }

                                ?>

                                <a itemscope itemtype="search{{ $domainHref }}" itemprop="url"  class="searcha"
                                   href="search{{ $domainHref }}">{{ $item->domain_name }} <span style="float: left">[ {{ $item->domain_count }} ]</span>
                                    </a>

                            @endforeach
                        @else
                            {{ $urls['domain'] }}   ( <a
                                    href="search{{ $domainClearHref }}">إزالة</a>
                            )
                        @endif
                    </div>
                    <br>


                       


                </div>
           
            </div>
            
             <style>
                 .ltr{
                     direction: ltr;
                 }
                 .imgjob-view{
                     width: 66px;
                     height: 66px;
                   
                     padding: 4px;
                    /* border: 1px solid #bfbfbf;*/
                 }
                 .line{
                     line-height: 2.2;
                 }
                 #cvname {
                     font-size:15px;
                     line-height: 1.6;
                 }
             </style>



         <div class="col-lg-9">

<Style>
    .ccount{
        font-size: 14px;

        background: #F44336;
        color: #fff;

        margin-right: 8px;
        padding: 1px 12px;
        opacity: 0.8;

        border-radius: 6px;
    }
    .display{
       margin: 0px;
    }
</Style>
<br>
                <h1  style="display:inline-block" class="title-page">{{$titleCity}} {{$titleDomain}}</h1><span  class="ccount">{{$jobCount}} وظيفة </span>

 
                <div>
                    <?php
                    function make_slug($string, $separator = '-')
                    {
                    $string = trim($string);
                    $string = mb_strtolower($string, 'UTF-8');
                    $string = preg_replace("/[^a-z0-9_\s-ءاآؤئليةبپتثجچحخدذرزسشصضطظعغفقكکگلمنوهی]/u", '', $string);
                    $string = preg_replace("/[\s-_]+/", ' ', $string);
                    $string = preg_replace("/[\s_]/", $separator, $string);

                    return $string;
                    }
                    $iii=0;
                    ?>
                    <div id="IdResults">
                     @foreach($jobsArray as $jobArray )

                        <div class="job-div">
                            <div class="cv-body">
                                <div class="devimgseeker">
                          <a itemprop='name' title="{{$jobArray['job_name']}}" href="/job/{{$jobArray['desc_id']}}/{{make_slug($jobArray['job_name'])}}"><img alt="{{ $jobArray['comp_name'] }}" class="imgjob-view"
                                     src= @if($jobArray['image'] != ''){{asset('images/company/140px_'.$jobArray['image_code'].'_'.$jobArray['image'])}} @else {{asset('images/simple/140px_company.png')}} @endif /></a></div><div class="line">

                                            <h2  class="display"  @if(is_english($jobArray['job_name'])) style="direction: ltr" @endif><a title="{{$jobArray['job_name']}}" id="cvname" href="{{ $jobArray['desc_id'] }}/{{make_slug($jobArray['job_name'])}}">{{$jobArray['job_name']}}</a></h2>
                                           <span class="r"><span class="texts "><a class="icon-location {{ $jobArray['city_color'] }} " style="color: #FFFFFF;" href="?city={{ $jobArray['city_name'] }}">{{$jobArray['city_name']}}</a></span>
                                          <span class="texts"> <i class="icon-heart" ></i>{{ $jobArray['see_it'] }}</span> &nbsp;<span> {{$jobArray['job_start']}}</span></span>
                                </div>


</div>
</div>



@endforeach
                    </div>

                    <hr>
                    <div class="center">
                        @if(count($jobsArray) > 19 )
                            <button id="more" class="btn btn-lg  btn-default center"  onclick="showMore()"><span>مشاهدة المزيد  </span><img id="moreImg" style="display: none" src="{{asset('images/loading.gif')}}"/></button>
                        @else
                            <button id="more" class="btn btn-lg  btn-default center"  disabled ><span>إنتهت نتائج البحث  </span></button>

                        @endif

                       
                    </div>
                    <br>

                    <?php
                    $href= $allHref;

                    if ($href == ""){
                    $href = '?';
                    }
                    else{
                    $href = $href . '&';
                    }
                    ?>

                    <script type="text/javascript">
                        /*<a href="javascript:void(0)" class="icon-block t b" onclick="ShowModal('job',+this.desc_id+);"></a>*/
                        function allLetter(inputtxt)
                        {
                            var letters = /^[A-Za-z]+$/;
                            if(inputtxt.value.match(letters))
                            {
                                return true;
                            }
                            else
                            {
                                alert("message");
                                return false;
                            }
                        }

                        var pageNumber = 1;
                        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        function showMore () {
                            pageNumber++;
                            $("#more").prop("disabled", true);
                            $('#more span').text('الرجاء الإنتظار...');
                            $("#moreImg").show();
                            $.ajax({
                                type:'GET',
                                url: '/job/saerch<?php echo $href.'page='; ?>'+pageNumber+'',
                                data: {_token: CSRF_TOKEN},

                                success:function(data){
                                    var a=0;
                                     if(Object.keys(data).length > 0 ){
                                         ($.each(data.users, function () {
                                        var ss ="";
                                        var u = this.user_name;
                                        var sss = "";

                                        if(this.isstar ==1)
                                            sss="<span class='icon-star star'>مميز</span>";
                                        var s ='<div class="job-div"><div class="cv-body">'+
                                            '<div class="devimgseeker"><a title="'+this.job_name+'" href="/job/'+ this.desc_id +'/'+this.job_url+'"><img class="imgjob-view" src="'+ this.image+'" /></a></div> <div class="line"><h2 class="display '+this.dir+'"><a title="'+this.job_name+'" id="cvname" href="/job/'+this.desc_id+'/'+this.job_url+'">'+this.job_name+'</a>'+sss+'</h2><span class="r"><span class="texts  "><a style="color: #FFFFFF;" class="icon-location '+this.city_color +'" href="/job/search?city='+this.city_name+'">'+this.city_name+'</a></span></span>'+
                                            '<span class="icon-heart ">'+this.see_it+'</span>&nbsp;&nbsp;<span>'+this.job_start+'</span></div>';

                                        ss = s ;
                                        $("#IdResults").append(ss+"</div></div></div>");

                                             a++;
                                             if(a === 4 || a === 12){
                                                 console.log(a);
                                                 var ads ='<ins class="adsbygoogle" style="display:block; text-align:center;" data-ad-layout="in-article" data-ad-format="fluid" data-ad-client="ca-pub-9929016091047307" data-ad-slot="9694737710"></ins>';
                                                 $("#IdResults").append(ads);
                                             }
                                    }));
                                         if(a > 19){
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
</div>
<img id="loading" src="{{asset('images/loading.gif')}}" style="display: none" />
<a class="facebox" style="display: none"></a>
</div>
         
</div>
</div>
@stop