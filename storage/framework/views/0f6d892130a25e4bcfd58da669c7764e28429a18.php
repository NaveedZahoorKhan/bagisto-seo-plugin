<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard.index')); ?>"> Dashboard</a></li>
<li class="breadcrumb-item">Analysis</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-wrapper'); ?>
<form method="get">
    <div class="row">
        <div class="form-group col-5">
            <div class="input-group">
                <div class="input-group-addon">
                    Url
                </div>
                <input type="url" name="url" value="<?php echo e(request('url')); ?>" id="page_url" class="form-control">
            </div>
        </div>
        <div class="form-group col-5">
            <div class="input-group">
                <div class="input-group-addon">
                    Keyword
                </div>
                <input type="search" name="keyword" value="<?php echo e(request('keyword')); ?>" id="page_keyword" class="form-control">
            </div>
        </div>
        <div class="form-group col-2">
            <input type="submit" value="Go" class="btn btn-outline-primary">
        </div>
    </div>


</form>
<?php echo $__env->make('seo::admin.includes.analysis', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/packages/laravel-seo-tools-master/SEO/src/Providers/../Resources/views/admin/pages/analysis/index.blade.php ENDPATH**/ ?>