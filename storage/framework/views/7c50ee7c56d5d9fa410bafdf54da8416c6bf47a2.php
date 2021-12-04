<?php $dataLoad = app('App\Helpers\CompanyConstant'); ?>
<?php  $notes = $dataLoad->getNote();?>

<?php $__env->startSection('title',"دعم المشروع"); ?>
<?php $__env->startSection('keywords',trans("desc.keywords")); ?>
<?php $__env->startSection('image',asset('images/logo/logofb.jpg')); ?>
<?php $__env->startSection('url',trans('desc.url')); ?>
<?php $__env->startSection('description',trans('desc.description')); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">
        <div class="row">
             <div class="col-md-12 ">
                <br>
                <h5 class="title-page"> لدعم المشروع  </h5>
                كل الدعم سيتم استثماره في
                <li>تحسين الخدمات</li>
                <li>توظيف اشخاص لنشر الوظائف الشاغرة</li>
                <li>دفع تكاليف الاستضافة الشهرية</li>
                <li>تطوير مشروع مشابه خاص بالشباب</li>

                <br>

                     USDT - network is Tron (TRC20)
                     <br>
                     <code style="    border: 2px solid #476e49;
                     background: #e8f5e9;
                     border-radius: 8px;
                     padding: 6px 10px;">TGkYiPxHJVRAPPGiHcCioYBqt4PJaQkK6J</code>
<br>
<br>
<h5 class="title-page"> لدفع تكاليف الاستضافة بشكل مباشر من خلال الحساب</h5>

<h4><a href="https://my.vultr.com/"> Vultr Hosting</a></h4>
           <span>User name <code style="background: #e3f2fd;
            border-radius: 8px;
            padding: 3px 7px;">it1992t@gmail.com</code>
           <br>
           <span>Password <code style="background: #e3f2fd;
            border-radius: 8px;
            padding: 3px 7px;">d8ZjSZ872VCEk!y</code></span>



             </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\libyacv\resources\views/main/donate.blade.php ENDPATH**/ ?>