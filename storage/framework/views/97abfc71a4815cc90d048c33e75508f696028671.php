<?php $__env->startSection('header'); ?>
    <i class="fa fa-plus text-muted"></i> New Page
<?php $__env->stopSection(); ?>
<?php $__env->startSection('tools'); ?>
    <input type="submit" class="btn btn-primary" form="SeoFormPage" value="Save"/>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-wrapper'); ?>
    <div class="row">
        <div class='col-md-12'>
            <div class='panel panel-default'>
                <div class="panel-body">
                    <?php echo $__env->make('seo::admin.forms.page',['showPageUrl'=>true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(config('seo.layout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/packages/laravel-seo-tools-master/SEO/src/Providers/../Resources/views/admin/pages/pages/create.blade.php ENDPATH**/ ?>