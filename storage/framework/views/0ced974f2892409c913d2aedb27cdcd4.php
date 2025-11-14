<?php $__env->startSection('title', 'Nueva Asignación'); ?>
<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <h2 class="text-primary mb-4"><i class="bi bi-calendar-plus me-2"></i>Nueva Asignación Docente-Asignatura</h2>
    
    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle me-2"></i><?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Paso 1: Seleccione un Curso</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <?php $__currentLoopData = $cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($curso->nombre); ?></h5>
                            <p class="card-text">
                                <span class="badge bg-info"><?php echo e($curso->nivel); ?></span>
                                <span class="badge bg-secondary"><?php echo e($curso->sala); ?></span>
                            </p>
                            <a href="<?php echo e(route('asignaciones.seleccionar-asignatura', $curso->id)); ?>" class="btn btn-primary">
                                <i class="bi bi-arrow-right-circle me-2"></i>Seleccionar
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vladb\Desktop\CICLO 3\aplicaciones de internet\TRABAJO FINAL\scholarium FINAL\resources\views/asignaciones/index.blade.php ENDPATH**/ ?>