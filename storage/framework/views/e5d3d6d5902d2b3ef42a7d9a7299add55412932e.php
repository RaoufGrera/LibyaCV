<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
?>
<?php echo $__env->yieldContent('content'); ?>
<?php
}else{
    echo "error";
}
?><?php /**PATH C:\laragon\www\libyacv\resources\views/layouts/header-modal.blade.php ENDPATH**/ ?>