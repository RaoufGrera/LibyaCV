<div class="contpost">
    <img class="imgseeker"
         src= <?php if($job_seeker->image !=""): ?><?php echo e(asset('images/seeker/300px_'.$job_seeker->code_image .'_'. $job_seeker->image)); ?> <?php else: ?> <?php if($job_seeker->gender =='m'): ?> <?php echo e(asset('images/simple/male.png')); ?> <?php else: ?> <?php echo e(asset('images/simple/female.png')); ?>  <?php endif; ?> <?php endif; ?> />
    <br>
    <br>
</div>
<?php /**PATH C:\laragon\www\libyacv\resources\views/seekers/modal/show/image.blade.php ENDPATH**/ ?>