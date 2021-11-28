@inject('company','App\Helpers\CompanyConstant');
<?php  $notes = $company->getNote();?>
@extends('layouts.header')
@section('content')
    {{ var_dump($urls) }}
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
    </script>
    <?php

    $stringClearHref = '';
    $cityClearHref = '';
    $univClearHref = '';
    $domainClearHref = '';
    $specClearHref = '';
    $educationClearHref = '';
    $genderClearHref = '';
    $natClearHref = '';
    $expClearHref = '';
    $ageClearHref = '';
    $domainHref = '';
    $domainHref = '';
    $allHref = '';

            $thiskey='';
    foreach ($urls as $key => $value) {
        if (empty($value) || $key == 'page')
            continue;


        if ($allHref == '') {
            $value = str_replace(" ", "-", $value);
            if($key == 'spec[]'){
                foreach($value as $values){
                    $thiskey = $values;
                }

                $allHref = '?' . $key . '=' . $thiskey;
                continue;

            }else{
            $allHref = '?' . $key . '=' . $value;
            continue;

            }
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
                                        href="/{{ $stringClearHref }}">إزالة</a><br>
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
                                        href="/cv/search/{{ $cityClearHref }}">إزالة</a><br>
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
                                        href="/cv/search{{ $domainClearHref  }}">إزالة</a><br>
                            @endif

                            @if(!empty($urls['univ']))
                                <?php

                                foreach ($urls as $key => $value) {
                                    if (empty($value) || $key == 'univ' || $key == 'page')
                                        continue;

                                    if ($univClearHref == '') {
                                        $univClearHref = '?' . $key . '=' . $value;
                                        continue;
                                    }
                                    $univClearHref = $univClearHref . '&' . $key . '=' . $value;

                                }
                                ?>
                                <span>الجامعة</span><br>
                                <span class="find-value"> {{ $urls['univ'] }}</span>  <a
                                        href="/cv/search{{ $univClearHref }}">إزالة</a><br>
                            @endif

                            @if(!empty($urls['education']))
                                <?php

                                foreach ($urls as $key => $value) {
                                    if (empty($value) || $key == 'education' || $key == 'page')
                                        continue;

                                    if ($educationClearHref == '') {
                                        $educationClearHref = '?' . $key . '=' . $value;
                                        continue;
                                    }
                                    $educationClearHref = $educationClearHref . '&' . $key . '=' . $value;

                                }
                                ?>
                                <span>المؤهل العلمي</span><br>
                                <span class="find-value"> {{ $urls['education'] }}</span>  <a
                                        href="/cv/search{{ $educationClearHref }}">إزالة</a><br>
                            @endif

                            @if(!empty($urls['spec']))
                                <?php

                                foreach ($urls as $key => $value) {
                                    if (empty($value) || $key == 'spec' || $key == 'page')
                                        continue;

                                    if ($specClearHref == '') {
                                        $specClearHref = '?' . $key . '=' . $value;
                                        continue;
                                    }
                                    $specClearHref = $specClearHref . '&' . $key . '=' . $value;

                                }
                                ?>
                                <span>التخصص</span><br>
                                <span class="find-value"> {{ $urls['spec'] }}</span>  <a
                                        href="/cv/search{{ $specClearHref }}">إزالة</a><br>
                            @endif

                            @if(!empty($urls['gender']))
                                <?php

                                foreach ($urls as $key => $value) {
                                    if (empty($value) || $key == 'gender' || $key == 'page')
                                        continue;

                                    if ($genderClearHref == '') {
                                        $genderClearHref = '?' . $key . '=' . $value;
                                        continue;
                                    }
                                    $genderClearHref = $genderClearHref . '&' . $key . '=' . $value;

                                }
                                ?>

                                <span>الجنس</span><br>
                                <span class="find-value">@if($urls['gender']=='m') ذكر @else أنثي @endif</span>  <a
                                        href="/cv/search{{ $genderClearHref }}">إزالة</a><br>
                            @endif
                            @if(!empty($urls['nat']))
                                <?php

                                foreach ($urls as $key => $value) {
                                    if (empty($value) || $key == 'nat' || $key == 'page')
                                        continue;

                                    if ($natClearHref == '') {
                                        $natClearHref = '?' . $key . '=' . $value;
                                        continue;
                                    }
                                    $natClearHref = $natClearHref . '&' . $key . '=' . $value;

                                }
                                ?>
                                <span>الجنسية</span><br>
                                <span class="find-value"> {{ $urls['nat'] }}</span>  <a
                                        href="/cv/search{{ $natClearHref }}">إزالة</a><br>
                            @endif
                            @if(!empty($urls['min-exp']) || !empty($urls['max-exp']))
                                <?php

                                foreach ($urls as $key => $value) {
                                    if (empty($value) || $key == 'min-exp' || $key == 'max-exp' || $key == 'page')
                                        continue;

                                    if ($expClearHref == '') {
                                        $expClearHref = '?' . $key . '=' . $value;
                                        continue;
                                    }
                                    $expClearHref = $expClearHref . '&' . $key . '=' . $value;

                                }
                                ?>
                                <span>الخبرة</span><br>
                                <span class="find-value">من: {{ $urls['min-exp'] }} - الي: {{ $urls['max-exp'] }}</span>
                                <a
                                        href="/cv/search{{ $expClearHref }}">إزالة</a><br>
                            @endif

                            @if(!empty($urls['min-age']) || !empty($urls['max-age']))
                                <?php

                                foreach ($urls as $key => $value) {
                                    if (empty($value) || $key == 'min-age' || $key == 'max-age' || $key == 'page')
                                        continue;

                                    if ($ageClearHref == '') {
                                        $ageClearHref = '?' . $key . '=' . $value;
                                        continue;
                                    }
                                    $ageClearHref = $ageClearHref . '&' . $key . '=' . $value;

                                }
                                ?>
                                <span>العمر</span><br>
                                <span class="find-value">من: {{ $urls['min-age'] }} - الي: {{ $urls['max-age'] }}</span>
                                <a
                                        href="/cv/search{{ $ageClearHref }}">إزالة</a><br>
                            @endif

                        </div>
                    </div>
                    <br>

                    <div>
                        {!! Form::open(array( 'class'=>'navbar-form','url'=>Request::url(), 'method'=>'GET' ,'name'=>'form1')) !!}
                        <div class="input-group">
                            <?php
                            $string = NULL;
                            if (!empty($urls['string']))
                                $string = $urls['string']
                            ?>

                            <input value="{{ $string }}" type="text" placeholder="اسم الباحث التخصص..." name="string"
                                   id="search-string" class="form-control">

                            @if(!empty($urls['city']))
                                <input type="hidden" value="{{ $urls['city'] }}" name="city"/>
                            @endif
                            @if(!empty($urls['domain']))
                                <input type="hidden" value="{{ $urls['domain'] }}" name="domain"/>
                            @endif
                            @if(!empty($urls['univ']))
                                <input type="hidden" value="{{ $urls['univ'] }}" name="univ"/>
                            @endif
                            @if(!empty($urls['education']))
                                <input type="hidden" value="{{ $urls['education'] }}" name="education"/>
                            @endif
                            @if(!empty($urls['spec']))
                                <input type="hidden" value="{{ $urls['spec'] }}" name="spec"/>
                            @endif
                            @if(!empty($urls['gender']))
                                <input type="hidden" value="{{ $urls['gender'] }}" name="gender"/>
                            @endif
                            @if(!empty($urls['nat']))
                                <input type="hidden" value="{{ $urls['nat'] }}" name="nat"/>
                            @endif

                            <input name="min-exp" id="min-exp" value="{{ $urls['min-exp'] }}" hidden/>
                            <input name="max-exp" id="max-exp" value="{{ $urls['max-exp'] }}" hidden/>
                            <input name="min-age" id="min-age" value="{{ $urls['min-age'] }}" hidden/>
                            <input name="max-age" id="max-age" value="{{ $urls['max-age'] }}" hidden/>

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-success"><img class="search-img"
                                                                                   src="{{asset('images/search.png')}}"/>
                                </button>
                            </div>

                        </div>


                        {!! Form::close() !!}
                    </div>
                    <div>
                        <a href="/cv/search" class="btn btn-danger btn-block">إزالة معايير البحث</a>
                    </div>
                    <div class="titel-search icon-location"><span>المدينة</span></div>


                    <div id="city" class="select_search">
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
                                        if($key == 'spec[]'){
                                            if(count($key) == 0)
                                                continue;

                                            foreach($value as $values){
                                                $thiskey = $values;
                                            }

                                            $cityHref = '?' . $key . '=' . $thiskey;
                                            continue;

                                        }else{
                                        $cityHref = '?' . $key . '=' . $value;

                                        continue;
                                        }
                                    }
                                    if($key == 'spec[]'){
                                        if(count($key) == 0)
                                            continue;

                                        foreach($value as $values){
                                            $thiskey = $values;
                                        }
                                        $cityHref = $cityHref . '&' . $key . '=' . $thiskey;
                                        continue;
                                    }
                                    $cityHref = $cityHref . '&' . $key . '=' . $value;


                                }

                                ?>
                                <a class="searcha"
                                   href="/cv/search{{  $cityHref }}">{{ $row->city_name }}
                                    <span class="a-count">{{ $row->city_count }}</span></a>
                            @endforeach

                        @else
                            <?php
                            $cityClearHref = '';

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
                            <span class="searchRemove">{{ $_GET['city'] }} ( <a
                                        href="/cv/search{{ $cityClearHref }}">إزالة</a>
                            )</span>
                        @endif
                    </div>


                    <div class="titel-search icon-th"><span>المجال</span></div>


                    <div id="domain" class="select_search">
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
                                        if($key == 'spec[]'){
                                            if(count($key) == 0)
                                                continue;

                                            foreach($value as $values){
                                                $thiskey = $values;
                                            }

                                            $domainHref = '?' . $key . '=' . $thiskey;
                                            continue;

                                        }else{
                                            $domainHref = '?' . $key . '=' . $value;

                                            continue;
                                        }
                                    }
                                    if($key == 'spec[]'){
                                        if(count($key) == 0)
                                            continue;

                                        foreach($value as $values){
                                            $thiskey = $values;
                                        }
                                        $domainHref = $domainHref . '&' . $key . '=' . $thiskey;
                                        continue;
                                    }

                                    $domainHref = $domainHref . '&' . $key . '=' . $value;


                                }

                                ?>

                                <a class="searcha"
                                   href="/cv/search{{ $domainHref }}">{{ $row->domain_name }}
                                    <span class="a-count">{{ $row->domain_count }}</span></a>
                            @endforeach
                        @else
                            <span class="searchRemove">{{ $urls['domain'] }} ( <a
                                        href="/cv/search{{ $domainClearHref }}">إزالة</a>
                            )</span>
                        @endif
                    </div>

                    <div class="titel-search icon-graduation-cap">&nbsp;<span>الجامعة</span></div>
                    <div id="univs" class="select_search">
                        @if((!isset($_GET['univ'])) || ($_GET['univ']==""))
                            @foreach($univ as $row)
                                <?php

                                $univHref = '';
                                $univName = str_replace(" ", "-", $row->univ_name);
                                foreach ($urls as $key => $value) {
                                    if ((empty($value) && $key != 'univ') || $key == 'page')
                                        continue;

                                    if ($key == 'univ') {
                                        if ($univHref == '') {
                                            $univHref = '?' . $key . '=' . $univName;
                                            continue;
                                        }

                                        $univHref = $univHref . '&' . $key . '=' . $univName;
                                        continue;
                                    }

                                    $value = str_replace(" ", "-", $value);
                                    $value = str_replace("/", "-", $value);
                                    if ($univHref == '') {
                                        if($key == 'spec[]'){
                                            if(count($key) == 0)
                                                continue;

                                            foreach($value as $values){
                                                $thiskey = $values;
                                            }

                                            $univHref = '?' . $key . '=' . $thiskey;
                                            continue;

                                        }else{
                                            $univHref = '?' . $key . '=' . $value;

                                            continue;
                                        }
                                    }
                                    if($key == 'spec[]'){
                                        if(count($key) == 0)
                                            continue;

                                        foreach($value as $values){
                                            $thiskey = $values;
                                        }
                                        $univHref = $univHref . '&' . $key . '=' . $thiskey;
                                        continue;
                                    }

                                    $univHref = $univHref . '&' . $key . '=' . $value;

                                }
                                ?>

                                <a class="searcha"
                                   href="/cv/search{{ $univHref }}">{{ $row->univ_name }}
                                    <span class="a-count">{{ $row->univ_count }}</span></a>
                            @endforeach
                        @else
                            <?php  $_GET['univ'] = str_replace("-", " ", $_GET['univ']); ?>
                            <span class="searchRemove">{{ $_GET['univ'] }} ( <a
                                        href="/cv/search{{ $univClearHref }}">إزالة</a>
                            )</span>
                        @endif
                    </div>
                    @if(count($univ) > 5)
                        <a class="showing" href='javascript:Toggle("univs")'> المزيد / إخفاء</a>
                    @endif
                    <div class="titel-search icon-graduation-cap">&nbsp;<span>المؤهل العلمي</span></div>
                    <div id="education" class="select_search">
                        @if((!isset($_GET['education'])) || ($_GET['education']==""))
                            @foreach($education as $row)
                                <?php

                                $educationHref = '';
                                $edtName = str_replace("/", "-", $row->edt_name);
                                $edtNameShow = str_replace("/", " / ", $row->edt_name);
                                foreach ($urls as $key => $value) {
                                    if ((empty($value) && $key != 'education') || $key == 'page')
                                        continue;

                                    if ($key == 'education') {
                                        if ($educationHref == '') {
                                            $educationHref = '?' . $key . '=' . $edtName;
                                            continue;
                                        }

                                        $educationHref = $educationHref . '&' . $key . '=' . $edtName;
                                        continue;
                                    }

                                    if ($educationHref == '') {
                                        $educationHref = '?' . $key . '=' . $value;
                                        continue;
                                    }

                                    $educationHref = $educationHref . '&' . $key . '=' . $value;

                                }
                                ?>
                                <a class="searcha"
                                   href="/cv/search{{ $educationHref }}">{{ $edtNameShow }}
                                    <span class="a-count">{{ $row->edt_count }}</span></a>
                            @endforeach
                        @else
                            <?php  $_GET['education'] = str_replace("-", " ", $_GET['education']); ?>
                            <span class="searchRemove">{{ $_GET['education'] }} ( <a
                                        href="/cv/search{{ $educationClearHref }}">إزالة</a>
                            )</span>
                        @endif
                    </div>

                    <div class="titel-search icon-graduation-cap">&nbsp;<span>التخصص</span></div>
                    <div id="specs" class="select_search">
                        @if((!isset($_GET['spec'])) || ($_GET['spec']==""))
                            @foreach($spec as $row)
                                <?php

                                $specHref = '';
                                $specName = str_replace("/", "-", $row->spec_name);
                                foreach ($urls as $key => $value) {
                                    if ((empty($value) && $key != 'spec') || $key == 'page')
                                        continue;

                                    if ($key == 'spec') {
                                        if ($specHref == '') {
                                            $specHref = '?' . $key . '=' . $specName;
                                            continue;
                                        }

                                        $specHref = $specHref . '&' . $key . '=' . $specName;
                                        continue;
                                    }

                                    if ($specHref == '') {
                                        $specHref = '?' . $key . '=' . $value;
                                        continue;
                                    }

                                    $specHref = $specHref . '&' . $key . '=' . $value;

                                }
                                ?>
                                <a class="searcha"
                                   href="/cv/search{{ $specHref }}">{{ $row->spec_name }}
                                    <span class="a-count">{{ $row->spec_count }}</span></a>
                            @endforeach
                        @else
                            <span class="searchRemove">{{ $_GET['spec'] }} ( <a
                                        href="/cv/search{{ $specClearHref }}">إزالة</a>
                            )</span>
                        @endif
                    </div>
                    @if(count($spec) > 5)
                        <a class="showing" href='javascript:Toggle("specs")'> المزيد / إخفاء</a>
                    @endif

                    <div class="titel-search demo-icon icon-venus-mars ">&nbsp;<span>الجنس</span></div>
                    <div id="gender" class="select_search">
                        @if((!isset($_GET['gender'])) || ($_GET['gender']==""))

                            <?php

                            $genderHrefMale = '';
                            $genderHrefFemale = '';

                            foreach ($urls as $key => $value) {
                                if ((empty($value) && $key != 'gender') || $key == 'page')
                                    continue;

                                if ($key == 'gender') {
                                    if ($genderHrefMale == '') {
                                        $genderHrefMale = '?' . $key . '=m';
                                    } else {
                                        $genderHrefMale = $genderHrefMale . '&' . $key . '=m';
                                    }
                                    continue;
                                }
                                if ($genderHrefMale == '') {
                                    $genderHrefMale = '?' . $key . '=' . $value;
                                    continue;
                                }
                                $genderHrefMale = $genderHrefMale . '&' . $key . '=' . $value;


                            }
                            $genderHrefFemale = str_replace("=m", "=f", $genderHrefMale);
                            ?>

                            @foreach($genderMale as $row) <a class="searcha"  href="/cv/search{{ $genderHrefMale }}">ذكر <span class="a-count">{{ $row->male_count }}</span></a>
                            @endforeach

                            @foreach($genderFemale as $row)
                                <a class="searcha"
                                   href="/cv/search{{ $genderHrefFemale }}">انثي
                                    <span class="a-count">{{ $row->female_count }}</span></a>
                            @endforeach
                        @elseif($_GET['gender']=="m")
                            <span class="searchRemove">
                              ذكر ( <a
                                        href="/cv/search{{ $genderClearHref }}">إزالة</a>
                            )</span>
                        @elseif($_GET['gender']=="f")
                            <span class="searchRemove">
                            انثي ( <a
                                        href="/cv/search{{ $genderClearHref }}">إزالة</a>
                            )</span>
                        @endif
                    </div>

                    <div class="titel-search icon-globe"><span>الجنسية</span>
                    </div>
                    <div id="nat" class="select_search">
                        @if((!isset($_GET['nat'])) || ($_GET['nat']==""))
                            @foreach($nat as $row)
                                <?php

                                $natHref = '';

                                foreach ($urls as $key => $value) {
                                    if ((empty($value) && $key != 'nat') || $key == 'page')
                                        continue;

                                    if ($key == 'nat') {
                                        if ($natHref == '') {
                                            $natHref = '?' . $key . '=' . $row->nat_name;
                                            continue;
                                        }

                                        $natHref = $natHref . '&' . $key . '=' . $row->nat_name;
                                        continue;
                                    }

                                    if ($natHref == '') {
                                        $natHref = '?' . $key . '=' . $value;
                                        continue;
                                    }

                                    $natHref = $natHref . '&' . $key . '=' . $value;

                                }
                                ?>
                                <a class="searcha"
                                   href="/cv/search{{ $natHref }}">{{ $row->nat_name }}
                                    <span class="a-count">{{ $row->nat_count }}</span></a>
                            @endforeach
                        @else
                            <span class="searchRemove"> {{ $_GET['nat'] }} ( <a
                                        href="/cv/search{{ $natClearHref }}">إزالة</a>
                            )</span>
                        @endif
                    </div>
                    <div class="titel-search  icon-user">&nbsp;<span>الخبرة</span>
                    </div>
                    <div id="exp" class="select_search">

                        <div>
                            &nbsp; <select name="min-exp" class="select-min-exp">
                                <option value="" selected="selected">من
                                </option>
                                <?php

                                for ($i = 1; $i <= 40; $i++) {
                                    echo "<option ";
                                    if (!empty($urls['min-exp']) && $urls['min-exp'] == $i)
                                        echo " selected='selected' ";
                                    echo "value=\"$i\">$i</option>\n";
                                }
                                ?>
                            </select>
                            -
                            <select name="max-exp" class="select-max-exp">
                                <option value="" selected="selected">إلي
                                </option>
                                <?php
                                for ($i = 1; $i <= 40; $i++) {
                                    echo "<option ";
                                    if (!empty($urls['max-exp']) && $urls['max-exp'] == $i)
                                        echo " selected='selected' ";
                                    echo "value=\"$i\">$i</option>\n";
                                }
                                ?>
                            </select>&nbsp;
                            <button style="vertical-align: bottom" onclick="document.form1.submit();"
                                    class="btn btn-default btn-sm" name="exp-btn">بحث
                            </button>
                        </div>
                    </div>


                    <div class="titel-search  icon-calendar">&nbsp;<span>العمر</span>
                    </div>
                    <div id="age" class="select_search">

                        <div>
                            &nbsp; <select name="min-age" class="select-min-age">
                                <option value="" selected="selected">من
                                </option>
                                <?php

                                for ($i = 18; $i <= 65; $i++) {
                                    echo "<option ";
                                    if (!empty($urls['min-age']) && $urls['min-age'] == $i)
                                        echo " selected='selected' ";
                                    echo "value=\"$i\">$i</option>\n";
                                }
                                ?>
                            </select>
                            -
                            <select name="max-age" class="select-max-age">
                                <option value="" selected="selected">إلي
                                </option>
                                <?php
                                for ($i = 18; $i <= 65; $i++) {
                                    echo "<option ";
                                    if (!empty($urls['max-age']) && $urls['max-age'] == $i)
                                        echo " selected='selected' ";
                                    echo "value=\"$i\">$i</option>\n";
                                }
                                ?>
                            </select>&nbsp;
                            <button style="vertical-align: bottom" onclick="document.form1.submit();"
                                    class="btn btn-default btn-sm" name="exp-btn">بحث
                            </button>
                            @if((!isset($_GET['nat'])) || ($_GET['nat']!=""))

                            @endif
                        </div>
                    </div>

                    <br>
                </div>
            </div>

            <div class="col-lg-9">
                <br>
                <h5 class="title-page"> السير الذاتية</h5>
                <br>


                <div>
                    <per>
                        {{  var_dump(json_encode($seekersArray, JSON_UNESCAPED_UNICODE)) }}
                    </per>
                    @foreach($seekersArray as $seekerArray)
