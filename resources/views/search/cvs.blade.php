 @inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();
//$titleCity=trans("page.cv-search") . " في ليبيا";
$titleCity=" في ليبيا"; //trans("page.job-search") .
$thejob="باحثين عن عمل ";
if((isset($_GET['city'])) )
    if(($_GET['city']!=""))
        $titleCity= "في ".  $_GET['city'];
$titleDomain = "";
if((isset($_GET['domain'])) ){
    if(($_GET['domain']!="")){
        $titleCity= $thejob. "".  $_GET['domain']."" ." ".$titleCity;}
    }else{$titleCity = $thejob." ".$titleCity;}
?>

@extends('layouts.header')
 @section('title',$titleCity.$titleDomain)
  @section('keywords',"قانوني , موظفين, موظف, موظفين ليبيا, مهندسين, اطباء،, ليبين، سيرة ذاتية، مترجم". $titleCity.",".$titleDomain)
 @section('image',asset('images/logo/logofb.jpg'))
 @section('url',Request::url())
 @section('description',"قاعدة بيانات باحثين عن عمل في ليبيا، اطلع علي كل السير الذاتية في ليبيا")
 @section('curl',Request::url())

 @section('content')
     <script data-ad-client="ca-pub-9929016091047307" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

     <img id="loading" src="{{asset('images/loading.gif')}}" style="display: none" />
<style>
    .icv{ width: 20px; margin-top: -2px;}

</style>
    <script type="application/javascript">
        function Toggle(item) {
            objReq = document.getElementById(item);
            visible = (objReq.style.maxHeight != "100%");
            if (visible) {
                objReq.style.maxHeight = "100%";
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

    $stringClearHref = '';
    $cityClearHref = '';
    $univClearHref = '';
    $facultyClearHref = '';
    $specEdClearHref = '';
    $domainClearHref = '';
    $specClearHref = '';
    $educationClearHref = '';
    $companyClearHref = '';
    $genderClearHref = '';
    $natClearHref = '';
    $expClearHref = '';
    $ageClearHref = '';
    $domainHref = '';
    $domainHref = '';
    $allHref = '';

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
                                        href="/cv/search/{{ $stringClearHref }}">إزالة</a><br>
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
                                            href="/cv/search{{ $cityClearHref }}">إزالة</a><br>
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
                                            href="/cv/search{{ $domainClearHref  }}">إزالة</a><br>
                                @endif

                            @if(!empty($urls['education']))
                                <?php
                                    foreach($urls as $key => $value){
                                        if(empty($value)  || $key =='education'|| $key== 'page')
                                            continue;

                                        if($educationClearHref == ''){
                                            $educationClearHref = '?'.$key.'='.$value;
                                            continue ;
                                        }
                                        $educationClearHref = $educationClearHref.'&'.$key.'='.$value;

                                    }
                                    ?>

                                <span>المؤهل العلمي</span><br>
                                <span class="find-value"> {{ $urls['education'] }}</span>  <a
                                        href="/cv/search{{ $educationClearHref }}">إزالة</a><br>
                            @endif



                        </div>
                    </div>



                    <div>
                        <a href="/cv/search" class="btn btn-danger btn-block">إزالة معايير البحث</a>
                    </div><br>
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
                                    href="/cv/search{{ $cityClearHref }}">إزالة</a>
                            )
                        @endif
                    </div>
                    <div class="titel-search icon-th"  onclick="javascript:ToggleShow('domain',this);"><span>المجال</span><span class="showing">+</span></div>
                    <div id="domain" class="select_search" style="display: none;">

                        @if((!isset($_GET['domain'])) || ($_GET['domain']==""))

                            @foreach($domain as $item)
                                <?php
                                $domainName = str_replace(" ", "-", $item->domain_name);

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

                                <a class="searcha"
                                   href="search{{ $domainHref }}">{{ $item->domain_name }} <span style="float: left">[ {{ $item->domain_count }} ]</span>
                                </a>
                            @endforeach
                        @else
                            {{ $urls['domain'] }}   ( <a
                                    href="search{{ $domainClearHref }}">إزالة</a>
                            )
                        @endif
                    </div>



                    <div onclick="javascript:ToggleShow('education',this);" class="titel-search icon-graduation-cap">&nbsp;<span>المؤهل العلمي</span><span class="showing">+</span></div>
                    <div id="education" class="select_search" style="display: none;">

                        @if((!isset($_GET['education'])) || ($_GET['education']==""))


                            @foreach($education as $item)
                                <?php



                                $educationHref = '';


                                foreach($urls as $key => $value){
                                if((empty($value) && $key !='education') ||  $key== 'page')
                                continue;


                                if($key == 'education'){
                                if($educationHref == ''){
                                $educationHref = '?'.$key.'='.$item->edt_name;
                                continue ;
                                }
                                $educationHref = $educationHref.'&'.$key.'='.$item->edt_name;
                                continue ;

                                }
                                if($educationHref == ''){
                                $educationHref = '?'.$key.'='.$value;

                                continue ;
                                }
                                $educationHref = $educationHref.'&'.$key.'='.$value;


                                }

                                ?>
                                <a class="searcha"
                                   href="/cv/search{{ $educationHref }}">{{ $item->edt_name }} <span style="float: left">[ {{ $item->edt_count }} ]</span></a>
                            @endforeach

                        @else
                            <span class="searchRemove">{{ $urls['education'] }} ( <a
                                        href="/cv/search{{ $educationClearHref }}">إزالة</a>
                            )</span>
                        @endif


                    </div>
<br>

                </div>
                

                <br>
            </div>
<style>

    h1{ margin: 0;}
</style>
            <div class="col-lg-9">
<br>
                <h1 style="margin-top: 15px;margin-bottom: 15px" class="title-page">{{$titleCity}} {{$titleDomain}}</h1>


                <div>

                    <div id="SeekerResults">
                        <?php $counter = 0; ?>
                        @foreach($seekersArray as $seekerArray)
                            <?php $counter ++;
                            if($counter == 6 || $counter == 12){
                                ?>

                                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                <!-- Main -->
                                <ins class="adsbygoogle"
                                     style="display:block"
                                     data-ad-client="ca-pub-9929016091047307"
                                     data-ad-slot="4050134570"
                                     data-ad-format="auto"
                                     data-full-width-responsive="true"></ins>
                                <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                            <?php
                                } ?>
                                <div class="cv-div">


                                <div class="cv-body">
                                    {{-- <a  href="javascript:void(0)" class="icon-block t b" onclick="ShowModal('cv','{{$seekerArray['user_name']}}');"></a>--}}
                                    <div class="devimgseeker">
                                        <a title="{{ $seekerArray['fname'] }} {{ $seekerArray['lname'] }}" href="/user/{{ $seekerArray['user_name'] }}"><img class="imgseeker-view"
                                                                                             src= @if($seekerArray["image"] != ""){{asset('images/seeker/140px_'.$seekerArray["code_image"] .'_'.$seekerArray["image"] )}} @else @if($seekerArray['gender'] =='m') {{asset('images/simple/140px_male.png')}} @else {{asset('images/simple/140px_female.png')}}  @endif @endif /></a>
                                         </div>
                                    <table><tr> <td height="30"><h2 ><a title="{{ $seekerArray['fname'] }} {{ $seekerArray['lname'] }}" id="cvname"
                                                                                      href="/user/{{ $seekerArray['user_name'] }}">@if($seekerArray['hide_cv'] == 0) {{ $seekerArray['fname'] }} {{ $seekerArray['lname'] }} @else السيرة الذاتية مخفية @endif </a></h2>
                                                <span class="texts">{{ $seekerArray['about']  }} &nbsp;</span><hr></td></tr><tr>
                                            <td><span class="icon-heart" >{{ $seekerArray['see_it'] }} </span> <span class="r"><span><a href="?domain={{$seekerArray['domain_name']}}" class="icon-th ">{{ $seekerArray['domain_name'] }}</a></span> <span ><a href="?education={{ $seekerArray['edt_name'] }}" class="icon-graduation-cap"> {{ $seekerArray['edt_name'] }}</a></span>


                                                <span ><a class="icon-location" href="?city={{ $seekerArray['city_name'] }}">{{ $seekerArray['city_name'] }}  </a>   @if($seekerArray['address'] != "" && $seekerArray['address'] != " " )
                                                    <span>  - {{ $seekerArray['address'] }}  </span>
                                                @endif
                                                </span>
                                                    @if($seekerArray['services_count'] !=0) <span><img src="{{ Asset('images/home/ser.png') }}" class="icv"> {{ $seekerArray['services_count'] }} </span> @endif
                                                </span>
                                            </td>

                                        </tr>

                                    </table>
@if(count($seekerArray['spec']) !=0)
                                    <div class="skills">


                                        @foreach($seekerArray['spec'] as $index => $code )
                                            <?php
                                            $code_id = substr($code, stripos($code, "-")+1, strlen($code));
                                            $code_count = substr($code,0,stripos($code, "-"));

                                            ?>
                                            <div><a  onclick="ShowSpecs('{{ $seekerArray['user_name'] }}','{{ $code_id }}');" class="bs bc">{{ $code_count }}</a><span class="bsv bf"> {{ $index  }} </span></div>
                                        @endforeach
                                    </div>
    @endif
                                </div></div>
                        @endforeach
                    </div>

                    <hr>
                    <div class="center">
                        @if(count($seekersArray) > 19 )
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

                        var pageNumber = 1;


                        var CSRF_TOKEN = document.querySelector("meta[name='csrf-token']").getAttribute("content");
                        function showMore () {
                            pageNumber++;
                            $("#more").prop("disabled", true);
                        $("#moreImg").show();
                            $.ajax({
                                type:'GET',
                                url: '/cv/saerch<?php echo $href.'page='; ?>'+pageNumber+'',
                                data: {_token: CSRF_TOKEN},

                                 success:function(data){
                                     var a=0;
                                     if(Object.keys(data).length > 0 ){
                                         ($.each(data.users, function () {                                         var ss ="";
                                         var u = this.user_name;
                                         var l = (this.services_count != 0) ? '<span><img class="icv" src="https://www.libyacv.com/images/home/ser.png">'+ this.services_count +'</span>' : "";
                                         var s ='<div class="cv-div"><div class="cv-body">'+
                                             '<div class="devimgseeker"><a title="'+this.fname+' '+ this.lname+'" href="/user/'+ this.user_name +'"><img class="imgseeker-view" src="'+ this.image+'" /></a></div> <table><tr> <td height="30"><h2 ><a title="'+this.fname+' '+ this.lname+'" id="cvname" href="/user/'+this.user_name+'">'+this.fname+' '+ this.lname+'</a></h2><span class="texts">'+this.about+' &nbsp;</span><hr></td></tr><tr>'+
                                             '<td><span class="icon-heart" >'+ this.see_it+'</span><span class="r"><span><a  class="icon-th f14" href="?domain='+ this.domain_name +'">'+this.domain_name+'</a></span><span ><a class="icon-graduation-cap" href="?education='+this.edt_name+'">'+this.edt_name+'</a></span><span><a  class="icon-location" href="?city='+this.city_name+'">'+this.city_name+'</a></span><span>'+this.address+'</span>'+l+'</span></td> </tr></table>';
                                         if(Object.keys(this.spec).length !=0){
                                             ss=ss+'<div class="skills"> ';
                                             $.each(this.spec, function(k, v) {
                                                 //display the key and value pair
                                                 var i =v.substr(v.indexOf("-")+1, v.strlen);
                                                 var c = v.substr(0,v.indexOf("-"));
                                                  ss = ss+' <div><a onclick="ShowSpecs(\''+u+'\',\''+ i +'\');" class="bs bc">'+c+'</a><span class="bsv bf">'+k+'</span></div>'
                                             });
                                             ss=ss+'</div>';
                                         }
                                         ss = s+ss;
                                         $("#SeekerResults").append(ss+"</div></div>");

                                             a++;
                                         }));
                                         if(a > 19){
                                             $("#more").prop("disabled", false);
                                             $('#more span').text('مشاهدة المزيد');
                                         }else{
                                             $('#more span').text('ليس لديك صلاحية لرؤية نتائج اكثر');
                                         }
                                     } else
                                     {
                                         //   $("#IdResults").append("<br><span>خطاء لايمكن تحميل المزيد من النتائج </span>");
                                         $('#more span').text('ليس لديك صلاحية لرؤية نتائج اكثر');
                                     }
                                     $("#moreImg").hide();

                                 }
                            });

                        }
                    </script>

                    <a class="facebox" style="display: none"></a>
                </div>

            </div>
           
            <nav id="bottom" class="bottom t">
                <span class="clicker   icon-up-open"></span>

            </nav>
        </div>
    </div>

@stop