<form onsubmit="return confirm('Are you sure you want to delete?')"
      action="<?php echo e(isset($route)?$route:''); ?>" method="post" style="display: inline">
    <?php echo e(csrf_field()); ?>

    <?php echo e(method_field('DELETE')); ?>

    <button type="submit" class="btn btn-default cursor-pointer  btn-sm"><i
                class="text-danger fa fa-remove"></i></button>
</form><?php /**PATH /var/www/html/packages/laravel-seo-tools-master/SEO/src/Providers/../Resources/views/admin/forms/destroy.blade.php ENDPATH**/ ?>