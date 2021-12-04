<div class="post icon-sitemap">التخصصات<span>    <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('specialtys');">+أضافة</a>
</span></div>
<div class="contpost">
   

    <?php $__currentLoopData = $seeker_spec; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="btn btn-default" style="cursor: context-menu;" > <?php echo e($row->spec_name); ?></span>

          <input type="button" class="btn btn-danger btn-sm" onclick="return  deleteItem('specialtys/<?php echo e($row->spec_seeker_id); ?>','#specialtys','#specialtys')" value="حذف" />

            <br><br>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


</div><?php /**PATH C:\laragon\www\libyacv\resources\views/seekers/modal/show/spec.blade.php ENDPATH**/ ?>