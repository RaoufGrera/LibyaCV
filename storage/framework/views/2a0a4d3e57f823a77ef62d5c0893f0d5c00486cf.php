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
                <h5 class="title-page"> سياسة الخصوصية </h5>
              
                   
                    البيانات الموجودة داخل النظام
يمكن للزوار الاطلاع علي جميع الوظائف الشاغرة والسير الذاتية التي تم الموافقة علي ظهورها من قبل المستخدم لعامة الزوار
                   <li>يمكن للمستخدم التحكم في ظهور سيرته الذاتية واخفائها من نتائج البحث ومن العرض داخل النظام</li>
           



                 </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\libyacv\resources\views/main/policy.blade.php ENDPATH**/ ?>