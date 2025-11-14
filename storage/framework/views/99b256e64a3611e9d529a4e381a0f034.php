<?php $__env->startSection('title', 'Ver Mensaje'); ?>
<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-envelope-open me-2"></i>Mensaje de Contacto</h2>
        <a href="<?php echo e(route('contactos.index')); ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><?php echo e($contacto->asunto); ?></h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong><i class="bi bi-person"></i> Nombre:</strong> <?php echo e($contacto->nombre); ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong><i class="bi bi-envelope"></i> Email:</strong> <a href="mailto:<?php echo e($contacto->email); ?>"><?php echo e($contacto->email); ?></a></p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong><i class="bi bi-calendar"></i> Fecha:</strong> <?php echo e($contacto->created_at->format('d/m/Y H:i')); ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong><i class="bi bi-check-circle"></i> Estado:</strong>
                        <?php if($contacto->leido): ?>
                        <span class="badge bg-secondary">Leído</span>
                        <?php else: ?>
                        <span class="badge bg-primary">Nuevo</span>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
            <hr>
            <div class="mb-3">
                <strong><i class="bi bi-chat-left-text"></i> Mensaje:</strong>
                <div class="mt-2 p-3 bg-light rounded">
                    <?php echo e($contacto->mensaje); ?>

                </div>
            </div>
        </div>
        <div class="card-footer">
            <form action="<?php echo e(route('contactos.destroy', $contacto->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este mensaje?')">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash"></i> Eliminar
                </button>
            </form>
            <a href="mailto:<?php echo e($contacto->email); ?>?subject=Re: <?php echo e($contacto->asunto); ?>" class="btn btn-success">
                <i class="bi bi-reply"></i> Responder por Email
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vladb\Desktop\CICLO 3\aplicaciones de internet\TRABAJO FINAL\scholarium FINAL\resources\views/contactos/show.blade.php ENDPATH**/ ?>