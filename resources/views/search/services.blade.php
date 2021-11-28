@inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();
$titleCity=trans("page.company-search") . " في ليبيا";
if((isset($_GET['city'])) )
    if(($_GET['city']!=""))
    $titleCity= "شركات في ".  $_GET['city'];
$titleDomain = "";
if((isset($_GET['domain'])) )
    if(($_GET['domain']!=""))
        $titleCity= " - ".  $_GET['domain'];
?>
@extends('layouts.header')
@section('title',$titleCity.$titleDomain)
@section('keywords',trans("desc.keywords"))
@section('image',asset('images/logo/logofb.jpg'))
@section('url',trans('desc.url'))
@section('description',trans('desc.description'))

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
            <div class="col-lg-3">
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
                                        href="/services/search{{ $cityClearHref }}">إزالة</a><br>
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
                                        href="/services/search{{ $domainClearHref  }}">إزالة</a><br>
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
                                        href="/services/search{{ $typeClearHref }}">إزالة</a><br>
                            @endif


                        </div>
                    </div>

                    <div>
                        <a href="/services/search" class="btn btn-danger btn-block">إزالة معايير البحث</a>
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
                                   href="/services/search{{  $cityHref }}">{{ $row->city_name }}
                                <!--  <span class="a-count">  $row->city_count  </span>--> </a>
                            @endforeach

                        @else
                            {{ $_GET['city'] }}   ( <a
                                    href="/services/search{{ $cityClearHref }}">إزالة</a>
                            )
                        @endif
                    </div>

                    <div id="domain" class="select_search" style="display: block;">

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
                                   href="/services/search{{ $domainHref }}">{{ $row->domain_name }}
                                <!-- <span class="a-count">  $row->domain_count }}</span>--></a>
                            @endforeach
                        @else
                            {{ $urls['domain'] }}   ( <a
                                    href="/services/search{{ $domainClearHref }}">إزالة</a>
                            )
                        @endif
                    </div>


                </div>
                </div>

                <div class="col-lg-9">


                    <br>
                    <h5 class="title-page"> الخدمات</h5>
                    <br>


                    <div>
                        <div id="IdResults">

                            @foreach($companyArray as $row )


                                <div class="cv-div">
                                <div class="cv-body" style="font-size: 95%">
                                    <div class="devimgseeker">
                                        <a href="/services/{{ $row['services_id'] }}"><img class="imgseeker-view"
                                                                                         src= "{{$row['image'] }}" /></a>
                                    </div>
                                    <table><tr> <td height="30"><span ><a id="cvname"
                                                                          href="/services/{{ $row['services_id'] }}"> {{ $row['title']}} </a></span><br>
                                                <span class="texts" >{{ $row['body']  }} &nbsp;</span><hr></td></tr><tr>
                                            <td>
                                 <span ><a class="icon-user" href="/user/{{ $row['user_name']  }}">{{ $row['fname']  }}  </a>
                                                </span>
                                                <span class="r"><span><a href="?domain={{$row['domain_name']}}" class="icon-th ">{{$row['domain_name']   }}</a></span>


                                                <span ><a class="icon-location" href="?city={{ $row['city_name']  }}">{{ $row['city_name']  }}  </a>
                                                </span>

                                                </span>
                                            </td>

                                        </tr>

                                    </table>

                                </div></div>


                    @endforeach
                        </div>

                        <hr>
                        <div class="center">
                            @if(count($companyArray) > 9 )
                            <button id="more" class="btn btn-lg  btn-default center"  onclick="showMore()"><span>مشاهدة المزيد  </span><img id="moreImg" style="display: none" src="{{asset('images/loading.gif')}}"/></button>
                      @else
                                <button id="more" class="btn btn-lg  btn-default center"  disabled ><span>إنتهت نتائج البحث  </span></button>

                            @endif
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
                        var CSRF_TOKEN = document.querySelector("meta[name='csrf-token']").getAttribute("content");
                        function showMore () {
                            pageNumber++;
                            $("#more").prop("disabled", true);
                            $('#more span').text('الرجاء الإنتظار...');
                            $("#moreImg").show();
                            $.ajax({
                                type:'GET',
                                url: '/services/saerch<?php echo $href.'page='; ?>'+pageNumber+'',
                                data: {_token: CSRF_TOKEN},

                                success:function(data){
                                    var a=0;
                                    if(Object.keys(data).length > 0 ){
                                        ($.each(data.users, function () {
                                            var ss ="";
                                             var sss =  '<span class="texts" >'+this.body+'</span>';


                                             var n = '<span><a class="icon-user" href="/user/'+this.user_name+'">'+this.fname+'</a><span>';
                                            var s ='<div class="cv-div"><div class="cv-body">'+
                                                '<div class="devimgseeker"><a href="/services/'+ this.services_id +'"><img class="imgseeker-view" src="'+ this.image+'" /></a></div> <table class="line"><tr> <td><span class="display"><a id="cvname" href="/c/'+this.services_id+'">'+this.title+'</a><br>'+sss+'<hr></span>'+n+'&nbsp;&nbsp; <a class="icon-th " href="?domain='+this.domain_name+'">'+this.domain_name+'</a>&nbsp;<a  class="icon-location" href="?city='+this.city_name+'">'+this.city_name+'</a></td></tr></table>';

                                            ss = s ;
                                            $("#IdResults").append(ss+"</div></div>");

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

                </div>
                <img id="loading" src="{{asset('images/loading.gif')}}" style="display: none"/>

                <a class="facebox" style="display: none"></a>
            </div>
        </div>
            <nav id="bottom" class="bottom t">
                <span class="clicker   icon-up-open"></span>

            </nav>
    </div>
@stop