<div class="row">

    <?php if(isset($data['success']) && !empty($data['success'])): ?>
    <div class="col-sm-9">
        <table class="table table-bordered" style="overflow-y: auto">
            <tbody>
                <tr>
                    <th>Meta Title</th>
                    <td>
                        <?php if(strlen($data['title'])>0): ?>
                        <span class="h4">
                            <?php echo e($data['title']); ?>

                        </span>
                        <?php else: ?>
                        <i class="fa fa-remove text-danger fa-3x"></i>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Meta Description</th>
                    <td>
                        <?php if(isset($data['metas']['description']['content']) && !empty($data['metas']['description']['content'])): ?>
                        <span class="">
                            <?php echo e($data['metas']['description']['content']); ?>

                        </span>
                        <?php else: ?>
                        <i class="fa fa-remove text-danger fa-3x"></i>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Other Meta</th>
                    <td>
                        <div id="accordionMetaTags" role="tablist" aria-multiselectable="true">
                            <div class="card">
                                <div class="card-title" role="tab" id="headingMetaTags">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" data-parent="#accordionMetaTags" href="#collapseMetaTags" aria-expanded="false" aria-controls="collapse">
                                            &nbsp;&nbsp;
                                            <label><b><?php echo e(count($data['metas'])); ?></b>

                                            </label> found <i class="fa fa-arrow-down"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseMetaTags" class="collapse hide" role="tabpanel" aria-labelledby="headingMetaTags">
                                    <div class="card-block">
                                        <ul class="list-group" style="overflow-y: auto">
                                            <?php $__currentLoopData = $data['metas']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="list-group-item">
                                                <code style="word-break: break-all">
                                                    &lt;meta <?php $__currentLoopData = $m; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php echo e($p."="."\"$v\""); ?>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    /&gt;
                                                </code>
                                            </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>H1 heading status</th>
                    <td>
                        <?php if(isset($data['headings']['h1']) && count($data['headings']['h1'])>0): ?>
                        <?php echo $__env->make('seo::includes.heading-analysis',['level'=>1,'tags'=>$data['headings']['h1']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php else: ?>
                        <i class="fa fa-remove text-danger fa-3x"></i>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>H2 heading status</th>
                    <td>
                        <?php if(isset($data['headings']['h2']) && count($data['headings']['h2'])>0): ?>
                        <?php echo $__env->make('seo::includes.heading-analysis',['level'=>2,'tags'=>$data['headings']['h2']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php else: ?>
                        <i class="fa fa-remove text-danger fa-2x"></i>
                        <?php endif; ?>

                    </td>
                </tr>
                <tr>
                    <th>H3 heading status</th>
                    <td>
                        <?php if(isset($data['headings']['h3']) && count($data['headings']['h3'])>0): ?>
                        <?php echo $__env->make('seo::includes.heading-analysis',['level'=>3,'tags'=>$data['headings']['h3']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php else: ?>
                        <i class="fa fa-remove text-danger fa-2x"></i>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Anchor</th>
                    <td>
                        <div id="accordionAnchor" role="tablist" aria-multiselectable="true">
                            <div class="card">
                                <div class="card-title" role="tab" id="headingAnchor">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" data-parent="#accordionAnchor" href="#collapseAnchor" aria-expanded="false" aria-controls="collapse">
                                            &nbsp;&nbsp;
                                            <label><b><?php echo e(count($data['anchors'])); ?></b>

                                            </label> found <i class="fa fa-arrow-down"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseAnchor" class="collapse hide" role="tabpanel" aria-labelledby="headingAnchor">
                                    <div class="card-block">
                                        <table class="table table-bordered" style="overflow-y: auto">
                                            <?php $__currentLoopData = $data['anchors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td style="word-break: break-all"><?php echo e($f['href'] or ''); ?></td>
                                                <td><?php echo e($f['text'] or ''); ?></td>
                                                <td>
                                                    <label class="badge <?php echo e(empty($f['internal'])?' badge-warning':' badge-default'); ?> "><?php echo e(empty($f['internal'])?' External':' Internal'); ?></label>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php $images = $data['images']; ?>
        <?php if(count($images) >0): ?>
        <?php $__currentLoopData = array_chunk($images,4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imgChunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card-group">
            <?php $__currentLoopData = $imgChunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card mb-2">
                <?php if (isset($image['src']) && !empty($image['src'])) : ?>
                    <img src="<?php echo e($image['src']); ?>" class="card-img-top img-responsive">
                <?php endif; ?>
                <div class="card-body mb-0 p-1">
                    <div class="card-title">
                        <?php if(isset($image['alt']) && !empty($image['alt'])): ?>
                        <small class="text-muted"><?php echo e($image['alt']); ?></small>
                        <?php else: ?>
                        <i class="fa fa-remove text-danger fa-2x"></i> No Alt attribute found
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-footer p-0">
                    <?php if(isset($image['src']) && !empty($image['src'])): ?>

                    <?php if(isset($image['width']) && isset($image['height'])): ?>
                    &nbsp;<label class="badge badge-secondary"> <?php echo e($image['width']); ?>px
                        x <?php echo e($image['height']); ?>px</label>
                    <?php endif; ?>

                    <?php if(isset($image['mime'])): ?>
                    <label class="badge badge-secondary"><?php echo e($image['mime']); ?></label>
                    <?php endif; ?>

                    &nbsp;<?php if(isset($image['size'])): ?>
                    <label class="badge badge-secondary">
                        <?php echo e($image['size']); ?> kb
                    </label>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <i class="fa fa-remove text-danger fa-2x"></i> No image found
        <?php endif; ?>

    </div>
    <div class="col-sm-3">
        <p class="lead border-light border bg-light">
            &nbsp;<label class="badge badge-info"> <?php echo e($data['size']); ?> KB</label> total page size
        </p>
        <h3>Keyword Analysis</h3>
        <div class="alert">

        </div>
        <ul class="list-group">
            <?php $__currentLoopData = $data['result']['good']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="list-group-item list-group-item-success"><?php echo e($message); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <ul class="list-group">
            <?php $__currentLoopData = $data['result']['warnings']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="list-group-item list-group-item-warning"><?php echo e($message); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <ul class="list-group">
            <?php $__currentLoopData = $data['result']['errors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="list-group-item list-group-item-danger"><?php echo e($message); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php else: ?>
    <div class="alert alert-warning">Page does not exists</div>
    <?php endif; ?>
</div><?php /**PATH /var/www/html/packages/laravel-seo-tools-master/SEO/src/Providers/../Resources/views/admin/includes/analysis.blade.php ENDPATH**/ ?>