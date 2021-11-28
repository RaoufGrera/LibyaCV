@inject('company','App\Helpers\CompanyConstant');
<?php  $notes = $company->getNote();?>
@extends('layouts.header')
@section('content')
    <script type="application/javascript">
        function Toggle(item) {
            objReq = document.getElementById(item);
            //  visible = (objReq.style.maxHeight != "auto")
            if (objReq.style.maxHeight == "92px") {
                objReq.style.maxHeight = "100vh";
            } else {
                objReq.style.maxHeight = "92px";
            }
        }
    </script>


    <div class="container">
        <div class="row">


            <div class="col-lg-12">


                <br>
                <h5 class="title-page"> المجال</h5>
                <br>
                <div class="row">
                <div class="col-md-3">
                    تقنية معلومات
                </div>
                <div class="col-md-3">
                    تقنية معلومات
                </div>
                <div class="col-md-3">
                    تقنية معلومات
                </div>
                <div class="col-md-3">
                    تقنية معلومات
                </div>
                <div class="col-md-3">
                    تقنية معلومات
                </div>
                </div>

             </div>
        </div>
    </div>
@stop