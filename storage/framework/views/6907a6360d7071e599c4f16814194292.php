<?php $__env->startSection('title', 'Gestión de Docentes'); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="text-primary"><i class="bi bi-person-badge me-2"></i>Gestión de Docentes</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="<?php echo e(route('docentes.create')); ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Nuevo Docente
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
            <form action="<?php echo e(route('docentes.index')); ?>" method="GET" class="row g-3 mb-4">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por DNI, nombre, email o especialidad..." value="<?php echo e(request('search')); ?>">
                </div>
                <div class="col-md-3">
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
                    <a href="<?php echo e(route('docentes.index')); ?>" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-1"></i>Limpiar
                    </a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>DNI</th>
                            <th>Nombre Completo</th>
                            <th>Email</th>
                            <th>Especialidad</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $docentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $docente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($docente->dni); ?></td>
                            <td><?php echo e($docente->nombre_completo); ?></td>
                            <td><?php echo e($docente->email); ?></td>
                            <td><span class="badge bg-info"><?php echo e($docente->especialidad); ?></span></td>
                            <td>
                                <span class="badge <?php echo e($docente->estado == 'Activo' ? 'bg-success' : 'bg-secondary'); ?>">
                                    <?php echo e($docente->estado); ?>

                                </span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('docentes.show', $docente)); ?>" class="btn btn-sm btn-info" title="Ver">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?php echo e(route('docentes.edit', $docente)); ?>" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="<?php echo e(route('docentes.destroy', $docente)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar" 
                                            onclick="return confirm('¿Estás seguro de eliminar este docente?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                No se encontraron docentes
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <?php echo e($docentes->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vladb\Desktop\CICLO 3\aplicaciones de internet\TRABAJO FINAL\scholarium FINAL\resources\views/docentes/index.blade.php ENDPATH**/ ?>