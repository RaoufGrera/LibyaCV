@extends('layouts.header-admin')
@section('content')
<div class="container">
    <div class="row">
        <br>
        <br>                    <br>
        <div class="col-md-6 col-md-offset-3">
          <!--  @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                  -->
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
            <div class="panel panel-default">


                <div class="panel-heading"><h4>أنشاء حساب</h4></div>
                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group {{ $errors->has('fname') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">الأسم الأول</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="fname" value="{{ old('fname') }}">
                                @if ($errors->has('fname'))
                                    <span class="help-block">
                                        <span>{{ $errors->first('fname') }}</span>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('lname') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">اللقب</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="lname" value="{{ old('lname') }}">
                                @if ($errors->has('lname'))
                                    <span class="help-block">
                                        <span>{{ $errors->first('lname') }}</span>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">أسم المستخدم</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <span>{{ $errors->first('name') }}</span>
                                    </span>
                                @endif
                            </div>
                        </div>

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


                        <div class="form-group">
                            <label class="col-md-4 control-label">الجنس</label>

                            <div class="col-md-6">

                                <select class="form-control" id="sex" name="sex">

                                    <option value="m" >ذكر</option>
                                    <option value="f" >أنثي</option>
                                </select>
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
                                <button type="submit" class="btn btn-success btn-block">تسجيل
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