<div class="cv-div">
<div class="cv-title">
 <li class="dropdown">
<button href="javascript:void(0)" class="btn btn-default  dropbtn  icon-cog-2" onclick="myFunction('{{$seekerArray['user_name']}}')">التحكم&nbsp;&nbsp;</button><div class="dropdown-content" id={{ $seekerArray['user_name'] }}>
@if(Auth::guard('employers')->check())
<a href="profile"><img src="{{asset('images/req-cv.png')}}"/> طلب تقدملوظيفة </a>  @endif <a class="icon-floppy" href="pdf/{{ $seekerArray['user_name'] }}"> حفظ </a></div></li><div class="cv-title-info"><span>أخر نشاط</span><span>{{ $seekerArray['last_seen'] }}</span></div></div>
                            <div class="cv-body">
                                <a href="/user/{{ $seekerArray['user_name'] }}"><img class="imgseeker-view"
                                                                                     src= @if($seekerArray["image"] != ""){{asset('images/seeker/140px_thumb_'.$seekerArray["image"] )}} @else {{asset('images/test.jpg')}} @endif /></a>
                                <table><tr> <td colspan="2" height="30"><span class="cvname"><a
                                                        href="/user/{{ $seekerArray['user_name'] }}">{{ $seekerArray['fname'] }} {{ $seekerArray['lname'] }}  </a></span><br>
