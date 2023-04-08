 @inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();

if($job->image !=""){$companyImage = 'images/company/300px_'.$job->code_image.'_'.$job->image; }else{  $companyImage ='images/simple/company.png';}


$urlPage = Request::url();
?>
@extends('layouts.header')

 @section('title',$job->job_name ." - " .$job->comp_name)
  @section('keywords',$job->job_name." ,".$job->comp_name.","."وظائف شاغرة في ليبيا, عمل بنغازي, وظيفة في ليبيا,عمل،jobs، LibyaCV, وظائف طرابلس , وظائف ليبيا")
 @section('image',asset($companyImage))
 @section('url',$urlPage)
 @section('description',"،وظائف شاغرة في ليبيا " .$job->comp_name." ،".  $job->job_name)
 @section('curl',$urlPage)

@section('json')
    <script type="application/ld+json">
{
  "@context": "http://schema.org/",
  "@type": "JobPosting",
  "name": "{{ $job->job_name}}",
  "title": "{{ $job->job_name}}",
  "hiringOrganization": {
    "@type": "Organization",
     "name" : "{{ $job->comp_name}}",
    "sameAs" : "https://www.libyacv.com",
    "logo" : "https://www.libyacv.com/{{$companyImage}}"
  },

  "estimatedSalary": "1500",
  "validThrough": "{{ $job->job_end }}",
  "employmentType": "FULL_TIME",

"baseSalary": {
    "@type": "MonetaryAmount",
    "currency": "LYD",
    "value": {
      "@type": "QuantitativeValue",
      "value": 1400.00,
      "unitText": "MONTH"
    }
  },
  "jobLocation": {
    "@type": "Place",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Tripoli Libya",
      "addressLocality": "{{$job->city_name}}",
      "addressRegion": "LY",
      "postalCode": "14229",
      "addressCountry": "LY"
    }
  },

  
  "datePosted":  "{{$job->job_start}}",
  "description": "{!! $job->job_desc !!}}}"

}
</script>

    <script data-ad-client="ca-pub-9929016091047307" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

@stop
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

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-list" style="padding: 20px 0px 0 12px;">
                    <script>
                        var token = '{!! Session::token() !!}';

                        function requestJob() {
                            var $myButton = $('#request').prop('disabled', true);
                            setTimeout(function () {
                                $myButton.prop('disabled', false);
                            }, 1000);

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            $.ajax({
                                type: 'PATCH',
                                url: '/job/{{$job->desc_id}}',
                                data: {_token: token, _method: 'PATCH'},
                                success: function (data) {
                                    if (data.count != "e") {
                                        if (data.check) {
                                            $('#request').prop('value', 'إلغاء التقدم للوظيفة').removeClass('btn-success').addClass("btn-danger");
                                            $('#fc').text(data.requests);
                                        } else {
                                            $('#request').prop('value', 'طلب التقدم للوظيفة').removeClass('btn-danger').addClass("btn-success");
                                            $('#fc').text(data.requests);
                                        }

                                    } else {
                                        $('<div class="alert alert-danger"><strong>تنبيه! </strong>غير مسموح بإلغاء التقدم للوظيفة إلا بعد مرور 60 ثانية.</div>').insertAfter('#request').delay(3000).fadeOut();
                                    }
                                }
                            });

                        }
                    </script>


                    <div class="byellow" style="margin-top: 10px;margin-bottom: 20px;">
                        <div style="float: right;margin-left: 10px;">
                            <a itemprop="name" href="/c/{{ $job->comp_user_name }}"><img style="    max-height: 50px;
    max-width: 50px;"   src={{asset($companyImage)}}></a></div>

                        <a id="cvname" style="color: #242424;" href="/c/{{ $job->comp_user_name }}"><span itemprop="hiringOrganization" itemprop="name">{{$job->comp_name}} </span></a>
                        <div><a style="color: #242424;"  href="/c/{{ $job->comp_user_name }}">{{ $job->comp_user_name }}@</a></div>
                    </div>

<style>
    .byellow{
        padding: 5px;
        border: 1px solid #a99b70;
        margin-top: 10px;
        background-color: #fffad2;
    }
