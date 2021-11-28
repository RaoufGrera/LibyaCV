 @inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
@extends('layouts.header')
 @section('title',trans("page.setting"))

 @section('content')

    <div class="container">
        <div class="row">
            @include('layouts.seeker')
            <div class="col-md-9 ">
                <br>
                <h5 class="title-page"> إعدادات الحساب</h5>
                <br>

                <div class="cont">
                    @if(session('error'))
                        <div class="alert alert-warning" style="position: relative">
                            <a href="javascript:void(0);" class="close" data-dismiss="alert"
                               aria-label="close">&times;</a>

                            <strong>تنبيه!</strong> {{  session('error') }}
                        </div>
                    @endif

                        @if(session('ok'))
                            <div  class="alert alert-success" style="position: relative">
                                <a href="javascript:void(0);" class="close" data-dismiss="alert"
                                   aria-label="close">&times;</a>

                                <strong>تنبيه!</strong> {{  session('ok') }}
                            </div>
                        @endif

                        <br>
                        <h4>تحديث كلمة السر</h4>
                        <hr>

                        <div  class="form-group">
                            {!! Form::open(['url'=>'/profile/settings/password','class'=>'form-style-2','method'=>'PATCH','autocomplete'=>'off']) !!}
                            <table>
                                <tbody>
                                <tr>
                                    <td><label for="password">كلمة السر الحالية</label></td>
                                    <td><input id="password" class="form-control" autocomplete="off" name="password" type="password" /></td>
                                </tr>
                                <tr>
                                    <td><label for="newpassword">كلمة السر الجديدة</label></td>
                                    <td><input id="newpassword" class="form-control" autocomplete="off"sss name="newpassword" type="password" /></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>   <input name="inserted" type="submit" value="تغيير كلمة السر" class="btn btn-success btn-block"/></td>
                                </tr>
                                </tbody>
                           </table>
                            {!! Form::close() !!}
                        </div>
                        <br>
                        <br>
                        <h4>أعدادات السيرة الذاتية</h4>
                        <hr>

                        <div  class="form-group">
                            {!! Form::open(['url'=>'/profile/settings/cv','class'=>'form-style-2','method'=>'PATCH','autocomplete'=>'off']) !!}
                            <table>
                                <tbody>

                            <tr><td>
                                    <label  for="cv">السيرة الذاتية</label>
                                </td>
                                <td>
                                    <select name="cv">
                                        <option value="0" @if($job_seeker->hide_cv == 0 || $job_seeker->hide_cv == NULL) selected @endif >أظهار السيرة الذاتية</option>
                                        <option value="1" @if($job_seeker->hide_cv == 1) selected @endif>أخفاء بيانات السيرة الذاتية</option>
                                     </select>
                                </td></tr>
                            <tr>
                                <td></td>
                                <td>   <input name="inserted" type="submit" value="حفظ" class="btn btn-success btn-block"/></td>
                            </tr>
                            </tbody>
                        </table>
                            {!! Form::close() !!}
                        </div>

                        <br>
                        <h4>أعدادات الصورة الشخصية</h4>
                        <hr>

                        <div  class="form-group">
                            {!! Form::open(['url'=>'/profile/settings/image','class'=>'form-style-2','method'=>'PATCH','autocomplete'=>'off']) !!}
                            <table>
                                <tbody>

                                <tr><td>
                                        <label  for="image">الصورة الشخصية</label>
                                    </td>
                                    <td>
                                        <select name="image">
                                            <option value="0" @if($job_seeker->image_view == 0 || $job_seeker->image_view == NULL) selected @endif >إخفاء عن الكل</option>
                                            <option value="1" @if($job_seeker->image_view == 1) selected @endif>عرض للكل</option>
                                            <option value="2" @if($job_seeker->image_view == 2) selected @endif>عرض للموظف المتقدم علي إعلانه</option>
                                        </select>
                                    </td></tr>
                                <tr>
                                    <td></td>
                                    <td>   <input name="inserted" type="submit" value="حفظ" class="btn btn-success btn-block"/></td>
                                </tr>
                                </tbody>
                            </table>
                            {!! Form::close() !!}
                        </div>


                        <br>
                        <h4>أعدادات رقم الهاتف </h4>
                        <hr>

                        <div  class="form-group">
                            {!! Form::open(['url'=>'/profile/settings/phone','class'=>'form-style-2','method'=>'PATCH','autocomplete'=>'off']) !!}
                            <table>
                                <tbody>

                                <tr><td>
                                        <label  for="phone">رقم الهاتف</label>
                                    </td>
                                    <td>
                                        <select name="phone">
                                            <option value="0" @if($job_seeker->phone_view == 0 || $job_seeker->phone_view == NULL) selected @endif >إخفاء عن الكل</option>
                                            <option value="1" @if($job_seeker->phone_view == 1) selected @endif>عرض للكل</option>
                                            <option value="2" @if($job_seeker->phone_view == 2) selected @endif>عرض للموظف المتقدم علي إعلانه</option>
                                        </select>
                                    </td></tr>
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

    <script language="javascript">
        function deleteItem() {
            if (confirm("هل أنت متأكد من الحذف؟")) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@stop