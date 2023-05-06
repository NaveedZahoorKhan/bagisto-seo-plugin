<div class="tab-pane show active" id="nav-robot-txt" role="tabpanel" aria-labelledby="nav-robot-txt-tab">
    <form action="<?php echo e(route('settings.robot_txt')); ?>" method="post">
        <?php echo e(csrf_field()); ?>

        <div class="form-group">
            <textarea name="robot_txt"  class="form-control" rows="15"
                      placeholder="Content of your robot.txt"><?php $robotTxt = new Rastventure\SEO\Services\RobotTxt();echo $robotTxt->get(); ?></textarea>
            <small id="site-title-help" class="form-text text-muted">Please write content here carefully. It will read
                by bot.
            </small>
            <a class="lead text-primary" href="https://moz.com/learn/seo/robotstxt">Learn more about Robot.txt</a>

        </div>
        <div class="form-group text-right">
            <input type="submit" value="Save" class="btn btn-primary">
        </div>
    </form>
</div><?php /**PATH /var/www/html/packages/laravel-seo-tools-master/SEO/src/Providers/../Resources/views/admin/tabs/robot.blade.php ENDPATH**/ ?>