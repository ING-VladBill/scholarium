<?php

// ============================================
// RUTAS PARA PERFIL DE PROFESOR
// ============================================
// Agregar estas rutas al archivo routes/web.php
// dentro del grupo de middleware 'auth'

use App\Http\Controllers\ProfesorPerfilController;

// Perfil del profesor
Route::middleware(['auth'])->group(function () {
    Route::get('/profesor/perfil', [ProfesorPerfilController::class, 'index'])->name('profesor.perfil');
    Route::put('/profesor/perfil/actualizar-datos', [ProfesorPerfilController::class, 'actualizarDatos'])->name('profesor.perfil.actualizar-datos');
    Route::put('/profesor/perfil/actualizar-password', [ProfesorPerfilController::class, 'actualizarPassword'])->name('profesor.perfil.actualizar-password');
});
