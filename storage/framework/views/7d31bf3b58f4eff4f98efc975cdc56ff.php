<?php $__env->startSection('title', 'Detalle de Matrícula'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-dorado">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-file-text"></i> Detalle de Matrícula</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="text-primary"><i class="bi bi-person-circle"></i> Información del Estudiante</h5>
                            <hr>
                            <p><strong>DNI:</strong> <?php echo e($matricula->estudiante->dni); ?></p>
                            <p><strong>Nombres:</strong> <?php echo e($matricula->estudiante->nombres); ?></p>
                            <p><strong>Apellidos:</strong> <?php echo e($matricula->estudiante->apellidos); ?></p>
                            <p><strong>Edad:</strong> <?php echo e(\Carbon\Carbon::parse($matricula->estudiante->fecha_nacimiento)->age); ?> años</p>
                            <p><strong>Email:</strong> <?php echo e($matricula->estudiante->email); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-primary"><i class="bi bi-book"></i> Información del Curso</h5>
                            <hr>
                            <p><strong>Curso:</strong> <?php echo e($matricula->curso->nombre); ?></p>
                            <p><strong>Nivel:</strong> <?php echo e($matricula->curso->nivel); ?></p>
                            <p><strong>Grado:</strong> <?php echo e($matricula->curso->grado); ?></p>
                            <p><strong>Sección:</strong> <?php echo e($matricula->curso->seccion); ?></p>
                            <p><strong>Año Académico:</strong> <?php echo e($matricula->curso->anio_academico); ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-primary"><i class="bi bi-calendar-check"></i> Información de la Matrícula</h5>
                            <hr>
                            <p><strong>Fecha de Matrícula:</strong> <?php echo e(\Carbon\Carbon::parse($matricula->fecha_matricula)->format('d/m/Y')); ?></p>
                            <p><strong>Estado:</strong> 
                                <span class="badge bg-<?php echo e($matricula->estado == 'Matriculado' ? 'success' : 'secondary'); ?>">
                                    <?php echo e($matricula->estado); ?>

                                </span>
                            </p>
                            <?php if($matricula->observaciones): ?>
                            <p><strong>Observaciones:</strong> <?php echo e($matricula->observaciones); ?></p>
                            <?php endif; ?>
                            <p><strong>Registrada el:</strong> <?php echo e($matricula->created_at->format('d/m/Y H:i')); ?></p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="<?php echo e(route('matriculas.listar')); ?>" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Volver al Listado
                        </a>
                        <a href="<?php echo e(route('matriculas.edit', $matricula->id)); ?>" class="btn btn-dorado">
                            <i class="bi bi-pencil"></i> Editar Matrícula
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vladb\Desktop\CICLO 3\aplicaciones de internet\TRABAJO FINAL\scholarium FINAL\resources\views/matriculas/show.blade.php ENDPATH**/ ?>