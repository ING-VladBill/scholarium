<?php $__env->startSection('title', 'Nueva Matrícula'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h2 class="mb-4"><i class="bi bi-clipboard-plus-fill"></i> Proceso de Matrícula - Paso 1: Seleccionar Curso</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill"></i> <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="alert alert-info">
        <i class="bi bi-info-circle-fill"></i> <strong>Instrucciones:</strong> Seleccione el curso en el cual desea matricular a un estudiante. Solo se muestran cursos activos con cupos disponibles.
    </div>

    <?php if($cursos->count() > 0): ?>
        <div class="row">
            <?php $__currentLoopData = $cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title" style="color: var(--vinotinto-oscuro);">
                                <i class="bi bi-book-fill"></i> <?php echo e($curso->nombre); ?>

                            </h5>
                            <hr>
                            <p class="mb-2">
                                <strong>Nivel:</strong> <?php echo e($curso->nivel); ?><br>
                                <strong>Año Académico:</strong> <?php echo e($curso->anio_academico); ?><br>
                                <strong>Sala:</strong> <?php echo e($curso->sala ?? 'N/A'); ?>

                            </p>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <small class="text-muted">Capacidad</small>
                                    <p class="mb-0"><strong><?php echo e($curso->capacidad_maxima); ?></strong></p>
                                </div>
                                <div>
                                    <small class="text-muted">Matriculados</small>
                                    <p class="mb-0"><strong><?php echo e($curso->estudiantes_matriculados); ?></strong></p>
                                </div>
                                <div>
                                    <small class="text-muted">Disponibles</small>
                                    <p class="mb-0">
                                        <span class="badge bg-success"><?php echo e($curso->cupos_disponibles); ?></span>
                                    </p>
                                </div>
                            </div>
                            
                            <?php if($curso->cupos_disponibles > 0): ?>
                                <a href="<?php echo e(route('matriculas.seleccionar', $curso->id)); ?>" 
                                   class="btn btn-primary w-100">
                                    <i class="bi bi-arrow-right-circle-fill"></i> Seleccionar Curso
                                </a>
                            <?php else: ?>
                                <button class="btn btn-secondary w-100" disabled>
                                    <i class="bi bi-x-circle-fill"></i> Sin Cupos
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox" style="font-size: 4rem; color: var(--gris-oscuro); opacity: 0.3;"></i>
                <p class="mt-3 text-muted">No hay cursos activos disponibles para matrícula.</p>
                <a href="<?php echo e(route('cursos.create')); ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Crear Curso
                </a>
            </div>
        </div>
    <?php endif; ?>

    <div class="mt-4">
        <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver al Dashboard
        </a>
        <a href="<?php echo e(route('matriculas.listar')); ?>" class="btn btn-info">
            <i class="bi bi-list-check"></i> Ver Todas las Matrículas
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vladb\Desktop\CICLO 3\aplicaciones de internet\TRABAJO FINAL\scholarium FINAL\resources\views/matriculas/index.blade.php ENDPATH**/ ?>