<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CitaAceptadaController;
use App\Http\Controllers\CitaPendienteController;
use App\Http\Controllers\CitaRechazadaController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RemoveRoleFromUserController;
use App\Http\Controllers\RevokePermissionFromRoleController;
use App\Http\Controllers\RevokePermissionFromUserController;
use App\Http\Controllers\RevokePermissionsFromRoleController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\CitaAceptada;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::resource('/users', UserController::class);
Route::resource('/roles', RoleController::class);
Route::resource('/permissions', PermissionController::class);
Route::resource('/posts', PostController::class);
Route::get('/admin/citas/pendientes', [CitaPendienteController::class, 'pendientes'])->name('admin.citas.pendientes');
Route::get('/admin/citas', [CitaPendienteController::class, 'citas'])->name('admin.citas');
Route::get('/reserva/historial/{id}/comprobantep', [CitaPendienteController::class, 'comprobantep'])->name('reserva.comprobantep');
Route::get('/reserva/historial/{id}/comprobantea', [CitaPendienteController::class, 'comprobantea'])->name('reserva.comprobantea');
Route::get('/reserva/historial/{id}/comprobanter', [CitaPendienteController::class, 'comprobanter'])->name('reserva.comprobanter');
Route::get('/reserva/historial', [CitaPendienteController::class, 'historial'])->name('reserva.historial');
Route::get('/consultas/todos', [ConsultaController::class, 'todoc'])->name('consulta.todos');
Route::resource('/consultas', ConsultaController::class);
Route::resource('/reserva', CitaPendienteController::class);
Route::resource('/admin/citas/aceptadas', CitaAceptadaController::class);
Route::resource('/admin/citas/rechazadas', CitaRechazadaController::class);
Route::put('/admin/citas/pendientes/{id}/aceptar', [CitaPendienteController::class, 'aceptarCita'])
    ->name('citas.pendientes.aceptar');
Route::put('/admin/citas/pendientes/{id}/rechazar', [CitaPendienteController::class, 'rechazarCita'])
    ->name('citas.pendientes.rechazar');
Route::delete('/roles/{role}/permissions/{permission}', RevokePermissionFromRoleController::class)
    ->name('roles.permissions.destroy');
Route::delete('/users/{user}/permissions/{permission}', RevokePermissionFromUserController::class)
    ->name('users.permissions.destroy');
Route::delete('/users/{user}/roles/{role}', RemoveRoleFromUserController::class)
    ->name('users.roles.destroy');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

require __DIR__ . '/auth.php';
