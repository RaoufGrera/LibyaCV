<div class="col-md-3">

    <ul class="nav nav-list">




      <!--  <li><a class="btn btn-default btn-block icon-download-alt" href="/profile/download">تحميل السيرة الذاتية</a> </li>-->
        <?php if(basename($_SERVER['REQUEST_URI']) == 'profile'): ?>
       <!-- <li><span><a  href="/profile/download"  class="btn btn-danger btn-block icon-download-alt"  >تحميل السيرة الذاتية   <img src="<?php echo e(asset('images/home/printer.png')); ?>" /></a> </span></li> -->
        <?php endif; ?>

        <br>
        <li><a href="/profile/dashboard"><img src="<?php echo e(Asset('images/home/home30.png')); ?>"> <?php echo e(trans("page.dashboard")); ?></a></li>

        <!--<li><a href="/dashboard" class="icon-connectdevelop">لوحة الأعدادات</a></li>-->
        <li><a href="/profile" ><img src="<?php echo e(Asset('images/home/cv30.png')); ?>"> <?php echo e(trans("page.profile")); ?></a></li>
       
        <?php if(basename($_SERVER['REQUEST_URI']) == 'profile'): ?>
       <!-- <ul class="listcv"><li><a href="#contact" class="icon-share">معلومات الأتصال</a></li><li><a href="#golas" class="icon-award">الهدف الوظيفي</a></li><li><a href="#education" class="icon-graduation-cap">المؤهل العلمي</a></li><li><a href="#experience" class="icon-briefcase">الخبرة</a></li><li><a href="#language" class="icon-globe">اللغات</a></li><li><a href="#specialtys" class="icon-sitemap">التخصصات</a></li><li><a href="#skills" class="icon-tasks">المهارات</a></li><li><a href="#certificate" class="icon-newspaper">الشهادات</a></li><li><a href="#training" class="icon-vcard">التدريب والدورات</a></li><li><a href="#hobby" class="icon-brush">الهوايات</a></li> <li><a href="#info" class="icon-info">معلومات إضافية</a></li></ul>-->
        <?php endif; ?>




 <?php if(session('user_name_company') != "" ): ?>

     <li><a href="/company-profile/<?php echo e(session('user_name_company')); ?>/" ><img src="<?php echo e(Asset('images/home/mycomp.png')); ?>"> الشركة ( <?php echo e(session('user_name_company')); ?> )</a></li>
     <li  ><a href="/company-profile/<?php echo e(session('user_name_company')); ?>/job/create" ><img src="<?php echo e(Asset('images/home/addjobs.png')); ?>"> أعلن عن وظيفة </a></li>

     <li><a href="/company-profile/<?php echo e(session('user_name_company')); ?>/job/" ><img src="<?php echo e(Asset('images/home/list.png')); ?>"> إدارة الوظائف </a></li>
     <br>
     <?php else: ?>
     <li>
         <a class="icon-building" href="/create-company">إضافة شركة</a>
     </li>
 <?php endif; ?>





</ul>
<style>
 .nav-list{
     padding: 20px 12px 0 0 ;
 }
 .nav-list > li {
     border-bottom: 1px solid #eee;
 }
  li img{
     width: 26px;
     margin-left: 10px;
 }
</style>

</div><?php /**PATH C:\laragon\www\libyacv\resources\views/layouts/seeker.blade.php ENDPATH**/ ?>