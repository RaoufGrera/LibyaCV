@extends('layouts.header')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 cont">

                <br>
                @if(count($errors)> 0)

                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                @endif
                <br>
<div class="centers">


    <div class="cv-title center">
        <h2>تسجيل الدخول</h2>
    </div>
    <div class="centers-body">
            {!! Form::open(['url'=>'login','class'=>'form-style-2','method'=>'POST']) !!}



                    <div class="form-group">

                    <table  class="login-table">
                       <tbody>
                        <tr>
                            <td>
                                <label for="email">البريد الإلكتروني
                                </label>
                            </td>
                            <td><input type="email" class="form-control" name="email" /> </td>

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
