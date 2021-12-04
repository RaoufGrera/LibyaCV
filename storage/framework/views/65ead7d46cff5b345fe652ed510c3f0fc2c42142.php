
<?php
/**
 * Created by PhpStorm.
 * User: Lenovo1
 * Date: 6/25/2016
 * Time: 6:01 AM
 */?>
<div class="post icon-info">معلومات أضافية<span>    <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('info');">+أضافة</a>
</span></div>
<div class="contpost">

    <?php $__currentLoopData = $seeker_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <b><span> <?php echo e($row->info_name); ?> </span></b><br>
       <?php if($row->info_text != ""): ?>
        <p style="
            padding-right: 6px;
    margin-top: 6px;
    background-color: #fbfbfb;
    border-right: 3px solid #d1d1d1;
    color: #585858;
    line-height: 2.6;
        ">
            <?php echo nl2br(e($row->info_text)); ?>

        </p>
     <?php endif; ?>
        <span class="texts"> سنة: <?php echo e($row->info_date); ?></span>
        <br>
        <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('info',<?php echo e($row->info_id); ?>);">  تعديل</a>

         <input type="button" class="btn btn-danger btn-sm" onclick="return  deleteItem('info/<?php echo e($row->info_id); ?>','#info','#info')" value="حذف" />

        <br><br>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
<?php /**PATH C:\laragon\www\libyacv\resources\views/seekers/modal/show/info.blade.php ENDPATH**/ ?>