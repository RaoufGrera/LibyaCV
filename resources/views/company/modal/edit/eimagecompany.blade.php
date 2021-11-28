<div>
    <div class="alert-face">تعديل  الصورة</div>
    <button type="button"  href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close" data-dismiss="modal">&times;</button>


    <div class="modal-face">

        {!! Form::open(["id"=> "myForm","method"=>"PATCH","class"=>"form-style-2","files"=>"true"]) !!}
        <div class="mymodal">
            <table class="iteminli">
                <tr>
                    <td><label for="comp_name">الصورة<span class="req">*</span></label> </td>
                    <td> <input name="image" id="file" type="file"></td>

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

    var name = "<?php echo $user; ?>" ;
    $('#myForm').submit(function(e){
        e.preventDefault();
        var dataObject =  new FormData($(this)[0]);
        editSaveCompany(name,'edit-image','#image',dataObject);
    });

</script>