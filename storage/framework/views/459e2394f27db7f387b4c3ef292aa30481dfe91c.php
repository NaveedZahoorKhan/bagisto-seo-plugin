<form action="<?php echo e(isset($route)?$route: route('admin.seo.pages.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>

    <input type="hidden" name="_method" value="<?php echo e(isset($method)?$method:'POST'); ?>" />
    <?php echo $__env->make('seo::admin.includes.page_meta_tags', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="form-group text-right mt-2 ">
        <input type="reset" class="btn btn-default" value="Clear" />
        <input type="submit" class="btn btn-primary" value="Save" />
    </div>
</form><?php /**PATH /var/www/html/packages/laravel-seo-tools-master/SEO/src/Providers/../Resources/views/admin/forms/page.blade.php ENDPATH**/ ?>