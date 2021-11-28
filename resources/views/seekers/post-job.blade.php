
@extends('layouts.header')
@section('title', trans("page.Add-job"))

@section('content')
    <div class="container">
        <div class="row">


            <div class="col-md-8 col-lg-offset-2 ">

                <br>
                <h5 class="title-page"> إنشاء أعلان جديد</h5>

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
                        {!! Form::open(['action' =>array('SeekersController@storejob'),'class'=>'form-style-2','method'=>'POST']) !!}
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


                         <h5 id="settings">معلومات الإتصال (1 إجباري)</h5>
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