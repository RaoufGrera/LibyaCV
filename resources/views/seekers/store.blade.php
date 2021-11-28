 @inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
@extends('layouts.header')
 @section('title',trans("page.store"))

 @section('content')

    <div class="container">
        <div class="row">
            @include('layouts.seeker')
            <div class="col-md-9 ">
                <br>
                <h5 class="title-page"> {{ trans("page.store") }}</h5>


                <div class="cont">

                    <h4>عروض الموقع</h4>
                    <hr>
                    <div  class="col-md-12 center oo sdh cont">
                    @foreach($store as $item)
                        <div class="col-md-3 center m10">
                            <div style="height: 160px;">
                                <img class="cimage" src="{{ asset('images/simple/'.$item->image) }}"/>
                                <strong>{{ $item->store_name }}</strong>
                                <br>
                                <span style="font-size:85%">{{ $item->store_desc }} </span>

                            </div>
                            <hr>
                            <span>{{ number_format($item->store_price) }} درهم </span>
                            <br>

                            @if('download' == $item->store_url)
                                @if(session('pay_cv') != '1')
                                    @if(session('price') >= $item->store_price)
                                        <a onclick="ShowStoreModal('{{$item->store_url}}')"
                                           class="btn btn-info btn-block ">شراء</a>
                                    @else
                                        <button class="btn btn-default btn-block disabled">رصيدك غير كافي</button>

                                    @endif
                                @else
                                    <span style=" display: block;padding: 6px 12px; ">تم الشراء</span>
                                @endif

                                @else
                                @if(session('price') >= $item->store_price)
                                    <a onclick="ShowStoreModal('{{$item->store_url}}')"
                                       class="btn btn-info btn-block ">شراء</a>
                                @else
                                    <button class="btn btn-default btn-block disabled">رصيدك غير كافي</button>

                                @endif
                            @endif
                        </div>

                    @endforeach
                    </div>
                    <div  class="col-md-12 center oo sdh cont">
                    <div class="col-md-3 center m10">
                        <div style="height: 160px;">
                            <img class="cimage" src="{{ asset('images/simple/billboard.png') }}"/>

                            <strong>أعلان تجاري</strong>
                            <br>
                            <span style="font-size:85%"> عرض أعلان تجاري في معظم صفحات الموقع لمدة 30 يوم </span>

                        </div>
                        <hr>
                        <span style="font-size:85%">تواصل مع إدارة الموقع</span><br><span>raouf.grera@gmail.com</span>

                    </div>
                    </div>


                    <a class="facebox" style="display: none"></a>
                    <img id="loading" src="{{asset('images/loading.gif')}}" style="display: none"/>

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