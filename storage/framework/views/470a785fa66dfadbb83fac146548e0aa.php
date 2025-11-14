<?php $__env->startSection('title', 'Detalle del Docente'); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0"><i class="bi bi-person-badge me-2"></i>Detalle del Docente</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="text-primary">Información Personal</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">DNI:</th>
                                    <td><?php echo e($docente->dni); ?></td>
                                </tr>
                                <tr>
                                    <th>Nombres:</th>
                                    <td><?php echo e($docente->nombres); ?></td>
                                </tr>
                                <tr>
                                    <th>Apellidos:</th>
                                    <td><?php echo e($docente->apellidos); ?></td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td><?php echo e($docente->email); ?></td>
                                </tr>
                                <tr>
                                    <th>Teléfono:</th>
                                    <td><?php echo e($docente->telefono ?? 'No registrado'); ?></td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <h5 class="text-primary">Información Laboral</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="50%">Especialidad:</th>
                                    <td><span class="badge bg-info"><?php echo e($docente->especialidad); ?></span></td>
                                </tr>
                                <tr>
                                    <th>Fecha de Contratación:</th>
                                    <td><?php echo e($docente->fecha_contratacion->format('d/m/Y')); ?></td>
                                </tr>
                                <tr>
                                    <th>Estado:</th>
                                    <td>
                                        <span class="badge <?php echo e($docente->estado == 'Activo' ? 'bg-success' : 'bg-secondary'); ?>">
                                            <?php echo e($docente->estado); ?>

                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <div class="mt-4">
                        <h5 class="text-primary mb-3">
                            <i class="bi bi-calendar-check me-2"></i>Asignaciones Actuales
                        </h5>
                        
                        <?php if($docente->asignaciones->count() > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Curso</th>
                                            <th>Asignatura</th>
                                            <th>Día</th>
                                            <th>Horario</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $docente->asignaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asignacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($asignacion->curso->nombre); ?></td>
                                            <td><?php echo e($asignacion->asignatura->nombre); ?></td>
                                            <td><?php echo e($asignacion->dia_semana); ?></td>
                                            <td><?php echo e($asignacion->hora_inicio); ?> - <?php echo e($asignacion->hora_fin); ?></td>
                                            <td>
                                                <span class="badge <?php echo e($asignacion->estado == 'Activo' ? 'bg-success' : 'bg-secondary'); ?>">
                                                    <?php echo e($asignacion->estado); ?>

                                                </span>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i>
                                Este docente no tiene asignaciones registradas.
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?php echo e(route('docentes.index')); ?>" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Volver
                        </a>
                        <a href="<?php echo e(route('docentes.edit', $docente)); ?>" class="btn btn-warning">
                            <i class="bi bi-pencil me-2"></i>Editar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vladb\Desktop\CICLO 3\aplicaciones de internet\TRABAJO FINAL\scholarium FINAL\resources\views/docentes/show.blade.php ENDPATH**/ ?>