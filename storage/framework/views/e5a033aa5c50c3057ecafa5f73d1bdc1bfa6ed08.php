<div class="card  mb-4">
    <div class="card-header">
        <a class="" href="<?php echo e(route('pages.show',$record->id)); ?>"> #<?php echo e($record->id); ?> <?php echo e($record->getTitle()); ?></a>
    </div>
    <div class="card-body">
        <div class="card-text">
            <?php echo e($record->getDescription()); ?>

        </div>
    </div>
    <div class="card-footer">
        <label class="badge badge-secondary"><?php echo e($record->robot_index); ?></label>
        <label class="badge badge-secondary"><?php echo e($record->robot_follow); ?></label>
        <label class="badge badge-light">
            <a class="text-primary" href="<?php echo e(route('pages.images.index',$record->id)); ?>">
                <?php echo e($record->page_images_count); ?> &nbsp;&nbsp; <i class="fa fa-image"></i>
            </a>
        </label>

        <a target="_blank" href="<?php echo e(url($record)); ?>">Visit page</a>

        &nbsp;
        <a target="_blank"
           href="https://developers.facebook.com/tools/debug/sharing/?q=<?php echo e(urlencode($record->getFullUrl())); ?>">
            <i class="fa fa-facebook-official"></i> Preview
        </a>
        &nbsp;
        <a target="_blank"
           href="https://developers.google.com/speed/pagespeed/insights/?url=<?php echo e(urlencode($record->getFullUrl())); ?>">
            <i class="fa fa-google"></i> Page Speed
        </a>

        <div class="" style="float: right">
            <a href="<?php echo e(route('pages.edit',$record->id)); ?>">
                <span class="fa fa-pencil"></span>
            </a>
            &nbsp;&nbsp;
            <?php echo $__env->make('seo::admin.forms.destroy',['route'=>route('pages.destroy',$record->id)], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/packages/laravel-seo-tools-master/SEO/src/Providers/../Resources/views/admin/cards/page.blade.php ENDPATH**/ ?>