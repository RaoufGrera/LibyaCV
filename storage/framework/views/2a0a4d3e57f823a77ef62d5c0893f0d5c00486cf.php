<?php $dataLoad = app('App\Helpers\CompanyConstant'); ?>
<?php  $notes = $dataLoad->getNote();?>

<?php $__env->startSection('title',trans("page.policy")); ?>
<?php $__env->startSection('keywords',trans("desc.keywords")); ?>
<?php $__env->startSection('image',asset('images/logo/logofb.jpg')); ?>
<?php $__env->startSection('url',trans('desc.url')); ?>
<?php $__env->startSection('description',trans('desc.description')); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">
        <div class="row">
             <div class="col-md-12 ">
                <br>
                <h5 class="title-page"> لايوجد أتصال  </h5>
                <br>

                 <br>

                 <p>
                     ساسية الخصوصية
                 </p> <p>



                 </p>



             </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\libyacv\resources\views/main/policy.blade.php ENDPATH**/ ?>