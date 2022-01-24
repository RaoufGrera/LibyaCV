@inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
@extends('layouts.header')
@section('title',"دعم المشروع")
@section('keywords',trans("desc.keywords"))
@section('image',asset('images/logo/logofb.jpg'))
@section('url',trans('desc.url'))
@section('description',trans('desc.description'))
@section('content')

    <div class="container">
        <div class="row">
             <div class="col-md-12 ">
                <br>
                <h5 class="title-page"> لدعم المشروع  </h5>
   

                <br>

                     USDT - network is Tron (TRC20)
                     <br>
                     <code style="    border: 2px solid #476e49;
                     background: #e8f5e9;
                     border-radius: 8px;
                     padding: 6px 10px;">TGkYiPxHJVRAPPGiHcCioYBqt4PJaQkK6J</code>
<br>
<br>
<h5 class="title-page"> لدفع تكاليف الاستضافة بشكل مباشر من خلال الحساب</h5>

<h4><a href="https://my.vultr.com/"> Vultr Hosting</a></h4>
           <span>User name <code style="background: #e3f2fd;
            border-radius: 8px;
            padding: 3px 7px;">it1992t@gmail.com</code>
           <br>
           <span>Password <code style="background: #e3f2fd;
            border-radius: 8px;
            padding: 3px 7px;">d8ZjSZ872VCEk!y</code></span>



             </div>
        </div>

    </div>
@stop