 @inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
@extends('layouts.header')
 @section('title',trans("page.notification"))

 @section('content')
    <script type="application/javascript">
        function Toggle(item) {
            objReq = document.getElementById(item);
            visible = (objReq.style.display != "none")
            if (visible) {
                objReq.style.display = "none";
            } else {
                objReq.style.display = "block";
            }
        }
    </script>
    <div class="container">
        <div class="row">
            @include('layouts.seeker')
            <div class="col-md-9 ">
                <br>
                <h5 class="title-page"> الإشعارات</h5>
                <br>

                <div class="cont">
                    @if(session('error'))
                        <div class="alert alert-warning" style="position: relative">
                            <a href="javascript:void(0);" class="close" data-dismiss="alert"
                               aria-label="close">&times;</a>

                            <strong>تنبيه!</strong> {{  session('error') }}
                        </div>
                    @endif
                    <br>

                    @if(count($notesData) > 0 )

                        @foreach($notesData as $noteData)
                            <span>{{ $noteData->data }}</span>
                        <hr>
                        @endforeach

                    @else
                            <div class="alert alert-info" style="position: relative">
                        <span>لاتوجد لديك اشعارات</span>
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