<?php $__env->startSection('title', 'Seleccionar Docente'); ?>
<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <h2 class="text-primary mb-4">Paso 3: Asignar Docente y Horario</h2>
    <div class="alert alert-info">
        <strong>Curso:</strong> <?php echo e($curso->nombre); ?> | <strong>Asignatura:</strong> <?php echo e($asignatura->nombre); ?>

    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="<?php echo e(route('asignaciones.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="curso_id" value="<?php echo e($curso->id); ?>">
                <input type="hidden" name="asignatura_id" value="<?php echo e($asignatura->id); ?>">
                <input type="hidden" name="estado" value="Activo">
                
                <div class="mb-3">
                    <label class="form-label">Docente *</label>
                    <select name="docente_id" class="form-select" required>
                        <option value="">Seleccione...</option>
                        <?php $__currentLoopData = $docentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $docente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($docente->id); ?>"><?php echo e($docente->nombre_completo); ?> (<?php echo e($docente->especialidad); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Día *</label>
                        <select name="dia_semana" class="form-select" required>
                            <option value="Lunes">Lunes</option>
                            <option value="Martes">Martes</option>
                            <option value="Miércoles">Miércoles</option>
                            <option value="Jueves">Jueves</option>
                            <option value="Viernes">Viernes</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Hora Inicio *</label>
                        <input type="time" name="hora_inicio" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Hora Fin *</label>
                        <input type="time" name="hora_fin" class="form-control" required>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="<?php echo e(route('asignaciones.index')); ?>" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">Crear Asignación</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vladb\Desktop\CICLO 3\aplicaciones de internet\TRABAJO FINAL\scholarium FINAL\resources\views/asignaciones/seleccionar-docente.blade.php ENDPATH**/ ?>