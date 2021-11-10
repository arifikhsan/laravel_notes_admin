<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/secretroom', [DashboardController::class, 'overview'])->name('secretroom-overview');

    Route::get('/secretroom/{table}', [DashboardController::class, 'index']);
    Route::get('/secretroom/{table}/new', [DashboardController::class, 'new']);
    Route::post('/secretroom/{table}/create', [DashboardController::class, 'create']);
    Route::get('/secretroom/{table}/{id}', [DashboardController::class, 'show']);
    Route::get('/secretroom/{table}/{id}/edit', [DashboardController::class, 'edit']);
    Route::put('/secretroom/{table}/{id}/update', [DashboardController::class, 'update']);
    Route::get('/secretroom/{table}/{id}/delete', [DashboardController::class, 'delete']);
    Route::delete('/secretroom/{table}/{id}/destroy', [DashboardController::class, 'destroy']);
});


require __DIR__.'/auth.php';
