<?php $dataLoad = app('App\Helpers\CompanyConstant'); ?>
<?php  $notes = $dataLoad->getNote();?>

<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title', trans("page.dashboard")); ?>

<script type="application/javascript">
    function Toggle(item) {
        objReq = document.getElementById(item);
        visible = (objReq.style.display != "none")
        if (visible) {
            objReq.style.display = "none";
        } else {
            objReq.style.display = "block";
        }
    }
    
</script>
<style>
    .btn-default{color:#e7e7e7;background-color:#fff;border-color:#e5e5e5;box-shadow: 1px 1px;}
    .btn-default span{color:#333;}
</style>
<div class="container">
    <div class="row">
        <?php echo $__env->make('layouts.seeker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="col-md-9 ">
            <br>
            <h5 class="title-page"> الملف الشخصي</h5>
            <br>

            <div class="col-md-12">





                <div class="col-md-3 m10"><a class="btn btn-block btn-default" href="/profile">
                        <img style=" padding: 10px;" src="<?php echo e(Asset('images/home/cv30.png')); ?>">
                        <br><span><?php echo e(trans('page.cv')); ?></span></a>
                </div>
                
                <?php if(session('user_name_company') == "" ): ?>
                <div class="col-md-3 m10"><a class="btn btn-block btn-default" href="/create-company">
                        <img style=" padding: 10px;" src="<?php echo e(Asset('images/home/newcomp.png')); ?>">
                        <br><span><?php echo e(trans('page.add-company')); ?></span></a>
                </div>
                    <?php else: ?>      <div class="col-md-3 m10"><a class="btn btn-block btn-default" href="/company-profile/<?php echo e(session('user_name_company')); ?>">
                        <img style=" padding: 10px;" src="<?php echo e(Asset('images/home/mycomp.png')); ?>">
                        <br><span><?php echo e(trans('page.company-profile')); ?></span></a>
                </div>
                <div class="col-md-3 m10"><a class="btn btn-block btn-default" href="/company-profile/<?php echo e(session('user_name_company')); ?>/job/create">
                        <img style=" padding: 10px;" src="<?php echo e(Asset('images/home/addjobs.png')); ?>">
                        <br><span><?php echo e(trans('page.Add-job')); ?></span></a>
                </div>
                <div class="col-md-3 m10"><a class="btn btn-block btn-default" href="/company-profile/<?php echo e(session('user_name_company')); ?>/job">
                        <img style=" padding: 10px;" src="<?php echo e(Asset('images/home/list.png')); ?>">
                        <br><span><?php echo e(trans('page.my-job')); ?></span></a>
                </div>
                    <?php endif; ?>

            </div>

            <br>

           
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <ins class="adsbygoogle"
                 style="display:block; text-align:center;"
                 data-ad-layout="in-article"
                 data-ad-format="fluid"
                 data-ad-client="ca-pub-9929016091047307"
                 data-ad-slot="4652769808"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>
    <br>
    <br>
    <br>
</div>

<script language="javascript">
    function deleteItem() {
        if (confirm("هل أنت متأكد من الحذف؟")) {
            return true;
        } else {
            return false;
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\libyacv\resources\views/seekers/dashboard.blade.php ENDPATH**/ ?>