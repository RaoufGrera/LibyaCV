<div class="post icon-briefcase">الخبرة      <i style="font-size:80%;"><?php echo '' . floor(session('exp_sum')/12) . ' سنة و' .session('exp_sum')%12 . ' شهر.';?></i><span>    <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('experience');">+أضافة</a>
</span></div>
<div class="contpost">
  

    <?php $__currentLoopData = $seeker_exp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <b><span><?php echo e($row->exp_name); ?></span></b>
        <br>
        <span class='texts '>في <?php echo e($row->compe_name); ?>

            <br>
            <?php echo e(date('Y-m',strtotime($row->start_date))); ?> -
            <?php if($row->state ==0): ?>
                <?php echo e(date('Y-m',strtotime($row->end_date))); ?>

            <?php else: ?>
                الي حد الأن
            <?php endif; ?>
            <br>
                                 مجال الشركة <?php echo e($row->domain_name); ?>

            <br>
            <?php echo nl2br(e($row->exp_desc)); ?>

                            </span>
            <br>
            <a  class="btn btn-default  btn-sm" onclick="ShowEditModalRESTful('experience',<?php echo e($row->exp_id); ?>);" >  تعديل</a>

            <input type="button" class=" btn btn-danger  btn-sm" onclick="return  deleteItem('experience/<?php echo e($row->exp_id); ?>','#experience','#experience')" value="حذف" />


            <br><br>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div><?php /**PATH C:\laragon\www\libyacv\resources\views/seekers/modal/show/exp.blade.php ENDPATH**/ ?>