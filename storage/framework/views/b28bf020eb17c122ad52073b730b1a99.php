<?php $__env->startSection('title', 'Gestión de Estudiantes'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-people-fill"></i> Gestión de Estudiantes</h2>
        <a href="<?php echo e(route('estudiantes.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nuevo Estudiante
        </a>
    </div>

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

    <!-- Filtros y Búsqueda -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="<?php echo e(route('estudiantes.index')); ?>" method="GET" class="row g-3">
                <div class="col-md-6">
                    <label for="search" class="form-label">Buscar</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="<?php echo e(request('search')); ?>" 
                           placeholder="DNI, nombre, apellido o email">
                </div>
                <div class="col-md-4">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-select" id="estado" name="estado">
                        <option value="">Todos</option>
                        <option value="Activo" <?php echo e(request('estado') == 'Activo' ? 'selected' : ''); ?>>Activo</option>
                        <option value="Inactivo" <?php echo e(request('estado') == 'Inactivo' ? 'selected' : ''); ?>>Inactivo</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Buscar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla de Estudiantes -->
    <div class="card">
        <div class="card-body">
            <?php if($estudiantes->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>DNI</th>
                                <th>Nombre Completo</th>
                                <th>Email</th>
                                <th>Fecha Nacimiento</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $estudiantes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estudiante): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($estudiante->dni); ?></td>
                                    <td><?php echo e($estudiante->nombre_completo); ?></td>
                                    <td><?php echo e($estudiante->email ?? 'N/A'); ?></td>
                                    <td><?php echo e($estudiante->fecha_nacimiento->format('d/m/Y')); ?></td>
                                    <td>
                                        <span class="badge <?php echo e($estudiante->estado == 'Activo' ? 'badge-activo' : 'badge-inactivo'); ?>">
                                            <?php echo e($estudiante->estado); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo e(route('estudiantes.show', $estudiante)); ?>" 
                                               class="btn btn-sm btn-info" title="Ver">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                            <a href="<?php echo e(route('estudiantes.edit', $estudiante)); ?>" 
                                               class="btn btn-sm btn-warning" title="Editar">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <form action="<?php echo e(route('estudiantes.destroy', $estudiante)); ?>" 
                                                  method="POST" 
                                                  onsubmit="return confirm('¿Está seguro de eliminar este estudiante?');"
                                                  class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="d-flex justify-content-center mt-4">
                    <?php echo e($estudiantes->links()); ?>

                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 4rem; color: var(--gris-oscuro); opacity: 0.3;"></i>
                    <p class="mt-3 text-muted">No se encontraron estudiantes.</p>
                    <a href="<?php echo e(route('estudiantes.create')); ?>" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Crear Primer Estudiante
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vladb\Desktop\CICLO 3\aplicaciones de internet\TRABAJO FINAL\scholarium FINAL\resources\views/estudiantes/index.blade.php ENDPATH**/ ?>