 @inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();
if($company->image !=""){$companyImage = 'images/company/300px_'.$company->code_image.'_'.$company->image; }else{  $companyImage ='images/simple/company.png';}
$urlPage = Request::url();
?>
@extends('layouts.header')
 @section('title',"".$company->comp_name)
 @section('keywords'," ".$company->comp_name,"".$company->comp_user_name)
 @section('image',asset($companyImage))
 @section('url',$urlPage)
 @section('description',$company->services." ".$company->comp_name)
 @section('curl',$urlPage)

 @section('content')
     <script data-ad-client="ca-pub-9929016091047307" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    {{--<script   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBoKvim5RDODhqjDQNQsYDxZXBFLw14P5w"></script>
   --}}
    <style>
        #map_canvas{
            width:100%;
            height:250px;
            border: 1px solid #eeeeee;
        }
        .byellow{
            padding: 5px;
            border: 1px solid #a99b70;
            margin-top: 10px;
            background-color: #fffad2;
        }
        .block{
           display: block;
        }

    </style>


    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-list">


<br>
                    <div id="image" class="div-imgcompany">
                        @include('company.modal.show.image')
                    </div>

                    <h1 style="text-align: center">{{$company->comp_name}} </h1>
                    <hr>

                    <div class="center">
                        <div class="fb-share-button" data-href="{{$urlPage}}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.libyacv.com%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">مشاركة</a></div>
                    </div>



                        <p style="    padding-right: 6px;
    border-right: 2px solid #fabd08;
    margin-top: 10px;
    line-height: 2.4;">
                        <span class="block icon-location"> <span> {{$company->city_name}}
                             @if($company->address != "")
                                 - {{$company->address}}
                             @endif
                        </span></span>
                        <span class="block icon-th"><span>{{ $company->domain_name }}</span></span>
                    @if($company->phone != "")<span class="block icon-mobile"><span> {{ $company->phone }}</span> </span> @endif
                    @if($company->email != "")<span class="block icon-mail">{{ $company->email }}</span> @endif
                    @if($company->url != "")      <a   style="color: #333333;" class="block icon-globe" href="{{ $company->url }}">{{ str_limit($company->url, $limit = 20, $end = '...') }} </a>  @endif
                    @if($company->website != "")     <a  style="color: #333333;" class="block icon-globe" href="{{ $company->website }}">{{ str_limit($company->website, $limit = 20, $end = '...') }} </a>  @endif
                        @if($company->linkedin != "")        <span class="block icon-linkedin"><a href="{{ $company->linkedin }}">{{ str_limit($company->linkedin, $limit = 18, $end = '...')  }}</a></span> @endif
                        @if($company->facebook != "")   <span class="block icon-facebook-official"><a  style="color: #333333;" href="{{ $company->facebook }}">{{ str_limit($company->facebook, $limit = 18, $end = '...')  }}</a></span> @endif
                        @if($company->twitter != "")   <span class="block  icon-twitter"><a href="{{ $company->twitter }}">{{ str_limit($company->twitter, $limit = 18, $end = '...')  }}</a></span> @endif

                    </p>

                 {{--  <div id="map_canvas"></div>--}}
                    <br>
                </ul>
<br>


                    <div>
                        <div class="info-box">
                            <span class="info-box-icon" style="background-color: #ffebea;"><i class="icon-heart icolor"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">المشاهدات</span>
                                <span class="info-box-number"><?php echo $company->see_it; ?></span>
                            </div>
                        </div>
                    </div>


            </div>


            <div class="col-md-9 ">
                <br>
                <h2 class="title-page"> {{$company->comp_name}}</h2>

                <div class="cont">



                            <div id="specialty">
                                <h4>عن الشركة</h4>
                                <hr>
                                <div class="contpost">
                                    @if(empty($company->services))
                                        <p class=' byellow'>  لا تتوفر اي معلومات حالياً.</p>
                                    @endif
                                    <span>{!! nl2br(e($company->services)) !!}</span>

                                </div>
                            </div>



                        <div ><br>
                            <?php
                            function make_slug($string, $separator = '-')
                            {
                                $string = trim($string);
                                $string = mb_strtolower($string, 'UTF-8');
                                $string = preg_replace("/[^a-z0-9_\s\-ءاآؤئليةبپتثجچحخدذرزسشصضطظعغفقكکگلمنوهی]/u", '', $string);
                                $string = preg_replace("/[\s\-_]+/", ' ', $string);
                                $string = preg_replace("/[\s_]/", $separator, $string);

                                return $string;
                            }

                            ?>
                            <div id="jobs"><h4>الوظائف</h4></div>
                            <hr>
                            @if($myJob != null)
                                <div class="col-md-12">
                                    @foreach($myJob as $item)
                                        <div class="job-div">
                                            <div class="cv-body">
                                                <div class="devimgseeker" style="    max-width: 160px;">
                                                    <a itemprop='name' href="/job/{{$item['desc_id']}}/{{make_slug($item['job_name'])}}"><img class="imgjob-view" src= @if($item['image'] != ''){{asset('images/company/140px_'.$item['code_image'] .'_'.$item['image'])}} @else {{asset('images/simple/140px_company.png')}} @endif /></a></div><div class="line">



                                                    <span class="display"><a  id="cvname" href="/job/{{ $item['desc_id'] }}/{{make_slug($item['job_name'])}}">{{$item['job_name']}} </a> </span>
                                                    <span class="r"><span class="texts "><a class="icon-location {{ $item['city_color'] }} " style="color: #FFFFFF;" href="/job/search?city={{ $item['city_name'] }}">{{$item['city_name']}}</a></span><span class="texts"><a class="icon-th " href="/job/search?domain={{ $item['domain_name'] }}">{{$item['domain_name']}}</a></span>
                                          <span class="texts"> <i class="icon-heart" ></i>{{ $item['see_it'] }}</span> &nbsp;<span> {{$item['job_start']}}</span></span>
                                                </div>

                                            </div>

                                        </div>
                                    @endforeach
                                </div>

                            @else

                                <span>حاليًا لاتوجد وظائف شاغرة.</span>
@endif
<br>
                        </div>



                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <ins class="adsbygoogle"
                         style="display:block; text-align:center;"
                         data-ad-layout="in-article"
                         data-ad-format="fluid"
                         data-ad-client="ca-pub-9929016091047307"
                         data-ad-slot="4652769808"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>

        </div>

        </div>
    <br>
    </div>
    <?php
    $lat = ($company->lat != '' ? $company->lat : 32.89464910098208);
    $lng = ($company->lng != '' ? $company->lng : 13.171787052917466);
    ?>

    <script language="javascript">


        function initialize() {
            var lat = {{ $lat }};
            var lng = {{ $lng }};
            var latlng = new google.maps.LatLng(lat, lng);
            var myOptions = {
                zoom: 14,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var map = new google.maps.Map(document.getElementById("map_canvas"),
                myOptions);
            var marker = new google.maps.Marker({
                position: {
                    lat: lat,
                    lng: lng
                },
                map: map
            });
        }
        google.maps.event.addDomListener(window, "load", initialize);

            function deleteItem() {
                if (confirm("هل أنت متأكد من الحذف؟")) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/ar_AR/sdk.js#xfbml=1&version=v3.0';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
@stop