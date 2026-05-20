<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

use App\Http\Controllers\Auth\LoginController;
Route::get('/login',  [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/api/f1-news',   [App\Http\Controllers\NewsController::class,  'index']);
Route::get('/api/f1-rumors', [App\Http\Controllers\RumorController::class, 'index']);

// ── ADMIN ──────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth','admin'])->group(function () {
    Route::get('/',                       [App\Http\Controllers\AdminController::class,'dashboard'])->name('dashboard');
    Route::post('/set-next-race',         [App\Http\Controllers\AdminController::class,'setNextRace'])->name('setNextRace');

    // Circuitos
    Route::get('/circuitos',             [App\Http\Controllers\AdminController::class,'circuitos'])->name('circuitos');
    Route::get('/circuitos/crear',       [App\Http\Controllers\AdminController::class,'circuitoCreate'])->name('circuitos.create');
    Route::post('/circuitos',            [App\Http\Controllers\AdminController::class,'circuitoStore'])->name('circuitos.store');
    Route::get('/circuitos/{id}/editar', [App\Http\Controllers\AdminController::class,'circuitoEdit'])->name('circuitos.edit');
    Route::put('/circuitos/{id}',        [App\Http\Controllers\AdminController::class,'circuitoUpdate'])->name('circuitos.update');
    Route::delete('/circuitos/{id}',     [App\Http\Controllers\AdminController::class,'circuitoDestroy'])->name('circuitos.destroy');

    // Usuarios
    Route::get('/usuarios',              [App\Http\Controllers\AdminController::class,'usuarios'])->name('usuarios');
    Route::get('/usuarios/{id}/editar',  [App\Http\Controllers\AdminController::class,'usuarioEdit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}',         [App\Http\Controllers\AdminController::class,'usuarioUpdate'])->name('usuarios.update');
    Route::delete('/usuarios/{id}',      [App\Http\Controllers\AdminController::class,'usuarioDestroy'])->name('usuarios.destroy');

    // Rumores
    Route::get('/rumores',               [App\Http\Controllers\AdminController::class,'rumores'])->name('rumores');
    Route::get('/rumores/crear',         [App\Http\Controllers\AdminController::class,'rumorCreate'])->name('rumores.create');
    Route::post('/rumores',              [App\Http\Controllers\AdminController::class,'rumorStore'])->name('rumores.store');
    Route::get('/rumores/{id}/editar',   [App\Http\Controllers\AdminController::class,'rumorEdit'])->name('rumores.edit');
    Route::put('/rumores/{id}',          [App\Http\Controllers\AdminController::class,'rumorUpdate'])->name('rumores.update');
    Route::delete('/rumores/{id}',       [App\Http\Controllers\AdminController::class,'rumorDestroy'])->name('rumores.destroy');

    // Noticias
    Route::get('/noticias',              [App\Http\Controllers\AdminController::class,'noticias'])->name('noticias');
    Route::get('/noticias/crear',        [App\Http\Controllers\AdminController::class,'noticiaCreate'])->name('noticias.create');
    Route::post('/noticias',             [App\Http\Controllers\AdminController::class,'noticiaStore'])->name('noticias.store');
    Route::get('/noticias/{id}/editar',  [App\Http\Controllers\AdminController::class,'noticiaEdit'])->name('noticias.edit');
    Route::put('/noticias/{id}',         [App\Http\Controllers\AdminController::class,'noticiaUpdate'])->name('noticias.update');
    Route::delete('/noticias/{id}',      [App\Http\Controllers\AdminController::class,'noticiaDestroy'])->name('noticias.destroy');

    // Log
    Route::get('/log',                   [App\Http\Controllers\AdminController::class,'log'])->name('log');
});
