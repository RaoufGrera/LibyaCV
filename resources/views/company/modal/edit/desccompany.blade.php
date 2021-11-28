<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {


?>
<div>
    <div class="alert-face">تعديل نبذة عن الشركة</div>
    <button type="button"  href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close" data-dismiss="modal">&times;</button>

<script type="text/javascript">
//    if (typeof jQuery != 'undefined') {
        // jQuery is loaded => print the version
//   00     alert(jQuery.fn.jquery);}else{

    //}
</script>

    <div class="modal-face">

        {!! Form::open(["id"=>"myForm","method"=>"PATCH","class"=>"form-style-2"]) !!}
        <div class="mymodal">
            <table class="iteminli">
                <tr>
                    <td><label for="desc_comp">عن الشركة  <span class="req">*</span></label> </td>
                    <td>
                        <textarea  maxlength="2000" style="max-height:250px;width:180px ; max-width:300px;height:200px; min-height:150px;" rows="80" name="desc_comp" id="desc_comp">{{ $desc->comp_desc }}</textarea>
                    </td>
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
        var dataObject =  $("#myForm").serialize()
        editSaveRestCompany(name,'edit-description','#description',dataObject);
    });

</script>
<?php
} else {
echo "خطاء في طريقة طلب البيانات.";
}
?>