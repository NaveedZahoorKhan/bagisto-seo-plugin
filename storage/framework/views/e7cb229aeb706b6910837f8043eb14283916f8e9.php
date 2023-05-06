<?php $__env->startSection('header'); ?>
    <i class="fa fa-code text-muted"></i> XML SiteMap Manger
<?php $__env->stopSection(); ?>
<?php $__env->startSection('tools'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-wrapper'); ?>
    <form action="<?php echo e(route('sitemap.update')); ?>" method="post">
        <?php echo e(csrf_field()); ?>


        <table class="table table-secondary table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Path</th>
                <th data-toggle="tooltip" title="How frequently the page is likely to change">Change Frequency</th>
                <th data-toggle="tooltip" title="      The priority of this URL relative to other URLs on your site. Valid values range from 0.0 to 1.0.
                    This value does not affect how your pages are compared to pages on other sites—it only lets the
                    search engines know which pages you deem most important for the crawlers.">Priority
                </th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <input type="hidden" value="<?php echo e($page->id); ?>" name="page_id[]"/>
                    <td><?php echo e($page->id); ?></td>
                    <td><a href="<?php echo e(route('pages.meta',$page->id)); ?>"> <?php echo e($page->getShortPath()); ?></a></td>
                    <td>
                        <select class="form-control" id="change_frequency_<?php echo e($page->id); ?>" name="change_frequency[]">
                            <option value="always" <?php echo e($page->getChangeFrequency()=='always'?'selected':''); ?>>Always
                            </option>
                            <option value="hourly" <?php echo e($page->getChangeFrequency()=='hourly'?'selected':''); ?>>Hourly
                            </option>
                            <option value="daily" <?php echo e($page->getChangeFrequency()=='daily'?'selected':''); ?>>Daily</option>
                            <option value="weekly" <?php echo e($page->getChangeFrequency()=='weekly'?'selected':''); ?>>Weekly
                            </option>
                            <option value="monthly" <?php echo e($page->getChangeFrequency()=='monthly'?'selected':''); ?>>Monthly
                            </option>
                            <option value="yearly" <?php echo e($page->getChangeFrequency()=='yearly'?'selected':''); ?>>Yearly
                            </option>
                            <option value="never" <?php echo e($page->getChangeFrequency()=='never'?'selected':''); ?>>Never</option>
                        </select>
                    </td>
                    <td>

                        <input type="number" class="form-control" id="page_priority"
                               name="priority[]"
                               value="<?php echo e($page->getPriority()); ?>"
                               placeholder="" min="0" max="1.0" step="0.1">
                    </td>
                    <td>
                        <a href="<?php echo e(route('pages.meta',$page->id)); ?>"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
            <tr>
                <td></td>
                <td colspan="2"><?php echo $pages->render(); ?></td>
                <td colspan="2" class="text-right">
                    <input type="submit" class="btn btn-primary btn-block" value="Save">
                </td>
            </tr>
            </tfoot>
        </table>
    </form>


    <div class="row mb-2">
        <div class="col-sm-12">
            <ul class="list-group">
                <li class="list-group-item list-group-item-heading list-group-item-primary">
                    Your SiteMaps &nbsp;&nbsp; &nbsp;&nbsp;
                    <form action="<?php echo e(route('sitemap.generate')); ?>" method="post" style="display: inline">
                        <?php echo e(csrf_field()); ?>

                        <input type="submit" value="Generate" class="btn btn-primary btn-sm">
                    </form>
                </li>
                <?php $__currentLoopData = $sitemaps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sitemap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item"><a target="_blank" href="<?php echo e($sitemap); ?>"><?php echo e($sitemap); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
    <div class="help-block">
        <a href="https://www.google.com/webmasters/tools/sitemap-list?pli=1">
            Submit your Sitemap
        </a>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(config('seo.layout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/packages/laravel-seo-tools-master/SEO/src/Providers/../Resources/views/admin/pages/dashboard/sitemap.blade.php ENDPATH**/ ?>