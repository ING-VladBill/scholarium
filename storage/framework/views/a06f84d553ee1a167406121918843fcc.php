<?php $__env->startSection('title', 'Seleccionar Asignatura'); ?>
<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <h2 class="text-primary mb-4">Paso 2: Seleccione una Asignatura</h2>
    <div class="alert alert-info">
        <strong>Curso:</strong> <?php echo e($curso->nombre); ?> (<?php echo e($curso->nivel); ?>)
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <?php $__empty_1 = true; $__currentLoopData = $asignaturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asignatura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5><?php echo e($asignatura->nombre); ?></h5>
                            <p class="small text-muted"><?php echo e($asignatura->codigo); ?> - <?php echo e($asignatura->horas_semanales); ?> hrs/semana</p>
                            <a href="<?php echo e(route('asignaciones.seleccionar-docente', [$curso->id, $asignatura->id])); ?>" class="btn btn-primary btn-sm">
                                Continuar
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-muted">No hay asignaturas disponibles para este nivel.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vladb\Desktop\CICLO 3\aplicaciones de internet\TRABAJO FINAL\scholarium FINAL\resources\views/asignaciones/seleccionar-asignatura.blade.php ENDPATH**/ ?>