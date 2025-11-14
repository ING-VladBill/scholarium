<?php $__env->startSection('title', 'Detalle del Estudiante'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-person-fill"></i> Detalle del Estudiante</h2>
        <div>
            <a href="<?php echo e(route('estudiantes.edit', $estudiante)); ?>" class="btn btn-warning">
                <i class="bi bi-pencil-fill"></i> Editar
            </a>
            <a href="<?php echo e(route('estudiantes.index')); ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-info-circle-fill"></i> Información Personal</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>DNI:</strong>
                            <p><?php echo e($estudiante->dni); ?></p>
                        </div>
                        <div class="col-md-6">
                            <strong>Nombre Completo:</strong>
                            <p><?php echo e($estudiante->nombre_completo); ?></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Fecha de Nacimiento:</strong>
                            <p><?php echo e($estudiante->fecha_nacimiento->format('d/m/Y')); ?></p>
                        </div>
                        <div class="col-md-6">
                            <strong>Género:</strong>
                            <p><?php echo e($estudiante->genero); ?></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Email:</strong>
                            <p><?php echo e($estudiante->email ?? 'No registrado'); ?></p>
                        </div>
                        <div class="col-md-6">
                            <strong>Teléfono:</strong>
                            <p><?php echo e($estudiante->telefono ?? 'No registrado'); ?></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <strong>Dirección:</strong>
                            <p><?php echo e($estudiante->direccion ?? 'No registrada'); ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Fecha de Ingreso:</strong>
                            <p><?php echo e($estudiante->fecha_ingreso->format('d/m/Y')); ?></p>
                        </div>
                        <div class="col-md-6">
                            <strong>Estado:</strong>
                            <p>
                                <span class="badge <?php echo e($estudiante->estado == 'Activo' ? 'badge-activo' : 'badge-inactivo'); ?>">
                                    <?php echo e($estudiante->estado); ?>

                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-clipboard-check-fill"></i> Matrículas</h5>
                </div>
                <div class="card-body">
                    <?php if($estudiante->matriculas->count() > 0): ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Curso</th>
                                        <th>Fecha Matrícula</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $estudiante->matriculas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $matricula): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($matricula->curso->nombre); ?></td>
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
                            <i class="bi bi-inbox"></i> Este estudiante no tiene matrículas registradas.
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
                        <a href="<?php echo e(route('estudiantes.edit', $estudiante)); ?>" class="btn btn-warning">
                            <i class="bi bi-pencil-fill"></i> Editar Estudiante
                        </a>
                        <form action="<?php echo e(route('estudiantes.destroy', $estudiante)); ?>" 
                              method="POST" 
                              onsubmit="return confirm('¿Está seguro de eliminar este estudiante? Esta acción no se puede deshacer.');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bi bi-trash-fill"></i> Eliminar Estudiante
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
                        <?php echo e($estudiante->created_at->format('d/m/Y H:i')); ?><br><br>
                        <strong>Última actualización:</strong><br>
                        <?php echo e($estudiante->updated_at->format('d/m/Y H:i')); ?>

                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vladb\Desktop\CICLO 3\aplicaciones de internet\TRABAJO FINAL\scholarium FINAL\resources\views/estudiantes/show.blade.php ENDPATH**/ ?>