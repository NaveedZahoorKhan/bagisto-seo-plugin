<?php $__env->startSection('header'); ?>
    <i class="fa fa-pencil"></i> <?php echo e($record->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('tools'); ?>
    <a class="btn btn-outline-secondary" href="<?php echo e(route('pages.create')); ?>">
        <i class="fa fa-plus"></i> New Page
    </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-wrapper'); ?>
    <div class="row">
        <div class='col-md-12'>
            <div class='panel panel-default'>
                <div class="panel-body">
                    <?php echo $__env->make('seo::admin.forms.page',[
                    'showPageUrl' => true,
                    'route' => route('pages.update',$record->id),
                    'method' => 'PUT'
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(config('seo.layout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/packages/laravel-seo-tools-master/SEO/src/Providers/../Resources/views/admin/pages/pages/edit.blade.php ENDPATH**/ ?>