@extends('layouts.header-modal')
@section('content')
<div>
    <div class="alert-face">أضافة مهارة جديدة</div>
    <button type="button"  href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close" data-dismiss="modal">&times;</button>


    <div class="modal-face">

        {!! Form::open(["id"=>"myForm","method"=>"POST","class"=>"form-style-2"]) !!}
        <div class="mymodal">


            <table class="iteminli">

                <tr>
                    <td>
                        <label for="skills">
                            المهارة
                            <span class="skills_name">*</span>
                        </label>
                    </td>
                    <td>
                        <input id="skills_name" name="skills_name"  type="text" value="" />

                    </td>
                </tr>
                <tr>
                    <td width="100">
                        <label for="level_id">
                            المستوي
                            <span class="req">*</span>
                        </label>
                    </td>
                    <td>
                        <select id="level_id" name="level_id" required>
                            <option value="" selected="selected">
                                المستوي
                            </option>
                            @foreach($level as $levels)
                                <option value="{{$levels->level_id}}">{{$levels->level_name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <div class="tooltip level_id_val validation">

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


        {!! Form::close() !!}

    </div>

</div>
<script type="text/javascript">
    $('#myForm').submit(function(e){
        e.preventDefault();
        var dataObject =  $("#myForm").serialize();
        editSaveRest('skills','#skills','#skills',dataObject);
    });
</script>
@stop