 @inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();
if($company->image !=""){$companyImage = 'images/company/300px_'.$company->code_image.'_'.$company->image; }else{  $companyImage ='images/simple/company.png';}
$urlPage = Request::url();
?>
@extends('layouts.header')
 @section('title',"".$company->comp_name)
 @section('keywords'," ".$company->comp_name." ,شركات في ليبيا, شركات في طرابلس , وظائف شاغرة طرابلس، السيرة الذاتية، شركات ليبية، مؤسسات حكومية ليبية  "."Libyacv  ليبيا سي في  ,وظائف شاغرة في ليبيا")
 @section('image',asset($companyImage))
 @section('url',$urlPage)
 @section('description',"الملف الشخصي  ".$company->comp_name)

 @section('content')
    <script type="application/javascript">
        function Toggle(item) {
            objReq = document.getElementById(item);
            visible = (objReq.style.display != "none")
            if (visible) {
                objReq.style.display = "none";
            } else {
                objReq.style.display = "block";
            }
        }
    </script>
    <script   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBoKvim5RDODhqjDQNQsYDxZXBFLw14P5w"></script>
    <style>
        #map_canvas{
            width:100%;
            height:250px;
            border: 1px solid #eeeeee;
        }
    </style>
        <script>
            var token = '{!! Session::token() !!}';
            function followers() {
                var $myButton = $('#follower').prop('disabled', true);
                setTimeout(function ()
                {
                    $myButton.prop('disabled', false);
                }, 1000);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/c/{{$company_name}}',
                    data: {_token: token},
                    success: function (data) {
                        if(data.count != "e"){
                            if(data.check) {
                                $('#follower').prop('value', 'إلغاء المتابعة').removeClass('btn-success').addClass("btn-danger")
                                $('#fc').text(data.followers);
                            }else{
                                $('#follower').prop('value','متابعة').removeClass('btn-danger').addClass("btn-success");
                                $('#fc').text(data.followers);
                            }

                        }else{
                            $('<div class="alert alert-danger"><strong>تنبيه! </strong>غير مسموح بإلغاء المتابعة إلا بعد مرور 60 ثانية.</div>').insertAfter('#follower').delay(3000).fadeOut();
                        }
                    }
                });
            }
        </script>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-list">


<br>
                    <div id="image" class="div-imgcompany">
                        @include('company.modal.show.image')
                    </div>
                    <br>
                    <span  class="cname"><a href="/c/{{ $company->comp_user_name }}">{{$company->comp_name}} </a></span>
                    <span class="urlname">{{ $company->comp_user_name }}@</span>
                    <br>
                    {{--
                       /*   if($status == 0){
                              $status_name = "متابعة";
                              $btn_style = "btn btn-success  btn-block";
                          } else{
                              $status_name = "إلغاء المتابعة";
                              $btn_style = "btn btn-danger  btn-block";
                          }*/


                      @if(session('seeker_id') !="")

                          <input type="button"  onClick="followers()" id="follower" value="{{ $status_name }}" class=" {{ $btn_style }}"/>



                      @else
                          <input type="button" class="btn btn-success btn-block" id="follower" onclick="loginFun()" value="متابعة"/>
                          <script>
                              function loginFun() {
                                  alert("عليك التسجيل قبل متابعة أي شركة.");
                              }
                          </script>
                      @endif
  --}}
                    <br>
                    <div class="center">
                        <div class="fb-share-button" data-href="{{$urlPage}}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.libyacv.com%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">مشاركة</a></div>
                    </div>

                    <hr>                    <a class="facebox" style="display: none"></a>

                    <span class="icon-block"></span><a class="ab t" onclick="ShowModal('company','{{ $company->comp_id }}');">إبلاغ</a>
                    <hr>
                    <div>
                        <p class="icon-location"> <span> {{$company->city_name}}
                             @if($company->address != "")
                                 - {{$company->address}}
                             @endif
                        </span></p>
                        <p class="icon-th"><span>{{ $company->domain_name }}</span></p>
                    @if($company->phone != "")<p class=" icon-mobile"><span> {{ $company->phone }}</span> </p> @endif
                    @if($company->email != "")<p class=" icon-mail">{{ $company->email }}</p> @endif
                    @if($company->url != "")      <a  class="btn btn-block btn-default  icon-globe" href="{{ $company->url }}">{{ str_limit($company->url, $limit = 20, $end = '...') }} </a>  @endif
                    @if($company->website != "")     <a  class="btn btn-block btn-default  icon-globe" href="{{ $company->website }}">{{ str_limit($company->website, $limit = 20, $end = '...') }} </a>  @endif
                        @if($company->linkedin != "")        <p class="icon-linkedin"><a href="{{ $company->linkedin }}">{{ str_limit($company->linkedin, $limit = 18, $end = '...')  }}</a></p> @endif
                        @if($company->facebook != "")   <p class="icon-facebook-official"><a href="{{ $company->facebook }}">{{ str_limit($company->facebook, $limit = 18, $end = '...')  }}</a></p> @endif
                        @if($company->twitter != "")   <p class=" icon-twitter"><a href="{{ $company->twitter }}">{{ str_limit($company->twitter, $limit = 18, $end = '...')  }}</a></p> @endif
                     </div>
                    <br>
                    <div id="map_canvas"></div>
                    <br>
                </ul>
<br>

                <div class="col-md-12">
                    <div class="info-box">
                        <span class="info-box-icon green"><i class="icon-eye icolor"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">المشاهدات</span>
                            <span class="info-box-number"><?php echo $company->see_it; ?></span>
                        </div>
                    </div>
                </div>




                <br>

            </div>

            <div class="col-md-9 ">
                <br>
                <h5 class="title-page"> الشركة</h5>
                <br>

                <div class="cont">


                        <div >
                            <div id="services"><br>
                                <div><strong class="job-title">الخدمات</strong></div>
                                <div class="contpost">
                                    @if(empty($company->services))
                                        <span class='texts'>-</span>
                                    @endif
                                    <span>{!! nl2br(e($company->services)) !!}</span>

                                </div>
                            </div>

                            <div id="specialty"><br>
                                <div><strong class="job-title">عن الشركة</strong></div>
                                <div class="contpost">
                                    <p>{!!  nl2br(e($company->comp_desc)) !!}</p>

                                </div><br>
                            </div>
                        </div>

                        <div ><br>
                            <div><strong class="job-title">الوظائف</strong></div>
                            @if($myJob != null)
                                <div class="col-md-12">
                                    @foreach($myJob as $item)
                                        <div class="job-div">
                                            <div class="cv-body">
                                                <div class="devimgseeker">
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
                                <br>
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