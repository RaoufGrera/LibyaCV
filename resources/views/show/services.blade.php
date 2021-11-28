 @inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();
$urlPage = Request::url();
if($services->image != "" ){
    $imageView =  'images/seeker/300px_'.$services->code_image .'_'.$services->image;
}
else{
    if($services->gender  =='m') { $imageView =  'images/simple/male.png'; } else {$imageView =  'images/simple/female.png';}
}
?>
@extends('layouts.header')


 @section('content')



    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-list">


<br>
                    <br>
                    <div id="image" class="div-imgcompany">
                        <div class="contpost" style="padding-right: 0;">
                            <a href="/user/{{ $services->user_name }}"> <img class="imgcompany"
                                 src= "{{asset($imageView)}}" alt="{{$services->fname}}"/></a>
                        </div>
                    </div>
                    <br>
                    <span class="cname"><a
                                href="/user/{{ $services->user_name }}">{{$services->fname}}</a> </span>
                    <span class="urlname">{{ $services->user_name }}@</span>






                        <hr>
                         <p class="icon-location"> <span> {{$services->city_name}}
                                @if($services->address != "")
                                    - {{$services->address}}
                                @endif
                        </span></p>

                        <p class="icon-calendar">
                            <span><?php $datereg = date("Y");  $age = $datereg - date("Y", strtotime($services->birth_day)); echo $age . " سنة"; ?></span>
                        </p>

                            <p class="icon-mail"><span> {{$services->email1}}</span></p>
                            @if($services->phone_view ==1) @if($services->phone != "")<p class=" icon-mobile"><span> {{$services->phone}}</span>
                            </p> @endif @endif



                </ul>



                <br>

            </div>

            <div class="col-md-9 ">
                <br>
                <h5 class="title-page"> الخدمـة</h5>
                <br>

                <div class="cont">


                        <div >
                             <h2><a href="/services/{{$services->services_id}}"> {{$services->title}} </a></h2>


                                <strong class="job-title">التفاصيل </strong>
                                <div   class="contpost job_desc">
                                    <p >
                                        <span    > {!! nl2br(e($services->body))!!}</span><br><br>
                                    </p>


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
    </div>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/ar_AR/sdk.js#xfbml=1&version=v3.0';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
@stop