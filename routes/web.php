<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\ContactoController;

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/

// Página principal
Route::get('/', [PageController::class, 'home'])->name('home');

// Páginas informativas
Route::get('/nosotros', [PageController::class, 'nosotros'])->name('nosotros');
Route::get('/contacto', [PageController::class, 'contacto'])->name('contacto');
Route::post('/contacto', [PageController::class, 'enviarContacto'])->name('contacto.enviar');

/*
|--------------------------------------------------------------------------
| Rutas de Autenticación
|--------------------------------------------------------------------------
*/

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Registro
Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Rutas Protegidas (Requieren autenticación)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    
    /*
    |--------------------------------------------------------------------------
    | Rutas de Administrador
    |--------------------------------------------------------------------------
    */
    
    Route::middleware(['admin'])->group(function () {
        
        // CRUD de Estudiantes
        Route::resource('estudiantes', EstudianteController::class);
        
        // CRUD de Cursos
        Route::resource('cursos', CursoController::class);
        
        // CRUD de Docentes
        Route::resource('docentes', DocenteController::class);
        
        // CRUD de Asignaturas
        Route::resource('asignaturas', AsignaturaController::class);
        
        // Flujo de Matrícula (Flujo Principal)
        Route::get('/matriculas', [MatriculaController::class, 'index'])->name('matriculas.index');
        Route::get('/matriculas/curso/{curso}', [MatriculaController::class, 'seleccionarEstudiante'])->name('matriculas.seleccionar');
        Route::post('/matriculas', [MatriculaController::class, 'store'])->name('matriculas.store');
        Route::get('/matriculas/listar', [MatriculaController::class, 'listar'])->name('matriculas.listar');
        Route::get('/matriculas/{id}', [MatriculaController::class, 'show'])->name('matriculas.show');
        Route::get('/matriculas/{id}/edit', [MatriculaController::class, 'edit'])->name('matriculas.edit');
        Route::put('/matriculas/{id}', [MatriculaController::class, 'update'])->name('matriculas.update');
        Route::delete('/matriculas/{id}', [MatriculaController::class, 'destroy'])->name('matriculas.destroy');
        
        // Flujo de Asignaciones (Flujo Secundario)
        Route::get('/asignaciones', [AsignacionController::class, 'index'])->name('asignaciones.index');
        Route::get('/asignaciones/seleccionar-asignatura/{curso}', [AsignacionController::class, 'seleccionarAsignatura'])->name('asignaciones.seleccionar-asignatura');
        Route::get('/asignaciones/seleccionar-docente/{curso}/{asignatura}', [AsignacionController::class, 'seleccionarDocente'])->name('asignaciones.seleccionar-docente');
        Route::post('/asignaciones', [AsignacionController::class, 'store'])->name('asignaciones.store');
        Route::get('/asignaciones/listar', [AsignacionController::class, 'listar'])->name('asignaciones.listar');
        Route::get('/asignaciones/{id}', [AsignacionController::class, 'show'])->name('asignaciones.show');
        Route::get('/asignaciones/{id}/edit', [AsignacionController::class, 'edit'])->name('asignaciones.edit');
        Route::put('/asignaciones/{id}', [AsignacionController::class, 'update'])->name('asignaciones.update');
        Route::delete('/asignaciones/{id}', [AsignacionController::class, 'destroy'])->name('asignaciones.destroy');

        // Mensajes de Contacto (Solo Admin)
        Route::get('/contactos', [ContactoController::class, 'index'])->name('contactos.index');
        Route::get('/contactos/{id}', [ContactoController::class, 'show'])->name('contactos.show');
        Route::post('/contactos/{id}/marcar-leido', [ContactoController::class, 'marcarLeido'])->name('contactos.marcar-leido');
        Route::delete('/contactos/{id}', [ContactoController::class, 'destroy'])->name('contactos.destroy');
    });
});
