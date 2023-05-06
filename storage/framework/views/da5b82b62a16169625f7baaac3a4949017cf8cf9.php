<?php
$model = $data['model'];
?>
<div class="tab-pane fade  show active" id="nav-site" role="tabpanel" aria-labelledby="nav-site-tab">
    <form action="<?php echo e(route('admin.seo.settings.store')); ?>" method="post">
        <?php echo e(csrf_field()); ?>

        <div class="form-row">
            <div class="form-group col-sm-6">
                <label for="site-tittle">Site Title</label>
                <input type="text" class="form-control" name="settings[site_title][value]" id="site-tittle" aria-describedby="site-title-help" placeholder="Site title must be below 80 words" max="80" value="<?php echo e($model->getValueByKey('site_title')); ?>">
                <small id="site-title-help" class="form-text text-muted">Site Title</small>
            </div>
            <div class="form-group col-sm-6">
                <label for="entries_per_sitemap">Entries per sitemap page</label>
                <input type="number" class="form-control" id="entries_per_sitemap" value="<?php echo e($model->getValueByKey('entries_per_sitemap')); ?>" name="settings[entries_per_sitemap][value]" placeholder="">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-sm-4">
                <label for="robot-index">Robot Index</label>
                <select name="settings[robot_index][value]" id="robot-index" class="form-control">
                    <option value="index" <?php echo e($model->getValueByKey('robot_index')=='index'?'selected':''); ?>>Index</option>
                    <option value="noindex" <?php echo e($model->getValueByKey('robot_index')=='noindex'?'selected':''); ?>>
                        No Index
                    </option>
                </select>
                <small id="robot-index-help" class="form-text text-muted">
                    If value is <i>No Index</i> then it will overwrite all of the page robot index.
                </small>
            </div>

            <div class="form-group col-sm-4">
                <label for="robot-follow">Robot follow</label>
                <select name="settings[robot_follow][value]" id="robot-follow" class="form-control">
                    <option value="follow" <?php echo e($model->getValueByKey('robot_follow')=='follow'?'selected':''); ?>>Follow
                    </option>
                    <option value="nofollow" <?php echo e($model->getValueByKey('robot_follow')=='nofollow'?'selected':''); ?>>
                        No Follow
                    </option>
                </select>

                <small id="robot-follow-help" class="form-text text-muted">
                    If value is <i>No Follow</i> then it will overwrite all of the page robot follow.
                </small>
            </div>
        </div>
        <div class="form-group text-right">
            <input type="submit" value="Save" class="btn btn-primary ">
        </div>
    </form>
</div><?php /**PATH /var/www/html/packages/laravel-seo-tools-master/SEO/src/Providers/../Resources/views/admin/tabs/site.blade.php ENDPATH**/ ?>