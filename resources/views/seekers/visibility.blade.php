 @inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
@extends('layouts.header')
 @section('title',trans("page.visibility"))

 @section('content')

    <div class="container">
        <div class="row">
            @include('layouts.seeker')
            <div class="col-md-9 ">
                <br>
                <h5 class="title-page"> المشاهدات</h5>
                <br>

                <div class="cont">
                    @if(session('error'))
                        <div class="alert alert-warning">
                            <a href="javascript:void(0);" class="close" data-dismiss="alert"
                               aria-label="close">&times;</a>

                            <strong>تنبيه!</strong> {{  session('error') }}
                        </div>
                    @endif
                    <br>

                    @if($visits->see_it > 0 )

                           <h4> عدد المشاهدات {{ $visits->see_it }}</h4>



                        </div>
                    @else
                            <div class="alert alert-info">
                        <span>لاتوجد مشاهدات لسيرتك الذاتية</span>
                                </div>
                    @endif


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