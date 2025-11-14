<?php $__env->startSection('title', 'Listado de Asignaciones'); ?>
<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <h2 class="text-primary mb-4"><i class="bi bi-list-check me-2"></i>Asignaciones Activas</h2>
    
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Curso</th>
                        <th>Asignatura</th>
                        <th>Docente</th>
                        <th>Horario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $asignaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asignacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($asignacion->curso->nombre); ?></td>
                        <td><?php echo e($asignacion->asignatura->nombre); ?></td>
                        <td><?php echo e($asignacion->docente->nombre_completo); ?></td>
                        <td><?php echo e($asignacion->dia_semana); ?> <?php echo e($asignacion->hora_inicio); ?>-<?php echo e($asignacion->hora_fin); ?></td>
                        <td>
                            <a href="<?php echo e(route('asignaciones.show', $asignacion->id)); ?>" class="btn btn-sm btn-info" title="Ver Detalle">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="<?php echo e(route('asignaciones.edit', $asignacion->id)); ?>" class="btn btn-sm btn-warning" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="<?php echo e(route('asignaciones.destroy', $asignacion->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar esta asignación?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5" class="text-center text-muted">No hay asignaciones</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php echo e($asignaciones->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vladb\Desktop\CICLO 3\aplicaciones de internet\TRABAJO FINAL\scholarium FINAL\resources\views/asignaciones/listar.blade.php ENDPATH**/ ?>