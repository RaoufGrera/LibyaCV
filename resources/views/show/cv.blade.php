 @inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
 <?php
if($job_seeker->image != "" && ( $job_seeker->hide_cv !="1" || $IsEmp) && ($job_seeker->image_view ==1 || ($job_seeker->image_view ==2 && $IsEmp))){
$imageView =  'images/seeker/300px_'.$job_seeker->code_image .'_'.$job_seeker->image;
}
else{
    if($job_seeker->gender  =='m') { $imageView =  'images/simple/male.png'; } else {$imageView =  'images/simple/female.png';}
}
if($job_seeker->hide_cv == 0  || $status == 1 || $IsEmp)
$nameSeeker = $job_seeker->fname." ".$job_seeker->lname;
else
$nameSeeker ="السيرة الذاتية مخفية";
?>
@extends('layouts.header')

 @section('title',$nameSeeker )
 @section('keywords', $nameSeeker)
 @section('image',asset($imageView))
 @section('url',Request::url())
 @section('description',$nameSeeker.",".$job_seeker->goal_text.",".$job_seeker->about)
 @section('curl',Request::url())

 @section('content')



    <img id="loading" src="{{asset('images/loading.gif')}}" style="display: none"/>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-list">


                    <br>
                    <div id="image" class="div-imgcompany">
                        <div class="contpost" style="padding-right: 0;">
                            <img class="imgcompany"
                                 src= "{{asset($imageView)}}" alt="{{$nameSeeker}}"/></a>
                        </div>
                    </div>

                    <h1 class="center">{{$nameSeeker}}</h1>

                        <hr>
                    <div style="border-right: 2px solid #fed046;
    padding-right: 12px;">
                        <p class="icon-graduation-cap"><span> {{$job_seeker->edt_name}}</span></p>
                        <p class="icon-location"> <span> {{$job_seeker->city_name}}
                                @if($job_seeker->address != "")
                                    - {{$job_seeker->address}}
                                @endif
                        </span></p>

                        <p class="icon-calendar">
                            <span><?php $datereg = date("Y");  $age = $datereg - date("Y", strtotime($job_seeker->birth_day)); echo $age . " سنة"; ?></span>
                        </p>
                            @if($job_seeker->hide_cv == 0  || $status == 1 || $IsEmp)
                       @if($job_seeker->email1 !="") <p class="icon-mail"><span> {{$job_seeker->email1}}</span></p>@endif
                       @if($job_seeker->phone_view ==1) @if($job_seeker->phone != "")<p class=" icon-mobile"><span> {{$job_seeker->phone}}</span>
                        </p> @endif @endif





                                @if($job_seeker->website != "")   <a class="btn btn-block btn-default  icon-globe"
                                                                     href="http://www.{{ $job_seeker->website }}">{{ str_limit($job_seeker->website, $limit = 15, $end = '...') }} </a> @endif
                                @if($job_seeker->linkedin != "")  <a class="btn btn-block btn-default  icon-linkedin"
                                                                     href="https://www.linkedin.com/{{ $job_seeker->linkedin }}">{{ str_limit($job_seeker->linkedin, $limit = 18, $end = '...')  }}</a> @endif
                                @if($job_seeker->facebook != "")    <a
                                        class="btn btn-block btn-default  icon-facebook-official"
                                        href="https://www.facebook.com/{{ $job_seeker->facebook }}">{{ str_limit($job_seeker->facebook, $limit = 18, $end = '...')  }}</a> @endif
                                @if($job_seeker->twitter != "")    <a class="btn btn-block btn-default  icon-twitter"
                                                                      href="https://www.twitter.com/{{ $job_seeker->twitter }}">{{ str_limit($job_seeker->twitter, $limit = 18, $end = '...')  }}</a> @endif
                                @if($job_seeker->goodreads != "")  <a class="btn btn-block btn-default  icon-globe"
                                                                      href="https://www.goodreads.com/{{ $job_seeker->goodreads }}">{{ str_limit($job_seeker->goodreads, $limit = 18, $end = '...')  }}</a> @endif
                                @if($job_seeker->instagram != "")  <a class="btn btn-block btn-default  icon-globe"
                                                                      href="https://www.instagram.com/{{ $job_seeker->instagram }}">{{ str_limit($job_seeker->instagram, $limit = 18, $end = '...')  }}</a> @endif
                            </div>
                        @else

                            <br>
                            <div class="alert alert-info">
                                <strong>تنبيه!</strong> <span>السيرة الذاتية مخفية</span>

                            </div>
                        @endif

                    <br>
                </ul>

            </div>

            <div class="col-md-9 ">
                <br>
                <h1 class="title-page"><span> السيرة الذاتية </span> <span class="texts">( {{ $nameSeeker }} )</span> </h1>


                @if($job_seeker->hide_cv =="0" || $IsEmp)
                <div class="cont">
                    @if(session('error'))
                        <div class="alert alert-warning">
                            <a href="javascript:void(0);" class="close" data-dismiss="alert"
                               aria-label="close">&times;</a>

                            <strong>تنبيه!</strong> {{  session('error') }}
                        </div>
                    @endif



                    <div>
                        <script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>

                        @if($job_seeker->hide_cv == 0  || $status == 1 || $IsEmp)
                            @if(!empty($job_seeker->goal_text))
                                <div class="post icon-award">الهدف الوظيفي</div>
                                <div class="contpost">
                                    <span>{{$job_seeker->goal_text}}</span><br><br>
                                </div>
                            @endif


                            @if (count($seeker_ed) != 0)
                                <div id="education" class="post icon-graduation-cap"> المؤهل العلمي   </div>
                                <div class="contpost">


                                    @foreach($seeker_ed as $row)

                                        <b><span>{{$row->univ_name}} {{$row->faculty_name}}</span></b>
                                        <br>
                                        <span class='texts '>{{$row->edt_name}}
                                            @if(!empty($row->sed_name))، {{$row->sed_name}}@endif
                                            @if(!empty($row->avg))، {{$row->avg}}@endif
                                            <br>
                                            {{$row->start_date}} - {{$row->end_date}}
                                        </span>

                                        <br>
                                        <br>
                                    @endforeach

                                </div>
                            @endif
                             @if (count($seeker_exp) != 0)

                                <div id="experience" class="post  icon-briefcase">  الخبرة      <i style="font-size:80%;"><?php echo '' . floor($job_seeker->exp_sum/12) . ' سنة و' .$job_seeker->exp_sum%12 . ' شهر.';?></i></div>
                                <div class="contpost">

                                    @foreach($seeker_exp as $row)
                                        <b><span>{{$row->exp_name}}</span></b> <span class="texts">( {{$row->compe_name}} )</span>

                                        <span class='texts '>
                                            <br>
                                            {{ date('Y-m',strtotime($row->start_date)) }} -
                                            @if($row->state ==0)
                                                {{ date('Y-m',strtotime($row->end_date)) }}
                                            @else
                                                الي حد الأن
                                            @endif
                                            <br>

                                            {!! nl2br(e($row->exp_desc)) !!}
                            </span>

                                        <br>

                                    @endforeach

                                </div>
                            @endif

                            @if (count($seeker_lang)!= 0)

                                <div id="language" class="post icon-globe">اللغات</div>
                                <div class="contpost">

                                    @foreach($seeker_lang as $row)
                                        <span> {{ $row->lang_name }} <span class="texts">( {{ $row->level_name }} )</span></span>

                                        <br>

                                    @endforeach
                                    <br>
                                </div>
                            @endif

                            @if (count($seeker_spec)!= 0)


                                <div id="specs" class="post icon-sitemap">التخصصات</div>
                                <div id="specskills" class="contpost">

                                    @foreach($seeker_spec as $row)
                                        <a onclick="ShowSpecs('{{ $user_name }}','{{ $row->spec_seeker_id }}');"
                                           class='bs bc'><span
                                                    id='sp-{{ $row->spec_seeker_id }}'>@if(isset($row->spec_count)) {{ $row->spec_count }} @else
                                                    0 @endif</span></a><a
                                                onclick="ShowSpecs('{{ $user_name }}','{{ $row->spec_seeker_id }}');"
                                                class="bs btn-default"> {{ $row->spec_name  }} </a>

                                        @if($status == 1)
                                            <?php
                                            $plus = "+ مصادقة";
                                            if (in_array($row->spec_seeker_id, $spec_firend)) {
                                                $plus = "- إلغاء المصادقة";
                                            }

                                            ?>
                                            <input type="button" id="bt-{{ $row->spec_seeker_id }}"
                                                   class="btn btn-success  btn-xs" value="{{ $plus }}"
                                                   onClick="plusOne({{ $row->spec_seeker_id }})"/>


                                        @endif
                                        <br>
                                    @endforeach
                                    <br>
                                </div>
                            @endif

                            @if (count($seeker_skills)!= 0)
                                <div id="skills" class="post icon-tasks">المهارات</div>
                                <div class="contpost">

                                    @foreach($seeker_skills as $row)
                                       <span>- {{ $row->skills_name }} </span>
                                     {{--  <br>
                                        <span class="texts"> المستوي: {{ $row->level_name }}</span>--}}
                                        <br>
                                    @endforeach
                                    <br>
                                </div>
                            @endif

                            @if (count($seeker_cert)!= 0)
                                <div id="certificate" class="post">الشهادات</div>
                                <div class="contpost">

                                    @foreach($seeker_cert as $row)
                                        <b><span> {{ $row->cert_name }} </span></b><br>
                                        <span class="texts"> سنة: {{ $row->cert_date }}</span>

                                        <br>
                                    @endforeach
                                    <br>
                                </div>
                            @endif

                            @if (count($seeker_train)!= 0)
                                <div id="training" class="post icon-vcard"> التدريب والدورات</div>
                                <div class="contpost">


                                    @foreach($seeker_train as $row)
                                        <b><span> {{ $row->train_name }} </span></b><br>
                                        <span class="texts"> الجهة: {{ $row->train_comp }}</span><br>
                                        <span class="texts"> سنة: {{ $row->train_date }}</span>
                                        <br>
                                        <br>
                                    @endforeach
                                    <br>
                                </div>
                            @endif

                            @if (count($seeker_hobby)!= 0)
                                <?php $i = 0; $choby = count($seeker_hobby); ?>
                                <div id="hobby" class="post icon-brush">الهوايات</div>
                                <div class="contpost">
                                    <?php
                                    foreach ($seeker_hobby as $row) {
                                        echo "<b><span>" . $row->hobby_name . "</span></b>";
                                        $i++;
                                        if ($i < $choby)
                                            echo " - ";

                                    }
                                    ?>
                                    <br>

                                    <br>
                                </div>
                            @endif



                            @if (count($seeker_info)!= 0)
                                <div id="info" class="post icon-info">معلومات أضافية</div>
                                <div class="contpost">

                                    @foreach($seeker_info as $row)
                                        <b><span> {{ $row->info_name }} </span></b>
                                        <br>
                                        @if($row->info_text != "")
                                            <p style="
            padding-right: 6px;
    margin-top: 6px;
    background-color: #fbfbfb;
    border-right: 3px solid #d1d1d1;
    color: #585858;
    line-height: 2.6;
        ">
                                                {{ $row->info_text }}
                                            </p>
                                        @endif
                                        <span class="texts"> سنة: {{ $row->info_date }}</span>
                                        <br>
                                        <br>
                                    @endforeach
                                    <br>
                                </div>
                            @endif
                        @else
                            <div class="alert alert-info">
                                <strong>تنبيه!</strong> <span>السيرة الذاتية مخفية</span>

                            </div>
                        @endif
                    </div>
                </div>
                    @else
                <div class="cont">
                    <div class="alert alert-warning" style="position: relative">
                        <span>السيرة الذاتية مخفية.</span>
                    </div>
                </div>
                    @endif
            </div>

        </div>

            <nav id="bottom" class="bottom t">
                 <span class="clicker   icon-up-open"></span>

            </nav>

    </div>

    <a class="facebox" style="display: none"></a>
@stop