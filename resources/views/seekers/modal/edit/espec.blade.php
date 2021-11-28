@extends('layouts.header-modal')
@section('content')
<div>
    <div class="alert-face">تعديل التخصص</div>
    <button type="button"  href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close" data-dismiss="modal">&times;</button>


    <div class="modal-face">

        {!! Form::open(["id"=>"myForm","method"=>"PATCH","class"=>"form-style-2"]) !!}
        <div class="mymodal">


            <table class="iteminli">

                <tr>
                    <td>
                        <label for="spec">
التخصص
                            <span class="req">*</span>
                        </label>
                    </td>
                    <td>
                        <div class="input-group">
                        <input class="form-control" id="specSeeker" value="{{ $seeker_spec->spec_name }}" name="spec" autocomplete="off" type="text" value="" />
                        <ul id="specSeekerResults" class="lists">

                        </ul>
                        </div>
                    </td>
                </tr>
<tr>
    <td colspan="2">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </td>
</tr>
            </table>
        </div>
        <div class="modal-footer">
            <input type="submit" value="حفظ" class="btn btn-info"/>
            <a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();'
               class="btn btn-default ">إلغاء</a>
        </div>


        {!! Form::close() !!}

    </div>

</div>
<script type="text/javascript">
    var id =  <?php echo $seeker_spec->spec_seeker_id; ?>;
    $('#myForm').submit(function(e){
        e.preventDefault();
        var dataObject =  $("#myForm").serialize();
        editSaveRest('specialtys/'+id ,'#specialtys','#specialtys',dataObject);
    });
    $("#specSeeker").delayKeyup(function() {
        searchAjax("#specSeeker","spec","#specSeekerResults");
    },700);
    $("#specSeeker").blur(function(){
                $("#specSeekerResults").fadeOut(500);
            })
            .focus(function() {
                $("#specSeekerResults").show();
            });
</script>
<script   type="text/javascript" src="{{asset('js/app.js')}}"></script>

@stop