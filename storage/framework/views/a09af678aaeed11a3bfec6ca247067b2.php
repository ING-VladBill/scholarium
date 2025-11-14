<?php $__env->startSection('title', 'Mensajes de Contacto'); ?>
<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-envelope-fill me-2"></i>Mensajes de Contacto</h2>
        <?php if($noLeidos > 0): ?>
        <span class="badge bg-danger fs-5"><?php echo e($noLeidos); ?> sin leer</span>
        <?php endif; ?>
    </div>
    <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle-fill"></i> <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre, email o asunto..." value="<?php echo e(request('buscar')); ?>">
                </div>
                <div class="col-md-4">
                    <select name="estado" class="form-select">
                        <option value="">Todos los mensajes</option>
                        <option value="no_leidos" <?php echo e(request('estado') == 'no_leidos' ? 'selected' : ''); ?>>No leídos</option>
                        <option value="leidos" <?php echo e(request('estado') == 'leidos' ? 'selected' : ''); ?>>Leídos</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Buscar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <?php if($contactos->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Asunto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $contactos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contacto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="<?php echo e(!$contacto->leido ? 'table-warning' : ''); ?>">
                            <td>
                                <?php if($contacto->leido): ?>
                                <span class="badge bg-secondary"><i class="bi bi-envelope-open"></i> Leído</span>
                                <?php else: ?>
                                <span class="badge bg-primary"><i class="bi bi-envelope"></i> Nuevo</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($contacto->created_at->format('d/m/Y H:i')); ?></td>
                            <td><?php echo e($contacto->nombre); ?></td>
                            <td><?php echo e($contacto->email); ?></td>
                            <td><?php echo e(Str::limit($contacto->asunto, 40)); ?></td>
                            <td>
                                <a href="<?php echo e(route('contactos.show', $contacto->id)); ?>" class="btn btn-sm btn-info" title="Ver mensaje">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="<?php echo e(route('contactos.destroy', $contacto->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este mensaje?')">
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
            <div class="mt-3">
                <?php echo e($contactos->links()); ?>

            </div>
            <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 4rem; color: #ccc;"></i>
                <p class="text-muted mt-3">No hay mensajes de contacto.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vladb\Desktop\CICLO 3\aplicaciones de internet\TRABAJO FINAL\scholarium FINAL\resources\views/contactos/index.blade.php ENDPATH**/ ?>