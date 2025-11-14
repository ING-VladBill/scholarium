
<?php $__env->startSection('title', 'Editar Asignación'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="card card-dorado">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0"><i class="bi bi-pencil"></i> Editar Asignación</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('asignaciones.update', $asignacion->id)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Curso</label>
                        <select name="curso_id" class="form-select" required>
                            <?php $__currentLoopData = $cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($curso->id); ?>" <?php echo e($asignacion->curso_id == $curso->id ? 'selected' : ''); ?>>
                                    <?php echo e($curso->nombre); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Asignatura</label>
                        <select name="asignatura_id" class="form-select" required>
                            <?php $__currentLoopData = $asignaturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asignatura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($asignatura->id); ?>" <?php echo e($asignacion->asignatura_id == $asignatura->id ? 'selected' : ''); ?>>
                                    <?php echo e($asignatura->codigo); ?> - <?php echo e($asignatura->nombre); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Docente</label>
                        <select name="docente_id" class="form-select" required>
                            <?php $__currentLoopData = $docentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $docente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($docente->id); ?>" <?php echo e($asignacion->docente_id == $docente->id ? 'selected' : ''); ?>>
                                    <?php echo e($docente->dni); ?> - <?php echo e($docente->apellidos); ?>, <?php echo e($docente->nombres); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Horario</label>
                        <input type="text" name="horario" class="form-control" value="<?php echo e($asignacion->horario); ?>" placeholder="Ej: Lunes 8:00-10:00" required>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-dorado">
                        <i class="bi bi-save"></i> Guardar Cambios
                    </button>
                    <a href="<?php echo e(route('asignaciones.listar')); ?>" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vladb\Desktop\CICLO 3\aplicaciones de internet\TRABAJO FINAL\scholarium FINAL\resources\views/asignaciones/edit.blade.php ENDPATH**/ ?>