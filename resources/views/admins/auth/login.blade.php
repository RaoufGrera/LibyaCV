@extends('layouts.header-admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 cont">

                <br>

                <br>
<div class="centers">


    <div class="cv-title center">
        <h2>تسجيل الدخول</h2>
    </div>
    <div class="centers-body">
            {!! Form::open(['url'=>'/administrator/login','class'=>'form-style-2','method'=>'POST']) !!}
        @if(count($errors)> 0)

            <div class="alert alert-warning">
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
            <div class="alert alert-warning">
                <a href="javascript:void(0);" class="close" data-dismiss="alert"
                   aria-label="close">&times;</a>

                <strong>تنبيه!</strong> {{  session('error') }}
            </div>
        @endif
        @if(session('reset'))
            <div class="alert alert-warning">
                <a href="javascript:void(0);" class="close" data-dismiss="alert"
                   aria-label="close">&times;</a>

                <strong>تنبيه!</strong><span> البريد الإلكتروني غير مفعل. لتفعيل أنقر </span><a href="/email/send">هنا</a>
            </div>
        @endif
        @if(session('confirm'))
            <div class="alert alert-success">
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
                            <td><input type="email" class="form-control" name="email" value="{{ old('email') }}" /> </td>

                        </tr>

                        <tr>
                            <td><label for="password">الرقم السري</label></td>
                            <td><input type="password" class="form-control" name="password" /></td>
                        </tr>
                        <tr>

                        </tr>
                        <tr>
                            <td></td>
                            <td>   <button type="submit" class="btn btn-block btn-success">دخول</button>    </td>

                        </tr>
                        <tr>
                            <td colspan="2">
                                <hr>
                                <a href="/password/email" >إستعادة كلمة السر</a>
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
