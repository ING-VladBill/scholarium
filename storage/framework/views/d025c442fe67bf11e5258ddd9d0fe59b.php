<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="hero-section">
    <div class="container">
        <h1 class="display-5"><i class="bi bi-speedometer2"></i> Dashboard</h1>
        <p class="lead">Bienvenido, <?php echo e(Auth::user()->name); ?></p>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="bi bi-person-circle" style="font-size: 5rem; color: var(--vinotinto-oscuro);"></i>
                    <h3 class="mt-4">¡Bienvenido a Scholarium!</h3>
                    <p class="lead">Has iniciado sesión correctamente.</p>
                    <p class="text-muted">Tu rol actual es: <strong><?php echo e(ucfirst(Auth::user()->role)); ?></strong></p>
                    
                    <hr class="my-4">
                    
                    <p>Este es tu panel de control personal. Aquí podrás acceder a las funcionalidades disponibles según tu rol en el sistema.</p>
                    
                    <div class="mt-4">
                        <a href="<?php echo e(route('home')); ?>" class="btn btn-primary">
                            <i class="bi bi-house-fill"></i> Volver al Inicio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vladb\Desktop\CICLO 3\aplicaciones de internet\TRABAJO FINAL\scholarium FINAL\resources\views/dashboard/index.blade.php ENDPATH**/ ?>