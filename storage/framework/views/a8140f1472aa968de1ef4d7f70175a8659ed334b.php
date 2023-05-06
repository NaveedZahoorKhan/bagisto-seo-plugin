<?php $__env->startSection('header'); ?>
    <i class="fa fa-lock text-muted"></i> Site Configuration
<?php $__env->stopSection(); ?>
<?php $__env->startSection('tools'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-wrapper'); ?>
    <nav class="nav nav-tabs" id="seo-settings-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-social-tab" data-toggle="tab" href="#nav-robot-txt" role="tab"
           aria-controls="nav-social" aria-selected="true"> Robots.txt
        </a>

        <a class="nav-item nav-link" id="nav-htaccess-tab" data-toggle="tab" href="#nav-htaccess" role="tab"
           aria-controls="nav-facebook" aria-selected="false"> .htaccess
        </a>


    </nav>
    <div class="tab-content mt-3" id="nav-tabContent">
        <?php echo $__env->make('seo::admin.tabs.robot', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="tab-pane fade" id="nav-facebook" role="tabpanel" aria-labelledby="nav-facebook-tab">

        </div>
        <div class="tab-pane fade" id="nav-htaccess" role="tabpanel" aria-labelledby="nav-htaccess-tab">
            <?php echo $__env->make('seo::admin.tabs.htaccess', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(config('seo.layout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/packages/laravel-seo-tools-master/SEO/src/Providers/../Resources/views/admin/pages/dashboard/advanced.blade.php ENDPATH**/ ?>