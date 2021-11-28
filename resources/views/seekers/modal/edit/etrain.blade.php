@extends('layouts.header-modal')
@section('content')
<div>
    <div class="alert-face" >تعديل التدريب </div>
    <button type="button"  href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close" data-dismiss="modal">&times;</button>

    <div class="modal-face">

        {!! Form::open(["id"=>"myForm","method"=>"PATCH","class"=>"form-style-2"]) !!}
        <div class="mymodal">
        <table class="iteminli">
            <tr>
                <td>
                    <label for="train_name">
                        التدريب
                        <span class="req">*</span>
                    </label>
                </td>
                <td>
                    <input id="train_name" name="train_name" type="text" value="{{ $seeker_train->train_name }}"
                           maxlength="60" required placeholder="اسم التدريب"/>
                </td>
                <td>
                    <div class="tooltip train_name_val validation">

                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="train_comp">
                        اسم الجهة
                        <span class="req">*</span>
                    </label>
                </td>
                <td>
                    <input id="train_comp" name="train_comp" type="text" value="{{ $seeker_train->train_comp }}"
                           maxlength="60" required placeholder="اسم الجهة"/>
                </td>
                <td>
                    <div class="tooltip train_comp_val validation">

                    </div>
                </td>
            </tr>

            <tr>
                <td width="100">
                    <label for="train_date">
                        سنة
                        <span class="req">*</span>
                    </label>
                </td>
                <td>
                    <select id="train_date" name="train_date" required>
                        <option value="" selected="selected">
                            السنة
                        </option>
                        <?php
                        $y = date("Y");
                        for ($i = $y; $i >= 1960; $i--) {
                            echo "<option ";
                            if ($i == $seeker_train->train_date)
                                echo "selected='selected'";
                            echo "value=\"$i\">$i</option>\n";
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <div class="tooltip train_date_val validation">

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
    var id =  <?php echo  $seeker_train->train_id; ?>;
    $('#myForm').submit(function(e){
        e.preventDefault();
        var dataObject =  $("#myForm").serialize();
        editSaveRest('training/'+id ,'#training','#training',dataObject);
    });
</script>
@stop