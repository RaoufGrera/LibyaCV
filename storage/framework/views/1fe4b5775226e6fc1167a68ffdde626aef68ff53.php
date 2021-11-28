<!DOCTYPE html>
<html>
    <head>
        <title>libyacv</title>

<meta id="X-CSRF-TOKEN" content="<?php echo e(csrf_token()); ?>">
<meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/bootstrap-arabic.css')); ?>">
     <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/script.css')); ?>">
             <link rel="stylesheet" type="text/css" href="<?php echo e(asset('facebox.css')); ?>">


<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no" />

        <link rel="icon" type="image/png" href="<?php echo e(asset('images/simple/newlogo1.png')); ?>">

        <img src="<?php echo e(asset('images/ajax-loader.gif')); ?>" style="display:none;" />
 
     </head>
    <body>


        <nav class="navbar navbar-default">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="https://www.libyacv.com"><img style="width: 90px;" src="<?php echo e(asset('images/logo/lcv2.png')); ?>"/></a>
                   <!-- <a href="#"><img class="logo" src="http://localhost/libyacv/public/images/logocv2.png"></a>-->
                </div>
            </div>
                <!-- Collect the nav links, forms, and other content for toggling -->





        </nav>

 <?php echo $__env->yieldContent('content'); ?>


        <script    type="text/javascript" src="<?php echo e(asset('js/facebox/jquery.js')); ?>" ></script>

        <script   type="text/javascript" src="<?php echo e(asset('js/app.js')); ?>"></script>
        <script   type="text/javascript" src="<?php echo e(asset('js/jquery.circliful.min.js')); ?>"></script>

   <script    type="text/javascript" src="<?php echo e(asset('js/facebox/facebox.js')); ?>"></script>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('a[class*=facebox]').facebox({
                    loadingImage : "<?php echo e(asset('images/ajax-loader.gif')); ?>",
                    closeImage   : ''

                })
            });


        </script>
        <script type="text/javascript">
            $(function(){
                $('.circlestat').circliful();
            });
        </script>
<script type="text/javascript" src="<?php echo e(asset('js/index.js')); ?>"></script>
        <!-- Go to www.addthis.com/dashboard to customize your tools -->

    </body>
</html><?php /**PATH C:\laragon\www\libyacv\resources\views/layouts/header-admin.blade.php ENDPATH**/ ?>