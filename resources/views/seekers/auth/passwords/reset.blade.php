<?php $notes=null ?>
{{--@if( Auth::guard('users')->check()) @endif--}}
@inject('company','App\Helpers\CompanyConstant')
<?php
$notes = $company->getNote();
?>
@extends('layouts.header')

@section('content')
<div class="container">
    <div class="row">
        @if(session('error'))
            <div class="alert alert-warning">
                <a href="javascript:void(0);" class="close" data-dismiss="alert"
                   aria-label="close">&times;</a>

                <strong>تنبيه!</strong> {{  session('error') }}
            </div>
        @endif
        @if(session('ok'))
            <div class="alert alert-success">
                <a href="javascript:void(0);" class="close" data-dismiss="alert"
                   aria-label="close">&times;</a>

                <strong>تنبيه!</strong> {{  session('ok') }}
            </div>
        @endif
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">إستعادة كلمة السر</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {!! csrf_field() !!}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">البريد الإلكتروني</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <span>{{ $errors->first('email') }}</span>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">الرقم السري</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <span>{{ $errors->first('password') }}</span>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">تأكيد الرقم السري</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-refresh"></i>استعادة كلمة السر
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
