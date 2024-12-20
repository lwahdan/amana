<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Providers\ProviderController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProviderController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// website template (shared views)
Route::get('/', function () {
    return view('index');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/Department', function () {
    return view('Department');
});

Route::get('/doctors', function () {
    return view('doctors');
});

Route::get('/single-blog', function () {
    return view('single-blog');
});

// project routes
Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::resource('/users', AdminUserController::class);
    Route::put('/users/{id}/restore', [AdminUserController::class, 'restore'])->name('users.restore');
    Route::resource('/providers', AdminProviderController::class);
    Route::put('/providers/{id}/restore', [AdminProviderController::class, 'restore'])->name('providers.restore');
    Route::get('/users/search', [AdminUserController::class, 'search'])->name('users.search');
    Route::resource('/categories', AdminCategoryController::class);
    Route::resource('/services', AdminServiceController::class);
    Route::resource('/bookings', AdminBookingController::class);
    Route::resource('/reviews', AdminReviewController::class);
    Route::put('/reviews/{id}/status', [AdminReviewController::class, 'updateStatus'])->name('reviews.updateStatus');
    Route::get('/reports', [AdminReportController::class, 'index'])->name('admin.reports');
});

// admin routes
Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/dashboard' ,[ AdminController::class , 'dashboard'])->name('admin_dashboard');
 });
 Route::prefix('admin')->group(function () {
    Route::get('/login' ,[ AdminController::class , 'login'])->name('admin_login');
    Route::post('/login_submit' ,[ AdminController::class , 'login_submit'])->middleware('throttle:5,1')->name('admin_login_submit');
    Route::get('/logout' ,[ AdminController::class , 'logout'])->name('admin_logout');
});

// Provider Routes
Route::middleware('provider')->prefix('provider')->group(function () {
    Route::get('/dashboard', [ProviderController::class, 'dashboard'])->name('provider_dashboard');
});

Route::prefix('provider')->group(function () {
    Route::get('/login', [ProviderController::class, 'login'])->name('provider_login');
    Route::post('/login_submit', [ProviderController::class, 'login_submit'])->middleware('throttle:5,1')->name('provider_login_submit');
    Route::get('/logout', [ProviderController::class, 'logout'])->name('provider_logout');
    Route::get('/register', [ProviderController::class, 'register'])->name('provider_register');
    Route::post('/register_submit', [ProviderController::class, 'register_submit'])->name('provider_register_submit');
});



