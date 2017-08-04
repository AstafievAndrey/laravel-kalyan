<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="panel panel-default panel-heading col-md-8 col-md-offset-2">
             <a href="<?php echo e(url('shop/create')); ?>" class="btn btn-primary btn-xs">Добавить</a>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <?php $__currentLoopData = $shops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row panel panel-default">
                    <div class="col-sm-12 page-header">
                        <h3><?php echo e($shop->name); ?> <br> <small><?php echo e($shop->short_desc); ?></small></h3>
                    </div>
                    <div class="col-sm-12" style="text-align: right;padding-bottom: 10px">
                        <form class="form-inline" action="<?php echo e(url('shop/'.$shop->id)); ?>" method="POST">
                            <?php echo e(method_field('delete')); ?>

                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <a href="<?php echo e(url('shop/'.$shop->id.'/edit')); ?>" class="btn btn-primary btn-xs">Редактировать</a>
                            <button type="submit" class="btn btn-danger btn-xs">Удалить</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
                <div class="col-sm-12">
                    <?php echo e($shops->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>