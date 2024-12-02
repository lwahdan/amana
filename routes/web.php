<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// admin routes
Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/dashboard' ,[ AdminController::class , 'dashboard'])->name('admin_dashboard');
 });
 Route::prefix('admin')->group(function () {
    Route::get('/login' ,[ AdminController::class , 'login'])->name('admin_login');
    Route::post('/login_submit' ,[ AdminController::class , 'login_submit'])->name('admin_login_submit');
    Route::get('/logout' ,[ AdminController::class , 'logout'])->name('admin_logout');
});