</style>



                    @if($job->job_end >=  NOW())

                    <?php
                    if ($isreq  == null) {
                        $status_name = 'طلب التقدم للوظيفة';
                        $btn_style = "btn btn-success  btn-block";
                    } else {
                        $status_name = 'إلغاء التقدم للوظيفة';
                        $btn_style = "btn btn-danger  btn-block";


                    }
                    ?>


                    @if(session('seeker_id') !="")

                        @if($job->how_receive == 0)
                            <input type="button" onClick="requestJob()" id="request" value="{{ $status_name }}"
                                   class=" {{ $btn_style }}"/>
                        @else
                                <p class="byellow">
                                    <span style="
    display: block;
    text-align: center;
">للتقدم للوظيفة</span>
                                    <span style=" display: block; margin: 0;border-bottom: 1px solid #262626" ></span>
                                 @if($job->phone != "")<span style="display: block" class=" icon-mobile"><span> {{$job->phone}}</span></span> @endif
                                    @if($job->email != "")   <span style="display: block" class="icon-mail"><span> {{$job->email}}</span></span>@endif

                                @if($job->website != "")   <a class="btn btn-block btn-default  icon-globe"
                                                                     href="{{ $job->website }}">{{ str_limit($job->website, $limit = 15, $end = '...') }} </a>
                                @endif
                                </p>
                            @endif

                    @else
                            @if($job->how_receive == 0)
                                <input type="button" class="btn btn-success btn-block" onclick="loginFun()" value="{{ $status_name }}"/>
                                <script>
                                    function loginFun() {
                                        alert("عليك التسجيل قبل التقدم للوظيفة.");
                                    }
                                </script>
                            @else
                                <p class="byellow">
                                                                   <span style="
    display: block;
    text-align: center;
">للتقدم للوظيفة</span>
                                        <span style=" display: block; margin: 0;border-bottom: 1px solid #262626" ></span>
                                 @if($job->phone != "")<span style="display: block" class=" icon-mobile"><span> {{$job->phone}}</span></span> @endif
                                @if($job->email != "")   <span style="display: block" class="icon-mail"><span> {{$job->email}}</span></span>@endif

                                @if($job->website != "")   <a class="btn btn-block btn-default  icon-globe"
                                                              href="{{ $job->website }}">{{ str_limit($job->website, $limit = 15, $end = '...') }} </a> @endif
                                </p>

                            @endif

                    @endif

                @else
                        <p class="byellow">
                        <span>إنتهت صلاحية الإعلان.</span> </p>
@endif


                    <!-- Go to www.addthis.com/dashboard to customize your tools -->

                    <div class="center">
                        <div class="fb-share-button" data-href="{{$urlPage}}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.libyacv.com%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">مشاركة</a></div>
                    </div>


                    <div style="    border-right: 2px solid #fac422;
    padding-right: 12px;
    margin-top: 10px;">
                    <p class="icon-location"><a href="/job/search?city={{ $job->city_name }}" style="color: #333333"><span itemprop="addressLocality"> {{$job->city_name}}</span></a></p>
                        <p class="icon-th"><a href="/job/search?domain={{ $job->domain_name }}" style="color: #333333"><span>{{ $job->domain_name }}</span></a></p>

                    <p class="icon-calendar"><span itemprop="datePosted"><?php echo date('d-m-Y', strtotime($job->job_start));?></span></p>
                    </div>
                </ul>

                <div>
                    <div class="info-box">
                        <span class="info-box-icon" style="background-color: #ffebea;"><i class="icon-heart icolor"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">المشاهدات</span>
                            <span class="info-box-number"><?php echo $job->see_it; ?></span>
                        </div>
                    </div>
                </div>



               {{--  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- Main -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-9929016091047307"
                     data-ad-slot="4050134570"
                     data-ad-format="auto"
                     data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>--}}

            </div>

            <div class="col-md-9">
                <br>
                <h2 class="title-page"> وظيفة شاغرة </h2>



                <div class="cont job" style="line-height: 1.6;">
                    @if(session('error'))
                        <div class="alert alert-warning">
                            <a href="javascript:void(0);" class="close" data-dismiss="alert"
                               aria-label="close">&times;</a>

                            <strong>تنبيه!</strong> {{  session('error') }}
                        </div>
                    @endif

                        <?php
                        function is_english($str)
                        {

                            $check  = substr($str, 0, 10);
                            if (preg_match('/[^\W_ ]/', $check)) // '/[^a-z\d]/i' should also work.
                                return true;
                            else
                                return false;
                        }
                        function is_html($string)
                        {
                            return preg_match("/<[^<]+>/",$string,$m) != 0;
                        }?>
                     <div class="byellow @if(is_english($job->job_desc)) ltr @endif " style="margin-bottom: 8px"><h1 style="font-size: 16px;  margin: 5px;display: inline-block">{{$job->job_name}}</h1> <div id="google_translate_element" style="display: inline-block;float: right;">   </div></div>


                        <hr>



                    @if(!empty($job->job_desc))

                        <div   class="contpost @if(is_english($job->job_desc)) ltr @endif">
                            <p >

                            <span> @if(is_html($job->job_desc)) {!! $job->job_desc !!} @else {!! nl2br(e($job->job_desc))!!} @endif</span>
                            </p>
                            <p class="byellow">
                                                                                               <span style="
    display: block;
    text-align: center;
