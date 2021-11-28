@inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
@extends('layouts.header')
@section('title', trans("page.Add-job"))

@section('content')


    <div class="container">
        <div class="row">
            @include('layouts.seeker')

            <div class="col-md-9 ">


                <h5 class="title-page"> نشر وظيفة</h5>

                @if(session('error'))
                    <div style="position: relative" class="alert alert-warning">


                        <strong>تنبيه!</strong> {{  session('error') }}
                    </div>
                @endif
                @if(count($errors)> 0)

                    <div style="position: relative" class="alert alert-danger">
                        <a href="javascript:void(0);" class="close" data-dismiss="alert"
                           aria-label="close">&times;</a>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                @endif
                <div class="jobpost-pad">

                    <div  class="form-group">
                        {!! Form::open(['action' =>array('Company\PostJobController@store', $company->comp_user_name),'class'=>'form-style-2','method'=>'POST']) !!}
                        <table width="100%">

                            <tr>
                                <td style="width: 90px;"> <label  for="job_name">العنوان<span  class="req">*</span></label></td>
                                <td><input id="job_name" class="form-control" value="{{ old('job_name') }}" name="job_name" type="text" required /></td>
                            </tr>

                            <tr>
                                <td><label for="job_desc">محتوي الإعلان<span class="req">*</span></label></td>
                                <td><textarea maxlength="14000" style="max-height:240px;width:100%;min-width:180px ;  height:180px; min-height:150px;" rows="120"  name="job_desc" id="job_desc" required>{{ old('job_desc') }}</textarea></td>

                            </tr>





                            <tr>
                                <td><label for="city_id">منظقة الوظيفة  <span class="req">*</span></label></td>
                                <td>
                                    <select id="city_id" name="city_id"  class="jobpost"  required>
                                        <option value=""  >
                                            المدينة
                                        </option>
                                        @foreach($city as $city)
                                            <option value="{{$city->city_id}}" @if($city->city_id == old('city_id')) selected @endif>{{$city->city_name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="domain_id">مجال الوظيفة  <span class="req">*</span></label></td>
                                <td>
                                    <select id="domain_id" name="domain_id" required >
                                        <option value="" >مجال الوظيفة</option>
                                        @foreach($domain as $domain)
                                            <option value="{{$domain->domain_id}}" @if($domain->domain_id == old('domain_id')) selected @endif>{{$domain->domain_name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>



                        </table>

                        <hr>

                        <table>

                            <tr>
                                <td>
                                    <label  for="is_active">
                                        حالة الأعلان

                                    </label>
                                </td>
                                <td>
                                    <select name="is_active" >
                                        <option value="1" selected >نشط</option>
                                        <option value="0">غير نشط</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label  for="day">
                                        مدة الإعلان

                                    </label>
                                </td>
                                <td>
                                    <select name="day" >
                                        <?php $cDay =0;?>
                                        @foreach($days as $day)
                                            <option value="{{$cDay++}}" @if($day == old('day')) selected @endif>{{$day}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr style="display: none">
                            <td>
                                <label  for="how_receive">
                                    طريقة التقدم علي الوظيفة
                                </label>
                            </td>
                            <td>
                                <select  onchange="changeDiv(this);" name="how_receive" >

{{--
  <option value="0" @if(old('how_receive',4) == 0 ) selected @endif   >بإستخدام النظام فقط</option>

                                                       <option class="all_option" value="1" @if(old('how_receive') == 1) selected @endif >باستخدام معلومات الاتصال فقط</option>

                                    <option value="2" >بإستخدام النظام ومعلومات الاتصال</option>
--}}
                                    <option class="all_option" value="1"  selected  >باستخدام معلومات الاتصال فقط</option>

                                </select>
                            </td>
                            </tr>
                        </table>
<script type="text/javascript">

    function changeDiv(sel)
    {
        var v = sel.value;
       if(v == 0){
           $("#all_id").hide();
       }else if(sel.value == 1){
           $("#all_id").show();
       }else{
           $("#all_id").hide();
       }
    }

</script>
                        {{--                         <div @if(old('how_receive') != 1 )  style="display: none" @endif  id="all_id">
 --}}
                        <div id="all_id">

                        <hr>

                        <table>

                            <tr>
                                <td> <label for="email">البريد (إختياري)</label></td>
                                <td><input id="email" value="{{ old('email') }}" class="form-control" name="email" type="text"  /></td>
                            </tr>

                            <tr>
                                <td> <label for="phone">الهاتف (إختياري)</label></td>
                                <td><input id="phone" value="{{ old('phone') }}" class="form-control" name="phone" type="text"  /></td>
                            </tr>
                            <tr>
                                <td> <label for="website">الموقع (إختياري)</label></td>
                                <td><input id="website" value="{{ old('website') }}" class="form-control" name="website" type="text"  /></td>
                            </tr>
                        </table>
                        </div>

                                 <input name="inserted" type="submit" value="حفظ ونشر" class="btn btn-primary btn-block"/>

                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop