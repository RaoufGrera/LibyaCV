<?php $notes=null ?>
<?php if( Auth::guard('users')->check()): ?>
<?php $company = app('App\Helpers\CompanyConstant'); ?>
<?php
$notes = $company->getNote();
?>
<?php endif; ?>

<?php $__env->startSection('title',trans("page.welcome")); ?>
<?php $__env->startSection('keywords',trans("desc.keywords")); ?>
<?php $__env->startSection('image',asset('images/logo/logofb.jpg')); ?>
<?php $__env->startSection('url',trans('desc.url')); ?>
<?php $__env->startSection('description',trans('desc.description')); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 testimonials">

                <div class="col-md-6 <?php if( Auth::guard('users')->check()): ?> cc <?php endif; ?>" >
                <img class="c"  src="<?php echo e(asset('images/simple/newlogo1.png')); ?>" /><br>
                <span class="center sw"  >[ ليبيـا <span class="g">سـ فِ</span> ] <span itemprop="name">Libya cv</span></span>

                <h1 class="center" style="font-size: 32px;    color: #222222; ">بوابة ليبيا، للتوظيف الإلكتروني</h1>
                    <p  class="pw"><span itemprop="description">موقـع للتوظيـف الإلكتروني، يسمح للباحثين عن عمل من إنشـاء سيرهم الذاتيـة والتقدم لأي وظيفة شاغـرة معـروضة داخل النظام. كما يوفر الموقع لأصحاب العمل من عرض وظائفهم الشاغرة والحصول والتحكم في طلبات التوظيف.</span></p>

                    <a style="display: block;text-align: center;" href='https://play.google.com/store/apps/details?id=libyacvpro.libya_cv&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'><img width="220px" alt='Get it on Google Play' src='https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png'/></a>
                 </div>
                <?php if( !Auth::guard('users')->check()): ?>
                <div class="col-md-6">

                <div class="centers">
<style>
    .centers-body{
        padding: 10px;
    }
    .centers{
        margin-top: 10px;
        max-width: 390px;
    }
    .form-control1 {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 6px;
        font-size: 95%;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #dfdfdf;
        border-radius: 2px;}
</style>


                    <div class="centers-body">
                        <form method="POST" id="myForm122" action="/register/main"  accept-charset="UTF-8" class="form-style-2">
                            <?php echo e(csrf_field()); ?>


                            <div>

                                <table class="login-table" style="
    width: 100%;
">
                                    <tbody>
                                    <tr>

                                        <td style="
    width: 100%;
    text-align: center;
"><input type="text" id="fname" class="form-control1" autocomplete="off" name="fname" placeholder="الاسم" style="
    /* height: 40px; */
    margin-bottom: 5px;
    display: inline-block;
    width: 49%;
" /> <input id="lname" type="text" class="form-control1" name="lname" placeholder="اللقب" style="
    width: 49%;
    /* height: 36px; */
    display: inline-block;
    margin-bottom: 5px;
"/> </td>

                                    </tr>

                                    <tr>

                                        <td><input type="email"  autocomplete="off" class="form-control1" id="email" name="email" placeholder="البريد الإلكتروني" style="
    /* height: 40px; */
    margin-bottom: 5px;
    width: 100%;
"> </td>

                                    </tr>

                                    <tr>

                                        <td><input type="password" autocomplete="off" id="password" placeholder="الرقم السري" class="form-control1" name="password" style="
    /* height: 40px; */
    margin-bottom: 5px;
"></td>
                                    </tr>
                                    <tr>

                                    </tr>
                                    <tr>

                                        <td>   <input type="submit" value="إنشاء حساب" class="btn btn-block btn-success"/>
                                            <p style="margin-top: 4px;"> إذا لديك حساب اضغظ <a href="/login">دخول</a>  او <a href="/password/email">استعادة كلمة السر</a></p>
                                            <a href="/login/facebook" class="btn btn-face font-md btn-block icon-facebook-official"  >تسجيل عن طريق الفيسبوك</a>
                                            <a href="/login/google" class="btn   btn-block font-md  btn-danger icon-gplus-squared" >تسجيل عن طريق الجوجل</a>
                                        </td>

                                    </tr>


                                    </tbody>
                                </table>
                            </div>

                        </form>

                    </div>
                </div>

                </div>

<?php endif; ?>
            </div>
            </div>
            </div>

            <style>
                .v{
                    margin: 15px 0;
                    padding: 0;
                    border: 0 solid #C2C2C1;
                    border-radius: .25rem;
                    box-shadow: 0 1px 3px 0 #D4D4D5, 0 0 0 1px #D4D4D5;
                }
                .v > a {
                    font-size: 90%;
                }
                .v >  span {
                    color: #808080;
                    display: block;
                    font-size: 90%;
                }
                .v img{
                    width:100%;
                }

            </style>
            <div class="container">


                <div class="row">
                    <div class="col-lg-12 cs" style="
    padding: 50px 15px 50px 15px;
    background: #d94040;
    /* background: url('/images/new/cubes.png') left center repeat; */
    margin-top: 0;
    border-top: 0;
    background-color: #ffffff;
    ">


                        <div class="centers">
                            <style>

                                .ody{
                                    padding-bottom: 7px;
                                    background: #f3f3f3;
                                }
                                .ody span{
                                    font-size: 110%;
                                    padding: 4px 0;
                                    display: block;
                                    text-align: center;
                                }
                                .centers{
                                    max-width: 450px;
                                    border: 1px solid #c2c2c2;
                                }
                                .form-control1 {
                                    display: block;
                                    width: 100%;
                                    height: 34px;
                                    padding: 6px 6px;
                                    font-size: 95%;
                                    line-height: 1.42857143;
                                    color: #555;
                                    background-color: #fff;
                                    background-image: none;
                                    border: 1px solid #dfdfdf;
                                    border-radius: 2px;}
                                .pp{
                                    margin-bottom: 7px;
                                    border-bottom: 1px solid #d4d4d4;
                                    width: 100%;
                                }
                                .co{
                                    padding-top: 12px;
                                    font-size: 18px;
                                    background-color: #fdfdfd;
                                    border-bottom: 1px solid #ddd;
                                }
                                h2{
                                    font-size: 20px;
                                }
                                .co  .col-md-3:last-child {
                                    border-left: 0;
                                }
                                .co  .col-md-3 {
                                    border-left: 1px solid #dadada;
                                }
                            </style>


                            <div class="ody">
                                <img class="pp" src="http://libyacv.local:8081/images/simple/print.png">
                                <span>مثال على شكل السيرة الذاتية</span>

                            </div>
                        </div>

                    </div>
                    <br>
                    <h3 class="center">المدن</h3>




                    <div  class="col-md-12   center oo sdh cont">

                          <?php echo html_entity_decode($dataCity); ?>




                    </div>



                    <div class="col-md-12 center oo sdh cont"><hr><h3 class="center">المجالات</h3></div>




                    <div  class="col-md-12 center oo sdh cont">

                        <?php echo $dataDomain ;?>


                    </div>
                </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                    <div class="col-lg-12 cs" >
                        <h3 class="center">خدماتنا</h3><span class="shr"></span>
                        <br>
                        <div class="row">

                            <div class="col-lg-12 center sdh">

                                <div class="col-lg-3">
                                    <div  class="sdh">
                                        <img src="<?php echo e(asset('images/home/jobs.png')); ?>" /><br></div>
                                    <h2>أنشر وظيفتك الشاغرة</h2><span class="shr"></span>
                                    <p>نمتلك قالب مميز وبسيط لكتابة الوظيفة الشاغرة، تستطيع من خلاله من نشر وظيفتك الشاغرة لكل زوار الموقع وتطبيق الاندرويد.</p>
                                </div>


                                <div class="col-lg-3">
                                    <div  class="sdh">
                                        <img src="<?php echo e(asset('images/home/application.png')); ?>" /><br>
                                    </div>
                                    <h2>تقدم  لوظيفتك الأن </h2><span class="shr"></span>
                                    <p>مايفصلك عن التقدم لأي وظيفة ضغظة زر فقط، بإمكانك التقدم لأي وظيفة ترغب بها من اي مكان من خلال الموقع او تطبيق الاندرويد.</p>
                                </div>

                                <div class="col-lg-3">
                                    <div class="sdh">
                                        <img src="<?php echo e(asset('images/home/cv_8.png')); ?>" /><br>
                                    </div>
                                    <h2>قم ببناء سيرتك المميزه </h2><span class="shr"></span>
                                    <p>يوفر لك النظـام قالب مميز ومتكامل وسهل الأستخـذام، وذلك لبنـاء سيرتك الذاتيـة مع تقديـم نصائح وتوجيهات وارشـادات في كيفية كتابتها.</p>
                                </div>

                                <div class="col-lg-3">
                                    <div class="sdh">
                                        <img src="<?php echo e(asset('images/home/printer.png')); ?>" /><br>
                                    </div>
                                    <h2>احتفظ بسيرتك الذاتية</h2><span class="shr"></span>
                                    <p>بإمكانك الحصول علي نسخة من سيرتك الذاتية بصيغة PDF سواء من خلال الموقع او تطبيق الاندرويد وذلك حتي تتمكن من ارسالها او طباعتها.</p>
                                </div>

                            </div>
                </div>
                </div>

                        <div class="col-lg-12 cs" style="    padding: 60px 15px 0 15px;
    background: #d94040;
    background: url('/images/new/cubes.png') left center repeat;
    margin-top: 0;
    border-top: 0;
    background-color: #fafafa;" >
                            <div  class="col-lg-8" style="    padding: 20px 5px;">
                                <h1 style="font-size: 34px">تطبيق ليبيا سـ فِ</h1><br><p style="font-size: 110%;">أحصل علي تطبيق [ ليبيا سي في ] من متجر قوقل للتطبيقات لتتمكن من الحصول علي خدمات التالية:- </p>
                                <ul>
                                    <li> إنشاء السيرة الذاتية من خلال تطبيق الاندرويد وامكانية طباعة السيرة بتصميم افضل.</li>
                                    <li> البحث عن كل الوظائف الشاغرة، في ليبيا.</li>
                                    <li> الحصول علي تنبيهات فورية علي جهازك عند وجود وظيفة شاغرة لشركة تتابعها.</li>
                                    <li> البحث عن الشركات ومعرفة خدماتها ومعلومات التواصل معها.</li>
                                    <li> إنشاء شركة وإضافة اعلانات توظيف والتحكم في طلبات التوظيف بكل سهولة.</li>
                                    <li> والكثير من الخدمات الاخري.</li>
                                </ul>

                                <a style="display: block;text-align: center;" href='https://play.google.com/store/apps/details?id=libyacvpro.libya_cv&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'><img width="220px" alt='Get it on Google Play' src='https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png'/></a>

                            </div>
                                <div style="padding: 0 8px;
    height: 420px;
    /* text-align: center; */
    margin: 0 auto;" class="col-lg-4">
                                <img width="380" style="    bottom: 0px;
    width: 310px;
    position: absolute;
  " src="<?php echo e(asset('images/libyacvapp5.png')); ?>" style="bottom: 0;position: absolute;" />
                                </div>


                        </div>
                        <div class="col-lg-12 cs" style="
    padding: 50px 15px 50px 15px;
    background: #d94040;
    /* background: url('/images/new/cubes.png') left center repeat; */
    margin-top: 0;
    border-top: 0;
    background-color: #ffffff;
    ">


                            <div class="centers">
                                <style>

                                    .ody{
                                        padding-bottom: 7px;
                                        background: #f3f3f3;
                                    }
                                    .ody span{
                                        font-size: 110%;
                                        padding: 4px 0;
                                        display: block;
                                        text-align: center;
                                    }
                                    .centers{
                                        max-width: 450px;
                                        border: 1px solid #c2c2c2;
                                    }

                                    .co  .col-md-3:last-child {
                                        border-left: 0;
                                    }
                                    .co  .col-md-3 {
                                        border-left: 1px solid #dadada;
                                    }
                                </style>


                                <div class="ody">
                                    <img class="pp" src="http://libyacv.local:8081/images/simple/print.png">
                                    <span>مثال على شكل السيرة الذاتية</span>

                                </div>
                            </div>

                        </div>
                    </div>


     </div>
    <script type="text/javascript">

        function ToggleShow(item){

            objItem = document.getElementById(item);
            $('#'+item).slideToggle('slow');

        }





    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\libyacv\resources\views/welcome2018.blade.php ENDPATH**/ ?>