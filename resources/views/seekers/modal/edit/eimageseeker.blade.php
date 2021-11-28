@extends('layouts.header-modal')
@section('content')
<div>
    <div class="alert-face">تعديل  الصورة</div>
    <button type="button"  href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close" data-dismiss="modal">&times;</button>


    <div class="modal-face">

        {!! Form::open(["id"=> "myForm","method"=>"POST","class"=>"form-style-2","files"=>"true"]) !!}
        <div class="mymodal">
            <table class="iteminli">
                <tr>
                    <td><label >الصورة<span class="req">*</span></label> </td>
                    <td> {!! Form::file('image', null) !!}</td>

                </tr>




            </table>
        </div>
        <div class="modal-footer">
            <input name="insert_edd" type="submit" value="حفظ" class="btn btn-info"/>
            <a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();'
               class="btn btn-default ">إلغاء</a>
        </div>


        {!! Form::close() !!}

    </div>

</div>
<script type="text/javascript">

     $('#myForm').submit(function(e){
        e.preventDefault();
        var dataObject =  new FormData($(this)[0]);
         editSaveImage('image','#image','#image',dataObject);
    });

</script>
@stop