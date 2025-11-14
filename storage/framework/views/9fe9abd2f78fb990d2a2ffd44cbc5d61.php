
<?php $__env->startSection('title', 'Detalle de Asignación'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="card card-dorado">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="bi bi-file-text"></i> Detalle de Asignación</h4>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-4">
                    <h5 class="text-primary"><i class="bi bi-person-badge"></i> Docente</h5>
                    <hr>
                    <p><strong>DNI:</strong> <?php echo e($asignacion->docente->dni); ?></p>
                    <p><strong>Nombre:</strong> <?php echo e($asignacion->docente->nombres); ?> <?php echo e($asignacion->docente->apellidos); ?></p>
                    <p><strong>Especialidad:</strong> <?php echo e($asignacion->docente->especialidad); ?></p>
                </div>
                <div class="col-md-4">
                    <h5 class="text-primary"><i class="bi bi-book"></i> Asignatura</h5>
                    <hr>
                    <p><strong>Código:</strong> <?php echo e($asignacion->asignatura->codigo); ?></p>
                    <p><strong>Nombre:</strong> <?php echo e($asignacion->asignatura->nombre); ?></p>
                    <p><strong>Nivel:</strong> <?php echo e($asignacion->asignatura->nivel); ?></p>
                </div>
                <div class="col-md-4">
                    <h5 class="text-primary"><i class="bi bi-calendar"></i> Curso y Horario</h5>
                    <hr>
                    <p><strong>Curso:</strong> <?php echo e($asignacion->curso->nombre); ?></p>
                    <p><strong>Horario:</strong> <?php echo e($asignacion->horario); ?></p>
                    <p><strong>Registrada:</strong> <?php echo e($asignacion->created_at->format('d/m/Y')); ?></p>
                </div>
            </div>
            <div class="mt-4">
                <a href="<?php echo e(route('asignaciones.listar')); ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>
                <a href="<?php echo e(route('asignaciones.edit', $asignacion->id)); ?>" class="btn btn-dorado">
                    <i class="bi bi-pencil"></i> Editar
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vladb\Desktop\CICLO 3\aplicaciones de internet\TRABAJO FINAL\scholarium FINAL\resources\views/asignaciones/show.blade.php ENDPATH**/ ?>