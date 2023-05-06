<?php $__env->startSection('header'); ?>
    <i class="fa fa-users text-muted"></i> Social Media Setting
<?php $__env->stopSection(); ?>
<?php $__env->startSection('tools'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-wrapper'); ?>
    <nav class="nav nav-tabs" id="seo-settings-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-social-tab" data-toggle="tab" href="#nav-social" role="tab"
           aria-controls="nav-social" aria-selected="true"> Accounts
        </a>

        <a class="nav-item nav-link" id="nav-facebook-tab" data-toggle="tab" href="#nav-facebook" role="tab"
           aria-controls="nav-facebook" aria-selected="false"> <i class="fa fa-facebook-official"></i> Facebook
        </a>

        <a class="nav-item nav-link" id="nav-twitter-tab" data-toggle="tab" href="#nav-twitter" role="tab"
           aria-controls="nav-twitter" aria-selected="false"> <i class="fa fa-twitter"></i> Twitter
        </a>

    </nav>
    <div class="tab-content mt-3" id="nav-tabContent">
        <?php echo $__env->make('seo::admin.tabs.social', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="tab-pane fade" id="nav-facebook" role="tabpanel" aria-labelledby="nav-facebook-tab">
            <?php echo $__env->make('seo::admin.forms.meta-tag-global',['tags'=>$og], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div class="tab-pane fade" id="nav-twitter" role="tabpanel" aria-labelledby="nav-twitter-tab">
            <?php echo $__env->make('seo::admin.forms.meta-tag-global',['tags'=>$twitter], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(config('seo.layout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/packages/laravel-seo-tools-master/SEO/src/Providers/../Resources/views/admin/pages/dashboard/social.blade.php ENDPATH**/ ?>