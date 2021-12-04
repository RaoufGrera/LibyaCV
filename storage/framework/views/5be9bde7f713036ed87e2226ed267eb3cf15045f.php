<div  class="post icon-newspaper">الشهادات<span>    <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('certificate');">+أضافة</a>
</span> &nbsp;</div>
<div class="contpost">
   

    <?php $__currentLoopData = $seeker_cert; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <b><span> <?php echo e($row->cert_name); ?> </span></b><br>
        <span class="texts"> سنة: <?php echo e($row->cert_date); ?></span>
        <br>

        <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('certificate',<?php echo e($row->certificate_id); ?>);">  تعديل</a>

        <input type="button" class="btn btn-danger btn-sm" onclick="return  deleteItem('certificate/<?php echo e($row->certificate_id); ?>','#certificate','#certificate')" value="حذف" />


        <br><br>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
<?php /**PATH C:\laragon\www\libyacv\resources\views/seekers/modal/show/cert.blade.php ENDPATH**/ ?>