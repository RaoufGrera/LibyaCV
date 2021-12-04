<div class="post icon-globe">اللغات<span>    <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('language');">+أضافة</a>
</span></div>
<div class="contpost">
  

<?php $__currentLoopData = $seeker_lang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <b><span> <?php echo e($row->lang_name); ?> </span></b><br>
        <span class="texts"> المستوي: <?php echo e($row->level_name); ?></span>
        <br>
            <a  class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('language',<?php echo e($row->job_lang_id); ?>);">
                        تعديل</a>

            <input type="button" class="btn btn-danger btn-sm" onclick="return  deleteItem('language/<?php echo e($row->job_lang_id); ?>','#language','#language')" value="حذف" />


            <br><br>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div><?php /**PATH C:\laragon\www\libyacv\resources\views/seekers/modal/show/lang.blade.php ENDPATH**/ ?>