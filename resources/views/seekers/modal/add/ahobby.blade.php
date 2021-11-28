@extends('layouts.header-modal')
@section('content')
<div>
    <div class="alert-face">أضافة هواية جديدة</div>
    <button type="button" href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close"
            data-dismiss="modal">&times;</button>

    <div class="modal-face">
        {!! Form::open(["id"=>"myForm","method"=>"POST","class"=>"form-style-2"]) !!}
        <div class="mymodal">


            <table class="iteminli">
                <tr>
                    <td>
                        <label for="hobby_name">
                            الهواية
                            <span class="req">*</span>
                        </label>
                    </td>
                    <td>
                        <div class="input-group">
                        <input id="hobby_name" autocomplete="off" class="form-control" name="hobby_name" type="text" maxlength="60" required
                               placeholder="مثل: الشطرنج، القراءة..."   />
                            <ul id="hobbyResults" class="lists">

                            </ul>
                        </div>
                    </td>

                </tr>

            </table>
        </div>
        <div class="modal-footer">
            <input type="submit" value="حفظ" class="btn btn-info"/>
            <a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();'
               class="btn btn-default ">إلغاء</a>
        </div>
    </div>

    {!! Form::close() !!}

</div>

<script type="text/javascript">
    $('#myForm').submit(function(e){
        e.preventDefault();
        var dataObject =  $("#myForm").serialize();
        editSaveRest('hobby','#hobby','#hobby',dataObject);
    });
    $("#hobby_name").delayKeyup(function() {searchAjax("#hobby_name","hobby","#hobbyResults");},700);$("#hobby_name").blur(function(){$("#hobbyResults").fadeOut(500);}).focus(function() {$("#hobbyResult").show();});

</script>
<script   type="text/javascript" src="{{asset('js/app.js')}}"></script>
@stop