<div class="post icon-vcard"> التدريب والدورات<span>    <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('training');">+أضافة</a>
</span></div>
<div class="contpost">


    <?php $__currentLoopData = $seeker_train; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <b><span> <?php echo e($row->train_name); ?> </span></b><br>
        <span class="texts"> الجهة: <?php echo e($row->train_comp); ?></span><br>
        <span class="texts"> سنة: <?php echo e($row->train_date); ?></span>
        <br>

        <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('training',<?php echo e($row->train_id); ?>);">  تعديل</a>

        <input type="button" class="btn btn-danger btn-sm" onclick="return  deleteItem('training/<?php echo e($row->train_id); ?>','#training','#training')" value="حذف" />


        <br><br>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
<?php /**PATH C:\laragon\www\libyacv\resources\views/seekers/modal/show/train.blade.php ENDPATH**/ ?>