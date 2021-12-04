<div class="post icon-tasks">المهارات<span>    <a  class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('skills');">+أضافة</a>
</span></div>
<div class="contpost">
   

    <?php $__currentLoopData = $seeker_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <b><span> <?php echo e($row->skills_name); ?> </span></b><br>
        <span class="texts"> المستوي: <?php echo e($row->level_name); ?></span>
        <br>

        <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('skills',<?php echo e($row->skills_id); ?>);">  تعديل</a>

      <input type="button" class="btn btn-danger btn-sm" onclick="return  deleteItem('skills/<?php echo e($row->skills_id); ?>','#skills','#skills')" value="حذف" />
            <br><br>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div><?php /**PATH C:\laragon\www\libyacv\resources\views/seekers/modal/show/skills.blade.php ENDPATH**/ ?>