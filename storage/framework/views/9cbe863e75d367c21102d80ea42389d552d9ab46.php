<div class="form-group col-sm-6">
    <label for="<?php echo e($tag->id); ?>"><?php echo e($tag->input_label); ?></label>
    <br />
    <?php if($tag->input_type=='file'): ?>
    <div class="">
        <input type="file" id="Image" name="meta[<?php echo e($tag->id); ?>]" class="form-control-lg">
        <span class="">
            <?php if(!empty($tag->content)): ?>
            <img src="<?php echo e($tag->content); ?>" width="120px">
            <?php endif; ?>
        </span>
    </div>
    <?php else: ?>
    <input type="<?php echo e($tag->input_type); ?>" name="meta[<?php echo e($tag->id); ?>]" value="<?php if(!empty($tag->content)): ?><?php echo e($tag->content); ?><?php else: ?><?php echo e((\Rastventure\SEO\Models\MetaTag::hasOptions($tag->default_value)===false?$tag->default_value:'')); ?><?php endif; ?>" placeholder="<?php echo e($tag->input_placeholder); ?>" class="form-control" id="<?php echo e($tag->id); ?>" <?php echo e((\Rastventure\SEO\Models\MetaTag::hasOptions($tag->default_value)!==false)?'list=datalist-'.$tag->id:''); ?>>
    <?php endif; ?>

    <?php if(\Rastventure\SEO\Models\MetaTag::hasOptions($tag->default_value)!==false): ?>
    <datalist id="datalist-<?php echo e($tag->id); ?>">
        <?php $__currentLoopData = \Rastventure\SEO\Models\MetaTag::getDefaultValue($tag->default_value); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($option); ?>">
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </datalist>
    <?php endif; ?>
    <span class="text-muted form-text"><?php echo e($tag->input_info); ?></span>
</div><?php /**PATH /var/www/html/packages/laravel-seo-tools-master/SEO/src/Providers/../Resources/views/admin/forms/tag.blade.php ENDPATH**/ ?>