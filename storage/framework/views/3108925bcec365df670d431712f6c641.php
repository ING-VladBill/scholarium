<?php $__env->startSection('title', 'Listado de Matrículas'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-list-check"></i> Listado de Matrículas</h2>
        <a href="<?php echo e(route('matriculas.index')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nueva Matrícula
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <?php if($matriculas->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Estudiante</th>
                                <th>DNI</th>
                                <th>Curso</th>
                                <th>Fecha Matrícula</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $matriculas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $matricula): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($matricula->id); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('estudiantes.show', $matricula->estudiante)); ?>" 
                                           class="text-decoration-none">
                                            <strong><?php echo e($matricula->estudiante->nombre_completo); ?></strong>
                                        </a>
                                    </td>
                                    <td><?php echo e($matricula->estudiante->dni); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('cursos.show', $matricula->curso)); ?>" 
                                           class="text-decoration-none">
                                            <?php echo e($matricula->curso->nombre); ?>

                                        </a>
                                    </td>
                                    <td><?php echo e(\Carbon\Carbon::parse($matricula->fecha_matricula)->format('d/m/Y')); ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo e($matricula->estado == 'Matriculado' ? 'success' : 'secondary'); ?>">
                                            <?php echo e($matricula->estado); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('matriculas.show', $matricula->id)); ?>" class="btn btn-sm btn-info" title="Ver Detalle">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="<?php echo e(route('matriculas.edit', $matricula->id)); ?>" class="btn btn-sm btn-warning" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="<?php echo e(route('matriculas.destroy', $matricula->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar esta matrícula?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="d-flex justify-content-center mt-4">
                    <?php echo e($matriculas->links()); ?>

                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 4rem; color: var(--gris-oscuro); opacity: 0.3;"></i>
                    <p class="mt-3 text-muted">No hay matrículas registradas en el sistema.</p>
                    <a href="<?php echo e(route('matriculas.index')); ?>" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Crear Primera Matrícula
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="mt-3">
        <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver al Dashboard
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vladb\Desktop\CICLO 3\aplicaciones de internet\TRABAJO FINAL\scholarium FINAL\resources\views/matriculas/listar.blade.php ENDPATH**/ ?>