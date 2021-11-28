<?php $notes=null ?>
{{--@if( Auth::guard('users')->check()) @endif--}}
@inject('company','App\Helpers\CompanyConstant')
<?php
$notes = $company->getNote();
?>
@extends('layouts.header')
@section('title',trans("page.register"))

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 cont">
        <br>                    <br>
        <div class="col-md-6 col-md-offset-3 " style="    border: 1px solid #ccb160;
    padding: 0;">
            <div style="padding: 5px;
    border-bottom: 1px solid #d3a82a;
    background-color: #ffdc73;" class="center">
                <h2 >{{ trans('page.register') }}</h2>
            </div>
            <div class="centers-body">

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
                    @if(session('error'))
                        <div style="position: relative" class="alert alert-warning">
                            <a href="javascript:void(0);" class="close" data-dismiss="alert"
                               aria-label="close">&times;</a>

                            <strong>تنبيه !</strong> {{  session('error') }}
                        </div>
                    @endif
                    @if(session('ok'))
                        <div style="position: relative" class="alert alert-success">
                            <a href="javascript:void(0);" class="close" data-dismiss="alert"
                               aria-label="close">&times;</a>

                            <strong>تنبيه !</strong> {{  session('ok') }}
                        </div>
                    @endif

                        <form class="form-style-2" role="form" method="POST" action="{{ url('register') }}">
                        {!! csrf_field() !!}
                            <div class="form-group">

                                <table class="login-table">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <label for="fname">الأسم
                                            </label>
                                        </td>
                                        <td><input type="text" class="form-control" name="fname"
                                                   value="{{ old('fname') }}"/></td>

                                    </tr>




                                    <tr>
                                        <td>
                                            <label for="email">البريد الإلكتروني
                                            </label>
                                        </td>
                                        <td><input style="width: 100%" type="email" class="form-control" name="email"
                                                   value="{{ old('email') }}"/></td>

                                    </tr>

                                    <tr>
                                        <td>
                                            <label for="sex">الجنس
                                            </label>
                                        </td>
                                        <td>   <select class="form-control" id="sex" name="sex">

                                                <option value="m" >ذكر</option>
                                                <option value="f" >أنثي</option>
                                            </select></td>

                                    </tr>

                                    <tr>
                                        <td><label for="password">الرقم السري</label></td>
                                        <td><input type="password" class="form-control" name="password"/></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label for="password_confirmation">تأكيد كلمة السر</label>
                                        </td>
                                        <td><input type="password" class="form-control" name="password_confirmation"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <button type="submit"
                                                    class="btn btn-block btn-primary">إنشاء حساب</button><br>


                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                                <a href="/login/facebook" class="btn btn-face font-md btn-block icon-facebook-official"  >تسجيل عن طريق الفيسبوك</a>
                                <a href="/login/google" class="btn   btn-block font-md  btn-danger icon-gplus-squared" >تسجيل عن طريق الجوجل</a>
                            </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
