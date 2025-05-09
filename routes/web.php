<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventoController;  // ← Importa tu controlador
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile',   [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ——— RUTAS PARA EVENTOS ———

// Listar eventos públicos (sin auth)
Route::get('/events', [EventoController::class, 'index'])
     ->name('events.index');

// Ver detalle de un evento
Route::get('/events/{event}', [EventoController::class, 'show'])
     ->name('events.show');

// Todas las rutas siguientes requieren estar autenticado
Route::middleware('auth')->group(function () {
    // Inscribirse a un evento
    Route::post('/events/{event}/subscribe', [EventoController::class, 'subscribe'])
         ->name('events.subscribe');

    // Subir archivo de evidencia
    Route::post('/events/{event}/files', [EventoController::class, 'uploadFile'])
         ->name('events.files.upload');

    // Borrar un archivo subido
    Route::delete('/files/{file}', [EventoController::class, 'destroyFile'])
         ->name('files.destroy');
});
