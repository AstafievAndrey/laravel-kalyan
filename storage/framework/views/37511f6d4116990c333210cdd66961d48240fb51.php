<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Добавить файл</div>

                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo e(url('files')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                            <label class="col-sm-4 control-label">Название документа</label>
                            <div class="col-sm-8">
                                <input value="<?php echo e(old('name')); ?>" type="text" name="name" 
                                       class="form-control" placeholder="введите название файла">
                                <?php if($errors->has('name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('type') ? ' has-error' : ''); ?>">
                            <label class="col-sm-4 control-label">Тип файла</label>
                            <div class="col-sm-8">
                                <select name="type" class="form-control">
                                    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if( !is_null(old('type')) && ($key == old('type'))): ?>
                                            <option selected value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('type')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('type')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('desc') ? ' has-error' : ''); ?>">
                            <label class="col-sm-4 control-label">Описание файла</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" style="max-width: 100%;" name="desc" 
                                          rows="3" placeholder="Описание файла"><?php echo e(old('desc')); ?></textarea>
                                <?php if($errors->has('description')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('desc')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                            <div class="col-sm-12">
                                Отправить в телеграм(только для изображений)
                                <input type="checkbox" name="telegram">
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('file') ? ' has-error' : ''); ?>">
                            <div class="col-sm-offset-4 col-sm-8">
                                <label for="file" class="btn btn-success">Выберите файл</label>
                                <input style="display: none;" id="file" type="file" name="file">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                <?php if($errors->has('file')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('file')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>