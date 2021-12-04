<?php $dataLoad = app('App\Helpers\CompanyConstant'); ?>
<?php  $notes = $dataLoad->getNote();?>

<?php $__env->startSection('title',trans("page.terms")); ?>
<?php $__env->startSection('keywords',trans("desc.keywords")); ?>
<?php $__env->startSection('image',asset('images/logo/logofb.jpg')); ?>
<?php $__env->startSection('url',trans('desc.url')); ?>
<?php $__env->startSection('description',trans('desc.description')); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">
        <div class="row">
             <div class="col-md-12 ">
                <br>
                <h5 class="title-page"> الشروط والأحكام </h5>
                <br>

          
                  <li>يحظر استخدام التطبيق بغرض الإساءة أو التشهير ضد أي شخص أو أي جهة </li>  
                  <li>   يحظر استخدام التطبيق لانتحال شخصية فرد أو جهة او مؤسسة. يرجى في حالة عدم موافقتك على أي من حالات وشروط هذه الوثيقة، عدم استخدام هذا التطبيق.
                </li>
                <li>
                    وفي كل الأحوال لا يتحمل الموقع أية مسئولية قانونية نتيجة للاستخدام السئ او الاستغلال الغير مشروع للتطبيق إخلاء المسؤولية عن الضمانات                

                </li>

                <h5 class="title-page"> حذف الحساب نهائيا من النظام </h5>

                <li>من القائمة المنسدلة للأيقونة الحساب علي يمين التطبيق تختار اعدادات</li>
                <li>سيتم فتح شاشة الاعدادات وبإمكانك الضغظ علي زر حذف الحساب لحذف كل البيانات التي ادخلتها وحذف حسابك بالكامل من التطبيق </li>
                                     



            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\libyacv\resources\views/main/terms.blade.php ENDPATH**/ ?>