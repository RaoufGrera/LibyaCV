@inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
@extends('layouts.header')
@section('title', trans("page.edit-job"))

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.seeker')

            <div class="col-md-9 ">

                <br>
                <h5 class="title-page"> تعديل الإعلان</h5>
                <br>
                @if(session('error'))
                    <div class="alert alert-warning">


                        <strong>تنبيه!</strong> {{  session('error') }}
                    </div>
                @endif

                <div class="jobpost-pad">

                    <div  class="form-group">
                        {!! Form::open(['action' =>array('Company\PostJobController@update', $user,$job->desc_id),'class'=>'form-style-2',"method"=>"PATCH"]) !!}
                        <table width="100%">

                            <tr>
                                <td style="width: 90px;"> <label for="job_name">العنوان<span  class="req">*</span></label></td>
                                <td><input id="job_name" class="form-control" name="job_name"  value="{{old('job_name', $job->job_name)}}" type="text" required /></td>
                            </tr>

                            <tr>
                                <td><label for="job_desc">محتوي الإعلان<span class="req">*</span></label></td>
                                <td><textarea maxlength="14000" style="max-height:250px;width:100%;min-width:130px ; max-width:300px; height:200px; min-height:150px;" rows="80" name="job_desc" id="job_desc" required>{{old('job_desc', $job->job_desc)}} </textarea></td>

                            </tr>





                            <tr>
                                <td><label for="city_id">منظقة الوظيفة  <span class="req">*</span></label></td>
                                <td>
                                    <select id="city_id" name="city_id"  class="jobpost"  required>
                                        @foreach($city as $cit)
                                            @if($cit->city_id == old('city_id', $job->city_id))
                                                <option value="{{$cit->city_id}}" selected>{{$cit->city_name}}</option>
                                                @continue
                                            @endif
                                            <option value="{{$cit->city_id}}">{{$cit->city_name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="domain_id">مجال الوظيفة  <span class="req">*</span></label></td>
                                <td>
                                    <select id="domain_id" name="domain_id" required >
                                         @foreach($domain as $dom)
                                            @if($dom->domain_id == old('domain_id', $job->domain_id))
                                                <option value="{{$dom->domain_id}}" selected>{{$dom->domain_name}}</option>
                                                @continue
                                            @endif
                                            <option value="{{$dom->domain_id}}">{{$dom->domain_name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                        </table>


                        <br>
                        <h5 id="settings">إعدادت الإعلان</h5>
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
                                        <option value="1" @if(old('how_receive', $job->is_active) == 1 ) selected @endif >نشط</option>
                                        <option value="0" @if(old('how_receive', $job->is_active)  == 0) selected @endif >غير نشط</option>
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
                          {{--  <tr>
                                <td>
                                    <label  for="how_receive">
                                        طريقة التقدم علي الوظيفة
                                    </label>
                                </td>
                                <td>
                                    <select  onchange="changeDiv(this);" name="how_receive" >
                                        <option value="0" @if(old('how_receive', $job->how_receive) == 0 ) selected @endif   >بإستخدام النظام فقط</option>
                                        {{--
                                                                            <option value="2" >بإستخدام النظام ومعلومات الاتصال</option>
                                        -}}
                                        <option class="all_option" value="1" @if(1 == old('how_receive', $job->how_receive)) selected @endif >باستخدام معلومات الاتصال فقط</option>
                                    </select>
                                </td>
                            </tr>--}}
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
                        <div @if(old('how_receive', $job->how_receive) != 1 )  style="display: block" @endif  id="all_id">
                            <h5 id="settings">معلومات الإتصال (1 إجباري)</h5>
                            <hr>

                            <table>

                                <tr>
                                    <td> <label for="email">البريد (إختياري)</label></td>
                                    <td><input id="email" value="{{old('email', $job->email)}}" class="form-control" name="email" type="text"  /></td>
                                </tr>

                                <tr>
                                    <td> <label for="phone">الهاتف (إختياري)</label></td>
                                    <td><input id="phone"  value="{{old('phone', $job->phone)}}"  class="form-control" name="phone" type="text"  /></td>
                                </tr>
                                <tr>
                                    <td> <label for="website">الموقع (إختياري)</label></td>
                                    <td><input id="website"   value="{{old('website', $job->website)}}" class="form-control" name="website" type="text"  /></td>
                                </tr>
                            </table>
                        </div>
                        <table>
                            <tr>
                                <td></td>
                                <td>   <input name="inserted" type="submit" value="حفظ" class="btn btn-success btn-block"/></td>
                            </tr>
                            </tbody>
                        </table>
                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop