<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Файлы
                    <a class="btn btn-primary btn-xs" href="<?php echo e(url('files/create')); ?>">добавить</a>
                </div>

                <div class="panel-body">
                    <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row" style="margin-top:10px; padding: 10px 0px; background: #f9f9f9;">
                            <?php if($file->type === 'img'): ?>
                                <div class="col-sm-6">
                                    <img src="<?php echo e(asset('storage/'.$file->filepath)); ?>" alt="..." class="img-thumbnail">
                                </div>
                                <div class="col-sm-6">
                            <?php else: ?>
                                <div class="col-sm-12">
                            <?php endif; ?>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            Название: <?php echo e($file->original_name); ?>

                                        </div>
                                        <div class="col-sm-12">
                                            Тип:<?php if($file->type === 'img'): ?>
                                                    изображение
                                                <?php elseif($file->type === 'doc'): ?>
                                                    документ
                                                <?php else: ?>
                                                    видео
                                                <?php endif; ?>
                                        </div>
                                        <div class="col-sm-12">
                                            Размер: <?php echo e(round($file->size / 1024,2)); ?> кБ
                                        </div>
                                        <div class="col-sm-12">
                                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo e(url('files/'.$file->id)); ?>">
                                                <?php echo e(method_field('DELETE')); ?>

                                                <?php echo e(csrf_field()); ?>

                                                <button class="btn btn-danger btn-xs" type="submit">
                                                    удалить
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <?php echo e($files->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>