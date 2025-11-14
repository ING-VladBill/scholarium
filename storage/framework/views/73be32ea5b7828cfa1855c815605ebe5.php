<?php $__env->startSection('title', 'Detalle del Curso'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-book-fill"></i> Detalle del Curso</h2>
        <div>
            <a href="<?php echo e(route('cursos.edit', $curso)); ?>" class="btn btn-warning">
                <i class="bi bi-pencil-fill"></i> Editar
            </a>
            <a href="<?php echo e(route('cursos.index')); ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-info-circle-fill"></i> Información del Curso</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Nombre:</strong>
                            <p class="h4"><?php echo e($curso->nombre); ?></p>
                        </div>
                        <div class="col-md-6">
                            <strong>Estado:</strong>
                            <p>
                                <span class="badge <?php echo e($curso->estado == 'Activo' ? 'badge-activo' : 'badge-inactivo'); ?>">
                                    <?php echo e($curso->estado); ?>

                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Nivel:</strong>
                            <p><?php echo e($curso->nivel); ?></p>
                        </div>
                        <div class="col-md-4">
                            <strong>Grado:</strong>
                            <p><?php echo e($curso->grado); ?>°</p>
                        </div>
                        <div class="col-md-4">
                            <strong>Sección:</strong>
                            <p><?php echo e($curso->seccion); ?></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Año Académico:</strong>
                            <p><?php echo e($curso->anio_academico); ?></p>
                        </div>
                        <div class="col-md-6">
                            <strong>Sala:</strong>
                            <p><?php echo e($curso->sala ?? 'No asignada'); ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <strong>Capacidad Máxima:</strong>
                            <p><?php echo e($curso->capacidad_maxima); ?> estudiantes</p>
                        </div>
                        <div class="col-md-4">
                            <strong>Estudiantes Matriculados:</strong>
                            <p><?php echo e($curso->estudiantes_matriculados); ?> estudiantes</p>
                        </div>
                        <div class="col-md-4">
                            <strong>Cupos Disponibles:</strong>
                            <p>
                                <span class="badge bg-info">
                                    <?php echo e($curso->cupos_disponibles); ?> cupos
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-people-fill"></i> Estudiantes Matriculados</h5>
                </div>
                <div class="card-body">
                    <?php if($curso->matriculas->count() > 0): ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>RUT</th>
                                        <th>Nombre Completo</th>
                                        <th>Fecha Matrícula</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $curso->matriculas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $matricula): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($matricula->estudiante->rut); ?></td>
                                            <td><?php echo e($matricula->estudiante->nombre_completo); ?></td>
                                            <td><?php echo e($matricula->fecha_matricula->format('d/m/Y')); ?></td>
                                            <td>
                                                <span class="badge <?php echo e($matricula->estado == 'Matriculado' ? 'badge-activo' : 'badge-inactivo'); ?>">
                                                    <?php echo e($matricula->estado); ?>

                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted text-center py-3">
                            <i class="bi bi-inbox"></i> Este curso no tiene estudiantes matriculados.
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-gear-fill"></i> Acciones</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="<?php echo e(route('cursos.edit', $curso)); ?>" class="btn btn-warning">
                            <i class="bi bi-pencil-fill"></i> Editar Curso
                        </a>
                        <form action="<?php echo e(route('cursos.destroy', $curso)); ?>" 
                              method="POST" 
                              onsubmit="return confirm('¿Está seguro de eliminar este curso? Esta acción no se puede deshacer.');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bi bi-trash-fill"></i> Eliminar Curso
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h6 class="mb-3">Información del Registro</h6>
                    <small class="text-muted">
                        <strong>Creado:</strong><br>
                        <?php echo e($curso->created_at->format('d/m/Y H:i')); ?><br><br>
                        <strong>Última actualización:</strong><br>
                        <?php echo e($curso->updated_at->format('d/m/Y H:i')); ?>

                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vladb\Desktop\CICLO 3\aplicaciones de internet\TRABAJO FINAL\scholarium FINAL\resources\views/cursos/show.blade.php ENDPATH**/ ?>