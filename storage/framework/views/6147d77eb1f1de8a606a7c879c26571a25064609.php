<?php $__env->startSection('header'); ?>
    <i class="fa fa-file text-muted"></i> Pages
<?php $__env->stopSection(); ?>
<?php $__env->startSection('tools'); ?>
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-wrapper'); ?>
&nbsp;&nbsp;
    <div class="btn-group">

        <?php if(count(config('seo.linkProviders'))>0): ?>
            <a class="btn btn-outline-secondary" href="<?php echo e(route('seo::pages.generate')); ?>">Generate Page</a>
        <?php endif; ?>
        <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#uploadPageCsv">
            <i class="fa fa-cloud-upload"></i> Upload CSV
        </button>
        <a href="<?php echo e(route('pages.download')); ?>" class="btn btn-outline-secondary">
            <i class="fa fa-download"></i> Download CSV
        </a>
        <a href="<?php echo e(route('pages.zip')); ?>" class="btn btn-outline-secondary">
            <i class="fa fa-file-zip-o"></i> Download Zip
        </a>
        <?php if(config('seo.cache.enable')): ?>
            <form action="<?php echo e(route('pages.cache')); ?>" method="post" style="display: inline">
                <?php echo e(csrf_field()); ?>

                <input type="submit" value="Refresh Cache" class="btn btn-outline-secondary">
            </form>
        <?php endif; ?>
        <a href="<?php echo e(route('pages.bulkEdit')); ?>" class="btn btn-outline-secondary">
            <i class="fa fa-pencil-square-o"></i> Bulk Edit
        </a>
        <a class="btn btn-outline-secondary" href="<?php echo e(route('pages.create')); ?>"><i class="fa fa-plus"></i></a>
    </div>
    <form method="get" class="m-form">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group m-form__group">
                    <div class="input-group">
                        <div class="input-group-append">
                            <select name="object" class="form-control">
                                <option value="">All</option>
                                <?php $__currentLoopData = $objects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $object): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($object); ?>"
                                            <?php echo e(request('object')==$object?'selected':''); ?>>
                                        <?php echo e($object); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <input type="text" name="search" class="form-control"
                               value="<?php echo e($_GET['search']??''); ?>"
                               placeholder="Search for .. product name, brand, model">
                        <div class="input-group-append">
                            <button class="btn btn-light text-primary m--font-boldest" type="submit"><i
                                        class="fa fa-search"></i> Search
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-right">
                <?php echo $records->appends(['object'=>request('object'),'search'=>request('search')])->render(); ?>

            </div>
        </div>
    </form>
    <div class="row">
        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-6">
                <?php echo $__env->make('seo::admin.cards.page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php echo $records->render(); ?>

    <?php echo $__env->make('seo::admin.modals.page_upload', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(config('seo.layout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/packages/laravel-seo-tools-master/SEO/src/Providers/../Resources/views/admin/pages/pages/index.blade.php ENDPATH**/ ?>