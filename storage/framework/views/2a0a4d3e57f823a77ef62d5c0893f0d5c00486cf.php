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
           
                   <h5 class="title-page"> التسجيل باستخدام الفيسبوك </h5>
                   <li>سنقوم بجمع البيانات التالية:
                   </li>
                    <ul>
                      
                <li>الأسم : name</li>
                <li> البريد الألكتروني : email </li>
             
        </ul>
        <li>
            .نقوم بإضافة "بريدك الالكتروني" و"اسمك علي الفيسبوك" الي الحساب الشخصي الخاص بك في التطبيق والسيرة الذاتية 
          </li>
                   <li> بإمكانك حذف هذه البيانات، وكل البيانات التي تدخلها للنظام بنفسك من خلال 
                       خدمة حذف الحساب نهائياً من التطبيق</li>


                   <h5 class="title-page"> حذف الحساب نهائيا من النظام </h5>

                   <li>عند تسجيل الدخول من القائمة المنسدلة لأيقونة الحساب علي يمين التطبيق تختار اعدادات</li>
                   <li>سيتم فتح شاشة الاعدادات وبإمكانك الضغظ علي زر حذف الحساب لحذف كل البيانات الفيسبوك التي تم جمعها وهي الأسم والبريد الألكتروني كذلك سيتم حذف كل البيانات التي ادخلتها لسيرتك الذاتية وحذف حسابك بالكامل من التطبيق </li>
                 
   


                 </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\libyacv\resources\views/main/policy.blade.php ENDPATH**/ ?>