<?php $__env->startSection('page_title'); ?>
<i class="fa fa-home text-muted"></i> Dashboard
<?php $__env->stopSection(); ?>
<?php $__env->startSection('tools'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-wrapper'); ?>


<nav class="nav nav-tabs" id="seo-settings-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-dashboard-tab" data-toggle="tab" href="#nav-dashboard" role="tab" aria-controls="nav-global" aria-selected="true">Home
    </a>

    <a class="nav-item nav-link" id="nav-site-tab" data-toggle="tab" href="#nav-site" role="tab" aria-controls="nav-global" aria-selected="true">Site
    </a>

    <a class="nav-item nav-link" id="nav-webmaster-tab" data-toggle="tab" href="#nav-webmaster" role="tab" aria-controls="nav-page-meta-tags" aria-selected="false">Webmaster Tools
    </a>
    <a class="nav-item nav-link" id="nav-personal-info-tab" data-toggle="tab" href="#nav-personal-info" role="tab" aria-controls="nav-page-meta-tags" aria-selected="false">Personal/Company info
    </a>
</nav>
<div class="tab-content mt-3" id="nav-tabContent">
    <?php echo $__env->make('seo::admin.tabs.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('seo::admin.tabs.site', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="tab-pane fade" id="nav-webmaster" role="tabpanel" aria-labelledby="nav-webmaster-tab">
        <?php echo $__env->make('seo::admin.forms.meta-tag-global',['tags'=>$data['webmasterTags']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <div class="tab-pane fade" id="nav-personal-info" role="tabpanel" aria-labelledby="nav-personal-info-tab">

        <?php echo $__env->make('seo::admin.tabs.ownership', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
    $(document).ready(function(e) {
        $('#seo-settings-tab a').on('click', function(e) {
            e.preventDefault()
            $(this).tab('show')
        })
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(config('seo.layout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/packages/laravel-seo-tools-master/SEO/src/Providers/../Resources/views/admin/pages/dashboard/index.blade.php ENDPATH**/ ?>