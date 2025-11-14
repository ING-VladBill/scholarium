<?php $__env->startSection('title', 'Seleccionar Estudiante'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h2 class="mb-4"><i class="bi bi-clipboard-plus-fill"></i> Proceso de Matrícula - Paso 2: Seleccionar Estudiante</h2>

    <!-- Información del Curso Seleccionado -->
    <div class="card mb-4" style="border-left: 4px solid var(--vinotinto-oscuro);">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="mb-2" style="color: var(--vinotinto-oscuro);">
                        <i class="bi bi-book-fill"></i> <?php echo e($curso->nombre); ?>

                    </h4>
                    <p class="mb-0">
                        <strong>Nivel:</strong> <?php echo e($curso->nivel); ?> | 
                        <strong>Año:</strong> <?php echo e($curso->anio_academico); ?> | 
                        <strong>Sala:</strong> <?php echo e($curso->sala ?? 'N/A'); ?>

                    </p>
                </div>
                <div class="col-md-4 text-end">
                    <p class="mb-1"><strong>Cupos Disponibles:</strong></p>
                    <span class="badge bg-success" style="font-size: 1.2rem;">
                        <?php echo e($curso->cupos_disponibles); ?> de <?php echo e($curso->capacidad_maxima); ?>

                    </span>
                </div>
            </div>
        </div>
    </div>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill"></i> <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="alert alert-info">
        <i class="bi bi-info-circle-fill"></i> <strong>Instrucciones:</strong> Seleccione el estudiante que desea matricular en este curso. Solo se muestran estudiantes activos.
    </div>

    <?php if($estudiantes->count() > 0): ?>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-people-fill"></i> Estudiantes Disponibles</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>RUT</th>
                                <th>Nombre Completo</th>
                                <th>Fecha Nacimiento</th>
                                <th>Email</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $estudiantes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estudiante): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($estudiante->rut); ?></td>
                                    <td><strong><?php echo e($estudiante->nombre_completo); ?></strong></td>
                                    <td><?php echo e($estudiante->fecha_nacimiento->format('d/m/Y')); ?></td>
                                    <td><?php echo e($estudiante->email ?? 'N/A'); ?></td>
                                    <td>
                                        <form action="<?php echo e(route('matriculas.store')); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="curso_id" value="<?php echo e($curso->id); ?>">
                                            <input type="hidden" name="estudiante_id" value="<?php echo e($estudiante->id); ?>">
                                            <input type="hidden" name="fecha_matricula" value="<?php echo e(date('Y-m-d')); ?>">
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                    onclick="return confirm('¿Confirma la matrícula de <?php echo e($estudiante->nombre_completo); ?> en <?php echo e($curso->nombre); ?>?');">
                                                <i class="bi bi-check-circle-fill"></i> Matricular
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox" style="font-size: 4rem; color: var(--gris-oscuro); opacity: 0.3;"></i>
                <p class="mt-3 text-muted">No hay estudiantes activos disponibles para matricular.</p>
                <a href="<?php echo e(route('estudiantes.create')); ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Crear Estudiante
                </a>
            </div>
        </div>
    <?php endif; ?>

    <div class="mt-4">
        <a href="<?php echo e(route('matriculas.index')); ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver a Selección de Curso
        </a>
    </div>

    <div class="alert alert-warning mt-4">
        <i class="bi bi-info-circle-fill"></i> <strong>Nota para Entrega 1:</strong> Este flujo está parcialmente implementado. En la Entrega Final se agregará una página de confirmación con más detalles antes de completar la matrícula.
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vladb\Desktop\CICLO 3\aplicaciones de internet\TRABAJO FINAL\scholarium FINAL\resources\views/matriculas/seleccionar-estudiante.blade.php ENDPATH**/ ?>