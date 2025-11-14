<?php $__env->startSection('title', 'Inicio'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<div class="hero-section">
    <div class="container text-center">
        <h1 class="display-4"><i class="bi bi-mortarboard-fill"></i> Bienvenido a Scholarium</h1>
        <p class="lead">Plataforma de Gestión Académica del Colegio Santa María de Jesús</p>
        <p>Excelencia educativa, formación integral y tecnología al servicio del aprendizaje</p>
        <div class="mt-4">
            <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('login')); ?>" class="btn btn-secondary btn-lg me-2">
                    <i class="bi bi-box-arrow-in-right"></i> Ingresar al Sistema
                </a>
                <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-light btn-lg">
                    <i class="bi bi-person-plus"></i> Registrarse
                </a>
            <?php else: ?>
                <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-secondary btn-lg">
                    <i class="bi bi-speedometer2"></i> Ir al Dashboard
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="container">
    <!-- Mensajes de sesión -->
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Sección de Características -->
    <div class="row mb-5">
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="bi bi-people-fill" style="font-size: 3rem; color: var(--vinotinto-oscuro);"></i>
                    </div>
                    <h5 class="card-title">Gestión de Estudiantes</h5>
                    <p class="card-text">Sistema completo para administrar la información de los estudiantes del colegio, con fichas detalladas y seguimiento académico.</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="bi bi-book-fill" style="font-size: 3rem; color: var(--vinotinto-oscuro);"></i>
                    </div>
                    <h5 class="card-title">Gestión de Cursos</h5>
                    <p class="card-text">Organización eficiente de cursos, niveles y secciones con control de capacidad y asignación de recursos.</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="bi bi-clipboard-check-fill" style="font-size: 3rem; color: var(--vinotinto-oscuro);"></i>
                    </div>
                    <h5 class="card-title">Proceso de Matrícula</h5>
                    <p class="card-text">Flujo digitalizado de matrícula que facilita la inscripción de estudiantes en los cursos disponibles.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de Valores -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="text-center mb-4" style="color: var(--vinotinto-oscuro);">Nuestros Valores</h2>
        </div>
        <div class="col-md-3 text-center mb-4">
            <i class="bi bi-star-fill" style="font-size: 2.5rem; color: var(--dorado);"></i>
            <h5 class="mt-3">Excelencia</h5>
            <p>Compromiso con la calidad educativa</p>
        </div>
        <div class="col-md-3 text-center mb-4">
            <i class="bi bi-heart-fill" style="font-size: 2.5rem; color: var(--dorado);"></i>
            <h5 class="mt-3">Respeto</h5>
            <p>Valoramos la diversidad y dignidad</p>
        </div>
        <div class="col-md-3 text-center mb-4">
            <i class="bi bi-lightbulb-fill" style="font-size: 2.5rem; color: var(--dorado);"></i>
            <h5 class="mt-3">Innovación</h5>
            <p>Tecnología al servicio del aprendizaje</p>
        </div>
        <div class="col-md-3 text-center mb-4">
            <i class="bi bi-shield-fill-check" style="font-size: 2.5rem; color: var(--dorado);"></i>
            <h5 class="mt-3">Integridad</h5>
            <p>Formación ética y responsable</p>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card" style="background: linear-gradient(135deg, var(--vinotinto-oscuro) 0%, var(--vinotinto-medio) 100%); color: white;">
                <div class="card-body text-center py-5">
                    <h3>¿Listo para comenzar?</h3>
                    <p class="lead">Únete a nuestra comunidad educativa y descubre todas las funcionalidades de Scholarium</p>
                    <?php if(auth()->guard()->guest()): ?>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-secondary btn-lg mt-3">
                            <i class="bi bi-person-plus"></i> Crear una Cuenta
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-secondary btn-lg mt-3">
                            <i class="bi bi-speedometer2"></i> Acceder al Dashboard
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ubuntu/scholarium/resources/views/pages/home.blade.php ENDPATH**/ ?>