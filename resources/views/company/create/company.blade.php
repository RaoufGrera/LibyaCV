@inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
@extends('layouts.header')
@section('title', trans("page.add-company"))

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
                        <h2>إنشاء شركة</h2>
                    </div>
                    <div class="centers-body">
                        @if(session('error'))
                            <div style="position: relative" class="alert alert-warning">


                                <strong>تنبيه!</strong> {{  session('error') }}
                            </div>
                        @endif

                <div class="form-group">
                    {!! Form::open(['url'=>'create-company','class'=>'form-style-2','method'=>'POST']) !!}
                    <table  class="login-table">
                        <tbody>
                        <tr>
                            <td><label for="comp_name">اسم الشركة</label></td>
                            <td><input id="comp_name" class="form-control" required name="comp_name" type="text"/></td>
                        </tr>

                    <tr>
                            <td><label for="comp_user_name">الشركة</label></td>
                            <td><input id="comp_user_name" required placeholder="EnglishName" class="form-control" name="comp_user_name" type="text" /></td>

                        </tr>


                        <tr>   <td><label for="city_id">المدينة</label></td>
                        <td>
                            <select id="city_id" name="city_id" required>
                                <option value="0" selected="selected">
                                    المدينة
                                </option>
                                @foreach($city as $city)
                                    <option value="{{$city->city_id}}">{{$city->city_name}}</option>
                                @endforeach
                            </select>
                        </td></tr>
                        <tr>


                        <td><label for="domain_id">مجال الشركة</label></td>
                        <td>
                            <select id="domain_id" name="domain_id" required>
                                <option value="0" selected="selected">
                                    المجال
                                </option>
                                @foreach($domain as $domain)
                                    <option value="{{$domain->domain_id}}">{{$domain->domain_name}}</option>
                                @endforeach
                            </select>
                        </td>
                        </tr>
                        <tr>

                            <td></td>
                            <td><input name="inserted" type="submit" value="إنشــاء" class="btn btn-primary btn-block"/>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    {!! Form::close() !!}

                </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
@stop