<table style="float: right">
    <tr>

        <td colspan="2">
            <span><a id="cvname" href="/user/<?php echo e($job_seeker->user_name); ?>"><?php echo e($job_seeker->fname); ?> <?php echo e($job_seeker->lname); ?>  </a></span><br>

            <span class="texts"><?php echo e($job_seeker->about); ?></span>
        </td>
    </tr>

    <tr>
        <td>
 <span class="icon-location"> <?php echo e($job_seeker->city_name); ?>

     <?php if($job_seeker->address != ""): ?>
         - <?php echo e($job_seeker->address); ?>

     <?php endif; ?>
                        </span>
        </td>
    </tr>
    <tr>

        <td>
            <span class="icon-calendar"><?php $datereg = date("Y");
                $age = $datereg - date("Y",strtotime($job_seeker->birth_day));
                echo $age . " سنة"; ?></span>
        </td>
    </tr>
    <tr>

        <td>
            <span class="icon-mail"> <?php echo e($job_seeker->email); ?></span>
        </td>
    </tr>
    <tr>

        <td>
            <span class=" icon-mobile"><?php echo e($job_seeker->phone); ?></span>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <br>

            <a  class="btn btn-default btn-sm" onclick="ShowEditModal('edit-info');" >  تعديل</a>
            <a  href="/profile/download"  class="btn btn-default btn-sm"  >تحميل السيرة الذاتية   <img width="18" src="<?php echo e(asset('images/home/printer30.png')); ?>" /></a>

            <a style="margin-left: 20px;" class="btn btn-danger btn-sm  icon-retweet"  onclick="ShowEditModal('update-cv');"   >تحديث السيرة الذاتية في نتائج البحث</a>
            <br>
        </td>
    </tr>
</table><?php /**PATH C:\laragon\www\libyacv\resources\views/seekers/modal/show/infoseeker.blade.php ENDPATH**/ ?>