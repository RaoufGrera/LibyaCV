@extends('layouts.header-modal')
@section('content')
<div>
    <div class="alert-face">تحديث السيرة الذاتية</div>
    <button type="button" href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close"
            data-dismiss="modal">&times;</button>

    <div class="modal-face">
        {!! Form::open(["id"=>"myForm",'url' => '/profile/update-cv',"method"=>"POST","class"=>"form-style-2"]) !!}
        <div class="mymodal">


            <table class="iteminli">
                <tr>
                    <td><span>
                           <br> <p>عند اجراء اي تعديل يرجي اجراء تحديث جديد وذلك لعرض التعديلات في نتائج البحث
                            </p>

                        </span>

                    </td>


                </tr>

            </table>
        </div>
        <div class="modal-footer">
            <input type="submit" value="تحديث" class="btn btn-info"/>
            <a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();'
               class="btn btn-default ">إلغاء</a>
        </div>
    </div>

    {!! Form::close() !!}

</div>

@stop