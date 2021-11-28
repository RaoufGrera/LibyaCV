@extends('layouts.header-modal')
@section('content')
    <div>
        <div class="alert-face">رسالة إدارية</div>
        <button type="button"  href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close" data-dismiss="modal">&times;</button>


        <div class="modal-face">


            <div class="mymodal">


                <table class="iteminli">

                    <tr>
                        <td colspan="2">
<span>ليست لديك صلاحيات لطلب هذه الصفحة.</span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">

                <a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();'
                   class="btn btn-default ">إلغاء</a>
            </div>




        </div>


    </div>

@stop