<div  class="post icon-brush">الهوايات<span><a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('hobby');">+أضافة</a>
</span></div>
<div  class="contpost">

<?php $__currentLoopData = $seeker_hobby; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <b><span> <?php echo e($row->hobby_name); ?> </span> </b>
    <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('hobby',<?php echo e($row->job_hobby_id); ?>);"> تعديل</a>
    <input type="button" class=" btn btn-danger btn-sm" onclick="return  deleteItem('hobby/<?php echo e($row->job_hobby_id); ?>','#hobby','#hobby')" value="حذف" />
    <br>
    <br>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div><?php /**PATH C:\laragon\www\libyacv\resources\views/seekers/modal/show/hobby.blade.php ENDPATH**/ ?>