">لتقدم للوظيفة</span>
                                <span style=" display: block; margin: 0;border-bottom: 1px solid #262626" ></span>
                                @if($job->job_end >=  NOW())
                                @if($job->phone != "")<span style="display: block" class=" icon-phone"><span> {{$job->phone}}</span></span> @endif
                                @if($job->email != "")   <span style="display: block" class="icon-mail"><span> {{$job->email}}</span></span>@endif

                                @if($job->website != "")   <a class="btn btn-block btn-default  icon-globe"
                                                              href="{{ $job->website }}">{{ str_limit($job->website, $limit = 15, $end = '...') }} </a> @endif

                                @else
                                 <span> أنتهت صلاحية الاعلان</span> @endif
                            </p>
                        </div>
                    @endif




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

                        <div>  <h4>إعلانات مشابهة</h4>
                            <hr>
                            <?php
                            function make_slug($string, $separator = '-')
                            {
                                $string = trim($string);
                                $string = mb_strtolower($string, 'UTF-8');
                                $string = preg_replace("/[^a-z0-9_\s\-ءاآؤئبپتثجچحخدذرزژسشصضطظعغفقكکگلمنوهی]/u", '', $string);
                                $string = preg_replace("/[\s\-_]+/", ' ', $string);
                                $string = preg_replace("/[\s_]/", $separator, $string);

                                return $string;
                            }

                            ?>


                            <div class="col-md-12">
                                @foreach($otherJob as $item)
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

                </div>
            </div>
        </div>
        <a class="facebox" style="display: none"></a>
            <nav id="bottom" class="bottom t">
                <span class="clicker   icon-up-open"></span>

            </nav>
    </div>
    </div>

     <img id="loading" src="{{asset('images/loading.gif')}}" style="display: none"/>
<style>
    .rtl {
        direction: rtl;
        text-align: right;
        unicode-bidi: bidi-override;
    }

    .ltr {
        direction: ltr;

        text-align: left;
        unicode-bidi: bidi-override;
    }
</style>
    <script language="javascript">
        /*  function deleteItem() {
             if (confirm("هل أنت متأكد من الحذف؟")) {
                 return true;
             } else {
                 return false;
             }
         }

          function checkRtl( character ) {
             var RTL = ['ا','ب','پ','ت','س','ج','چ','ح','خ','د','ذ','ر','ز','ژ','س','ش','ص','ض','ط','ظ','ع','غ','ف','ق','ک','گ','ل','م','ن','و','ه','ی'];
             var english = /^[A-Za-z0-9]*$/;

             result = english.test(character);
             return  result;
         }

       var divs = document.getElementsByClassName('job_desc');


         for ( var index = 0; index < divs.length; index++ ) {
             var divText = divs[index].innerText;
             if( checkRtl( divText.replace(/ .* /,'') ) ) {
                 divs[index].className = 'ltr';
             } else {
                 divs[index].className = 'rtl';
             }
         }*/



    </script>
     <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/ar_AR/sdk.js#xfbml=1&version=v3.0';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'ar,en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
        }
    </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

 @stop
