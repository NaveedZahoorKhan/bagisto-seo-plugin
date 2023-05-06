<?php $__currentLoopData = $metaTags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group=>$tags): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <fieldset>
        <legend><?php echo e($group); ?></legend>
        <div class="row">
            <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('seo::admin.forms.tag', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </fieldset>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /var/www/html/packages/laravel-seo-tools-master/SEO/src/Providers/../Resources/views/admin/forms/fields/page_meta_others.blade.php ENDPATH**/ ?>