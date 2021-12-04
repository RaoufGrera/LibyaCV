<?php $notes=null ?>

<?php $company = app('App\Helpers\CompanyConstant'); ?>
<?php
$notes = $company->getNote();
?>

 <?php $__env->startSection('title',trans("page.login")); ?>
<?php $__env->startSection('keywords',trans("desc.keywords")); ?>
<?php $__env->startSection('image',asset('images/logo/logofb.jpg')); ?>
<?php $__env->startSection('url',trans('desc.url')); ?>
<?php $__env->startSection('description',trans('desc.description')); ?>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 cont">

                <br>

                <br>
                <style>
                    .centers-body {
                        /* padding: 18px; */
                        padding: 18px 25px;
                    }
                </style>
<div class="col-md-6 col-md-offset-3 " style="    border: 1px solid #ccb160;
    padding: 0;">

    <div style="padding: 5px;
    border-bottom: 1px solid #d3a82a;
    background-color: #ffdc73;" class="center">
        <h2>تسجيل الدخول</h2>
    </div>
    <div class="centers-body">
            <?php echo Form::open(['url'=>'login','class'=>'form-style-2','method'=>'POST']); ?>

        <?php if(count($errors)> 0): ?>

            <div style="position: relative" class="alert alert-warning">
                <a href="javascript:void(0);" class="close" data-dismiss="alert"
                   aria-label="close">&times;</a>
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>

        <?php endif; ?>
        <?php if(session('error')): ?>
            <div style="position: relative" class="alert alert-warning">
                <a href="javascript:void(0);" class="close" data-dismiss="alert"
                   aria-label="close">&times;</a>

                <strong>تنبيه!</strong> <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>
        <?php if(session('reset')): ?>
            <div style="position: relative" class="alert alert-warning">
                <a href="javascript:void(0);" class="close" data-dismiss="alert"
                   aria-label="close">&times;</a>

                <strong>تنبيه!</strong><span> البريد الإلكتروني غير مفعل. لتفعيل أنقر </span><a href="/confirm">هنا</a>
            </div>
        <?php endif; ?>
        <?php if(session('confirm')): ?>
            <div style="position: relative" class="alert alert-success">
                <a href="javascript:void(0);" class="close" data-dismiss="alert"
                   aria-label="close">&times;</a>

                <strong>تنبيه!</strong><span><?php echo e(session('confirm')); ?></span>
            </div>
        <?php endif; ?>

                    <div class="form-group">

                    <table  class="login-table">
                       <tbody>
                        <tr>
                            <td>
                                <label for="email">البريد الإلكتروني
                                </label>
                            </td>
                            <td><input style="width: 100%" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" /> </td>

                        </tr>

                        <tr>
                            <td><label for="password">الرقم السري</label></td>
                            <td><input type="password" class="form-control" name="password" /></td>
                        </tr>
                        <tr>

                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button type="submit" class="btn btn-block btn-primary">دخول</button>
                                 <a  href="/password/email" >إستعادة كلمة السر</a>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <hr>
                                <a href="/login/facebook" class="btn btn-face font-md btn-block icon-facebook-official"  >تسجيل عن طريق الفيسبوك</a>
                                <a href="/login/google" class="btn   btn-block font-md  btn-danger icon-gplus-squared" >تسجيل عن طريق الجوجل</a>

                            </td>
                        </tr>


                       </tbody>
                        </table>
                    </div>

                <?php echo Form::close(); ?>


    </div>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header_ads', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\libyacv\resources\views/seekers/auth/login.blade.php ENDPATH**/ ?>