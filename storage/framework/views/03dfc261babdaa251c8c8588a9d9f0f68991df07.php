<?php $company = app('App\Helpers\CompanyConstant'); ?>
<?php
 $notes = $company->getNote();
?>

<?php $__env->startSection('title',trans("page.profile")); ?>

<?php $__env->startSection('content'); ?>
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
    <div class="container">
        <div class="row">
            <?php echo $__env->make('layouts.seeker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="col-md-9 ">


                <h5 class="title-page"> السيرة الذاتية</h5>

                <div class="cont contpost">
                    <?php if(session('error')): ?>
                        <div class="alert alert-warning">
                            <a href="javascript:void(0);" class="close"  data-dismiss="alert"    aria-label="close">&times;</a>

                            <strong>تنبيه!</strong> <?php echo e(session('error')); ?>

                        </div>
                    <?php endif; ?>
                        <?php if(session('ok')): ?>
                            <div  class="alert alert-success">
                                <a href="javascript:void(0);" class="close" data-dismiss="alert"
                                   aria-label="close">&times;</a>

                                <strong>تنبيه!</strong> <?php echo e(session('ok')); ?>

                            </div>
                        <?php endif; ?>


                         <hr>

                     <div class="list">
                        <img id="loading" src="<?php echo e(asset('images/loading.gif')); ?>" style="display: none" />
<div class="div-imgseeker">
    <div id="image">
    <?php echo $__env->make('seekers.modal.show.image', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

                        <a class="btn btn-default btn-sm" onclick="ShowEditModal('image');" > تعديل</a>

                          <input type="button" class="btn btn-danger btn-sm" onclick="return  deleteItem('image','#image','#image')" value="حذف" />

    <br>

</div>
                        <div id="personal-information">

                     <?php echo $__env->make('seekers.modal.show.infoseeker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    </div>
                    </div>


                    <div>




                        <div id="golas" class="post icon-award"> الهدف الوظيفي<span><a class="btn btn-default btn-sm" onclick="ShowEditModal('edit-goal');" >  تعديــل</a>
</span></div>
<div id="goal" class="contpost">
<?php echo $__env->make('seekers.modal.show.goal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<div id="education">
<?php echo $__env->make('seekers.modal.show.ed', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<div id="experience">

<?php echo $__env->make('seekers.modal.show.exp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<div id="language">
<?php echo $__env->make('seekers.modal.show.lang', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<div id="specialtys">
<?php echo $__env->make('seekers.modal.show.spec', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<div id="skills">
<?php echo $__env->make('seekers.modal.show.skills', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<div id="certificate">
    <?php echo $__env->make('seekers.modal.show.cert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<div id="training">
    <?php echo $__env->make('seekers.modal.show.train', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<div id="hobby">
<?php echo $__env->make('seekers.modal.show.hobby', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<div id="info">
   <?php echo $__env->make('seekers.modal.show.info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
                        <div id="contact">
                            <?php echo $__env->make('seekers.modal.show.contact', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                </div>
                    </div>
            </div>
        </div>
        <nav id="bottom" class="bottom t">
            <span class="clicker   icon-up-open"></span>

        </nav>
    </div>
    </div>

    <script language="javascript">
        function deleteItem(a,b,c) {
            if (confirm("هل أنت متأكد من الحذف؟")) {
                var token = '<?php echo e(Session::token()); ?>';
                var data = {
                    '_token' : token,
                    '_method' : 'delete',
                };
                deleteRest(a,b,c,data);
                return true;
            } else {
                return false;
            }
        }

    </script>

<?php $__env->stopSection(); ?>





<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\libyacv\resources\views/seekers/profile.blade.php ENDPATH**/ ?>