<?php $__env->startSection('content'); ?>
<div>
    <div class="alert-face"> تعديل المؤهل العلمي</div>
    <button type="button"  href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close" data-dismiss="modal">&times;</button>


    <div class="modal-face">

        <?php echo Form::open(["id"=>"myForm","method"=>"PATCH","class"=>"form-style-2"]); ?>

        <div class="mymodal">
            <table class="iteminli">
                <tr>
                    <td>
                        <label for="ed_name">
                            المؤهل العلمي
                            <span class="req">*</span>

                        </label>
                    </td>
                    <td>


                        <select id="ed_name" name="ed_name">
                            <?php $__currentLoopData = $ed_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ed_types): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($ed_types->edt_id == $seeker_ed->edt_id): ?>
                                    <option value="<?php echo e($ed_types->edt_id); ?>"
                                            selected="selected"><?php echo e($ed_types->edt_name); ?></option>
                                    <?php continue; ?>
                                <?php endif; ?>
                                <option value="<?php echo e($ed_types->edt_id); ?>"><?php echo e($ed_types->edt_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select></td>
                    <td>
                        <div class="tooltip ed_name_val validation">

                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="dom_name">المجال
                            <span class="req">*</span>
                        </label>
                    </td>
                    <td>
                        <select id="dom_name" name="dom_name">

                            <?php $__currentLoopData = $domain_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $domain): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($domain->domain_id == $seeker_ed->domain_id): ?>
                                    <option value="<?php echo e($domain->domain_id); ?>"
                                            selected="selected"><?php echo e($domain->domain_name); ?></option>
                                    <?php continue; ?>
                                <?php endif; ?>
                                <option value="<?php echo e($domain->domain_id); ?>"><?php echo e($domain->domain_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </td>
                    <td>
                        <div class="tooltip dom_name_val validation">

                        </div>
                    </td>
                </tr>


                <tr>
                    <td>
                        <label for="univ">
                            الجامعة
                            <span class="req">*</span>
                        </label>
                    </td>
                    <td>
                        <div class="input-group">
                            <input class="form-control" autocomplete="off" id="university" name="univ" type="text"    value="<?php echo e($seeker_ed->univ_name); ?>" maxlength="120" placeholder="الجامعة"/>
                            <ul id="univResults" class="lists">

                            </ul>
                        </div>

                    </td>
                    <td>
                        <div class="tooltip univ_val validation">

                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="faculty">
                            الكلية

                        </label>
                    </td>
                    <td>
                        <div class="input-group">
                            <input class="form-control" id="faculty"  autocomplete="off" name="faculty" type="text" value="<?php echo e($seeker_ed->faculty_name); ?>" maxlength="120" placeholder="الكلية إذا وجدت..."/>
                            <ul id="facultyResults" class="lists">

                            </ul>
                        </div>
                    </td>
                    <td>

                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="specialty">
                            التخصص

                        </label>
                    </td>
                    <td>
                        <div class="input-group">
                            <input class="form-control"  id="specialty"  autocomplete="off" name="specialty" type="text" value="<?php echo e($seeker_ed->sed_name); ?>" maxlength="120" placeholder="التخصص"/>
                            <ul id="specialtyResults" class="lists">

                            </ul>
                        </div>
                    </td>

                </tr>
                <tr>
                    <td><label for="avg_num">
                            المعدل
                        </label></td>
                    <td>

                        <input id="avg_num" class="form-control" name="avg_num" type="text" value="<?php echo e($seeker_ed->avg); ?>"
                               placeholder="المعدل"/>

                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="start_date">
                            المدة
                            <span class="req">*</span>
                        </label>
                    </td>


                    <td class="day">

                        <select id="start_date" name="start_date" class="field select medium">

                            <?php
                            $y = date("Y");
                            for ($i = $y; $i >= 1950; $i--) {
                                echo "<option ";
                                if ($i == $seeker_ed->start_date) {
                                    echo 'selected="selected"';
                                }
                                echo "value=\"$i\">$i</option>\n";
                            }
                            ?>
                        </select>
                        -
                        <select name="end_date">
                            <?php
                            $y = date("Y") + 8;
                            for ($i = $y; $i >= 1950; $i--) {
                                echo "<option ";
                                if ($i == $seeker_ed->end_date) {
                                    echo 'selected="selected"';
                                }
                                echo "value=\"$i\">$i</option>\n";
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <div class="tooltip startend_val validation">

                        </div>
                    </td>
                </tr>

            </table>
        </div>
        <div class="modal-footer">
            <input name="insert_edd" type="submit" value="حفظ" class="btn btn-info"/>
            <a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();'
               class="btn btn-default ">إلغاء</a>
        </div>


        <?php echo Form::close(); ?>


        <script type="text/javascript" src="<?php echo e(asset('js/script_ed.js')); ?>"></script>
    </div>

</div>
<script type="text/javascript">
    var id =  <?php echo $seeker_ed->ed_id; ?>;
    $('#myForm').submit(function(e){
        e.preventDefault();
        var dataObject =  $("#myForm").serialize();
        editSaveRest('education/'+id ,'#education','#education',dataObject);
    });
    $("#university").delayKeyup(function() {searchAjax("#university","univ","#univResults");},700);$("#university").blur(function(){$("#univResults").fadeOut(500);}) .focus(function() {$("#univResults").show();});
    $("#faculty").delayKeyup(function() {searchAjax("#faculty","faculty","#facultyResults");},700);$("#faculty").blur(function(){$("#facultyResults").fadeOut(500);}) .focus(function() {$("#facultyResults").show();});
    $("#specialty").delayKeyup(function() {searchAjax("#specialty","speced","#specialtyResults");},700);$("#specialty").blur(function(){$("#specialtyResults").fadeOut(500);}) .focus(function() {$("#specialtyResults").show();});
</script>
<script   type="text/javascript" src="<?php echo e(asset('js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\libyacv\resources\views/seekers/modal/edit/eed.blade.php ENDPATH**/ ?>