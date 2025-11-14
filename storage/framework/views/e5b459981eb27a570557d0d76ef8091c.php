<?php $__env->startSection('title', 'Gestión de Asignaturas'); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="text-primary"><i class="bi bi-book me-2"></i>Gestión de Asignaturas</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="<?php echo e(route('asignaturas.create')); ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Nueva Asignatura
            </a>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="<?php echo e(route('asignaturas.index')); ?>" method="GET" class="row g-3 mb-4">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por código o nombre..." value="<?php echo e(request('search')); ?>">
                </div>
                <div class="col-md-2">
                    <select name="nivel" class="form-select">
                        <option value="">Todos los niveles</option>
                        <option value="Básica" <?php echo e(request('nivel') == 'Básica' ? 'selected' : ''); ?>>Básica</option>
                        <option value="Media" <?php echo e(request('nivel') == 'Media' ? 'selected' : ''); ?>>Media</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="estado" class="form-select">
                        <option value="">Todos los estados</option>
                        <option value="Activo" <?php echo e(request('estado') == 'Activo' ? 'selected' : ''); ?>>Activo</option>
                        <option value="Inactivo" <?php echo e(request('estado') == 'Inactivo' ? 'selected' : ''); ?>>Inactivo</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-search me-1"></i>Buscar
                    </button>
                    <a href="<?php echo e(route('asignaturas.index')); ?>" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-1"></i>Limpiar
                    </a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Nivel</th>
                            <th>Horas/Semana</th>
                            <th>Créditos</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $asignaturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asignatura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><span class="badge bg-secondary"><?php echo e($asignatura->codigo); ?></span></td>
                            <td><?php echo e($asignatura->nombre); ?></td>
                            <td><span class="badge <?php echo e($asignatura->nivel == 'Básica' ? 'bg-info' : 'bg-warning'); ?>"><?php echo e($asignatura->nivel); ?></span></td>
                            <td><?php echo e($asignatura->horas_semanales); ?></td>
                            <td><?php echo e($asignatura->creditos); ?></td>
                            <td>
                                <span class="badge <?php echo e($asignatura->estado == 'Activo' ? 'bg-success' : 'bg-secondary'); ?>">
                                    <?php echo e($asignatura->estado); ?>

                                </span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('asignaturas.show', $asignatura)); ?>" class="btn btn-sm btn-info" title="Ver">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?php echo e(route('asignaturas.edit', $asignatura)); ?>" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="<?php echo e(route('asignaturas.destroy', $asignatura)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar" 
                                            onclick="return confirm('¿Estás seguro de eliminar esta asignatura?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                No se encontraron asignaturas
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <?php echo e($asignaturas->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vladb\Desktop\CICLO 3\aplicaciones de internet\TRABAJO FINAL\scholarium FINAL\resources\views/asignaturas/index.blade.php ENDPATH**/ ?>