<span class="texts">{{ $seekerArray['about']  }} &nbsp;</span><hr></td></tr><tr>
 @if($seekerArray['specialty'] !="") <td><label>التخصص: </label></td><td><span> {{ $seekerArray['specialty'] }}</span></td> @else <td><label>المجال: </label></td><td><span> {{ $seekerArray['domain_name'] }}</span></td> @endif </tr><tr><td><label>الشهادة: </label></td><td><span> {{ $seekerArray['edt_name'] }}</span></td></tr> <tr>
                                        <td>
                                            <label>الخبرة:</label>
                                        </td>
                                        <td>
                                            <span> <?php if (($seekerArray['sum_exp'] == '') || ($seekerArray['sum_exp'] == '0')) {
                                                    echo "لاتوجد";
                                                } else {
                                                    echo $seekerArray['sum_exp'] . " سنة";
                                                }?></span>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>

                                            <label>العنوان:</label></td>
                                        <td>
 <span> {{ $seekerArray['city_name'] }}
     @if($seekerArray['address'] != "")
         - {{ $seekerArray['address'] }}
     @endif
                        </span>
                                        </td>
                                    </tr>

                                </table>

                                <div class="skills">
                                    <span>التخصصات: </span>
                                    @foreach($seekerArray['spec'] as $skillsArray )
                                        <a class="btn btn-default"
                                           href="?spec={{$skillsArray}}"> {{ $skillsArray }} </a>
                                    @endforeach
</div></div></div><div><div></div></div>
                    @endforeach


                    <?php

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
                                $pagination .= '<a href="/cv/search' . $href . 'page=' . $i . '">' . $i . '</a>';
                        }
                        if ($page <= $lastpage - 3) {
                            $pagination .= " ... ";
                            $pagination .= '<a href="/cv/search' . $href . 'page=' . $page_count . '">' . $page_count . '</a>';
                        }
                        $pagination .= '</div>';


                    }
                    echo $pagination;


                    ?>
                </div>

            </div>

        </div>
    </div>
@stop