<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\UserEventController;
use App\Http\Controllers\Admin\EventController as AdminEventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí se definen todas las rutas de la aplicación.
|
*/

// Landing page
Route::get('/', fn() => view('welcome'))->name('home');

// Dashboard de Breeze
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rutas de autenticación (login, register, etc.)
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Rutas Públicas de Eventos
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [ProfileController::class, 'show'])->name('perfil');
});


Route::delete('/events/{event}/unsubscribe', [UserEventController::class, 'unsubscribe'])
    ->middleware('auth')
    ->name('events.unsubscribe');

// Listar próximos eventos sin necesidad de autenticarse
Route::get('/events', [EventoController::class, 'index'])
     ->name('events.index');

// Ver detalle de un evento
Route::get('/events/{event}', [EventoController::class, 'show'])
     ->name('events.show');

/*
|--------------------------------------------------------------------------
| Rutas para Usuarios Autenticados
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Perfil de usuario (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])
         ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
         ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
         ->name('profile.destroy');

    // Inscribirse a un evento
    Route::post('/events/{event}/subscribe', [EventoController::class, 'subscribe'])
         ->name('events.subscribe');

    // Subir evidencia a un evento
    Route::post('/events/{event}/files', [EventoController::class, 'uploadFile'])
         ->name('events.files.upload');

    // Eliminar un archivo subido
    Route::delete('/files/{file}', [EventoController::class, 'destroyFile'])
         ->name('files.destroy');

    // Ver mis eventos inscritos
    Route::get('/my-events', [UserEventController::class, 'index'])
         ->name('my-events.index');
});

/*
|--------------------------------------------------------------------------
| CRUD de Eventos (Administradores)
|--------------------------------------------------------------------------
|
| Solo usuarios con permiso 'manage' en EventPolicy podrán acceder.
|
*/

Route::prefix('admin')
     ->middleware(['auth', 'can:manage,App\Models\Event'])
     ->name('admin.')
     ->group(function () {
         Route::resource('events', AdminEventController::class);
     });
