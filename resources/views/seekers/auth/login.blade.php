<?php $notes=null ?>
{{--@if( Auth::guard('users')->check()) @endif--}}
@inject('company','App\Helpers\CompanyConstant')
<?php
$notes = $company->getNote();
?>
@extends('layouts.header_ads')
 @section('title',trans("page.login"))
@section('keywords',trans("desc.keywords"))
@section('image',asset('images/logo/logofb.jpg'))
@section('url',trans('desc.url'))
@section('description',trans('desc.description'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 cont">

                <br>

                <br>
                <style>
                    .centers-body {
                        /* padding: 18px; */
                        padding: 18px 25px;
                    }
                </style>
<div class="col-md-6 col-md-offset-3 " style="    border: 1px solid #ccb160;
    padding: 0;">

    <div style="padding: 5px;
    border-bottom: 1px solid #d3a82a;
    background-color: #ffdc73;" class="center">
        <h2>تسجيل الدخول</h2>
    </div>
    <div class="centers-body">
            {!! Form::open(['url'=>'login','class'=>'form-style-2','method'=>'POST']) !!}
        @if(count($errors)> 0)

            <div style="position: relative" class="alert alert-warning">
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

                <strong>تنبيه!</strong> {{  session('error') }}
            </div>
        @endif
        @if(session('reset'))
            <div style="position: relative" class="alert alert-warning">
                <a href="javascript:void(0);" class="close" data-dismiss="alert"
                   aria-label="close">&times;</a>

                <strong>تنبيه!</strong><span> البريد الإلكتروني غير مفعل. لتفعيل أنقر </span><a href="/confirm">هنا</a>
            </div>
        @endif
        @if(session('confirm'))
            <div style="position: relative" class="alert alert-success">
                <a href="javascript:void(0);" class="close" data-dismiss="alert"
                   aria-label="close">&times;</a>

                <strong>تنبيه!</strong><span>{{ session('confirm') }}</span>
            </div>
        @endif

                    <div class="form-group">

                    <table  class="login-table">
                       <tbody>
                        <tr>
                            <td>
                                <label for="email">البريد الإلكتروني
                                </label>
                            </td>
                            <td><input style="width: 100%" type="email" class="form-control" name="email" value="{{ old('email') }}" /> </td>

                        </tr>

                        <tr>
                            <td><label for="password">الرقم السري</label></td>
                            <td><input type="password" class="form-control" name="password" /></td>
                        </tr>
                        <tr>

                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button type="submit" class="btn btn-block btn-primary">دخول</button>
                                 <a  href="/password/email" >إستعادة كلمة السر</a>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <hr>
                                <a href="/login/facebook" class="btn btn-face font-md btn-block icon-facebook-official"  >تسجيل عن طريق الفيسبوك</a>
                                <a href="/login/google" class="btn   btn-block font-md  btn-danger icon-gplus-squared" >تسجيل عن طريق الجوجل</a>

                            </td>
                        </tr>


                       </tbody>
                        </table>
                    </div>

                {!! Form::close() !!}

    </div>
                </div>

            </div>
        </div>
    </div>
@stop
