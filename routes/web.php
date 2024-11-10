<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;



Route::get('/no-permission', function () {
    return view('no-permission');
})->name('no-permission');


// Ruta de bienvenida
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de autenticación solo para usuarios no autenticados
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/password/request', [AuthController::class, 'showPasswordRequestForm'])->name('password.request');
    Route::post('/password/email', [AuthController::class, 'sendPasswordResetLink']);
});

// Rutas protegidas por el middleware `auth` para usuarios autenticados
Route::middleware('auth')->group(function () {
    // Colocar el logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Agrupación de rutas bajo el prefijo dashboard (rutas hijas de dashboard)
    Route::prefix('dashboard')->group(function () {
        // Rutas de CRUD para Room (solo para el rol 'Administrador')
        Route::resource('rooms', RoomController::class)->middleware('role:Administrador')->names([
            'index' => 'rooms.index',
            'store' => 'rooms.store',
            'edit' => 'rooms.edit',
            'update' => 'rooms.update',
            'destroy' => 'rooms.destroy',
        ]);

        // Rutas de CRUD para Reservation (solo para roles 'Administrador' y 'Cliente')
        Route::resource('reservations', ReservationController::class)->middleware('role:Administrador,Cliente')->names([
            'index' => 'Reservation.index',
            'store' => 'Reservation.store',
            'edit' => 'Reservation.edit',
            'update' => 'Reservation.update',
            'destroy' => 'Reservation.destroy',
        ]);

        // Ruta adicional para la administración de reservaciones (solo para el rol 'Administrador')
        Route::get('administrar-reservaciones', [ReservationController::class, 'admin'])
            ->middleware('role:Administrador')
            ->name('Reservation.admin');
    });
});
