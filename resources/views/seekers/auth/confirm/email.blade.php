<?php $notes=null ?>
{{--@if( Auth::guard('users')->check()) @endif--}}
@inject('company','App\Helpers\CompanyConstant')
<?php
$notes = $company->getNote();
?>
@extends('layouts.header')

<!-- Main Content -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 cont">

            <br>

            <br>
            <div class="centers">


                <div class="cv-title center">
                    <h2>إعادة ارسال رابط التفعيل</h2>
                </div>
                <div class="centers-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="panel-body">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-style-2" role="form" method="POST" action="{{ url('/confirm') }}">
                        {!! csrf_field() !!}

                        <div class="form-group">

                            <table  class="login-table">
                                <tbody>
                                <tr>
                                    <td>
                                        <label for="email">البريد الإلكتروني
                                        </label>
                                    </td>
                                    <td><input type="email" class="form-control" name="email" value="" /> </td>

                                </tr>


                                <tr>
                                    <td></td>
                                    <td>   <button type="submit" class="btn btn-block btn-info">ارسال رسالة التفعيل</button>    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
