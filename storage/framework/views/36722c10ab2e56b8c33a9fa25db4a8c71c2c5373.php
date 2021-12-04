<?php
/**
 * Created by PhpStorm.
 * User: Lenovo1
 * Date: 6/22/2016
 * Time: 5:20 AM
 */
?>

<div  class="post icon-graduation-cap"> المؤهل العلمي <span>    <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('education');">+أضافة</a>
</span></div>
<div   class="contpost" style="display: block">

    <?php if(session('errorEducation')): ?>
        <div class="alert alert-warning">
            <a href="javascript:void(0);" class="close"  data-dismiss="alert"    aria-label="close">&times;</a>

            <strong>تنبيه!</strong> خطاء في الإدخال
        </div>
    <?php endif; ?>

    

    <?php $__currentLoopData = $seeker_ed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <b><span><?php echo e($row->univ_name); ?> <?php echo e($row->faculty_name); ?> </span></b>
        <br>
        <span class='texts '><?php echo e($row->edt_name); ?>

            <?php if(!empty($row->sed_name)): ?>، <?php echo e($row->sed_name); ?><?php endif; ?>
            <?php if(!empty($row->avg)): ?>، <?php echo e($row->avg); ?><?php endif; ?>
            <br>
            <?php echo e($row->start_date); ?> - <?php echo e($row->end_date); ?>


            <br>المجال
            <?php echo e($row->domain_name); ?></span>
            <br>
         <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('education','<?php echo e($row->ed_id); ?>');" >  تعديل</a>
           <input type="button" class=" btn btn-danger btn-sm" onclick="return  deleteItem('education/<?php echo e($row->ed_id); ?>','#education','#education')" value="حذف" />

        <br><br>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


</div>
<?php /**PATH C:\laragon\www\libyacv\resources\views/seekers/modal/show/ed.blade.php ENDPATH**/ ?>