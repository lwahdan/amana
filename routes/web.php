<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Auth\UserDashboardController;
use App\Http\Controllers\Providers\ProviderController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProviderController;
use App\Http\Controllers\Providers\ProviderDashboardController;

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

//breeze routes
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// user protected Routes
// Route::get('/dashboard', [UserDashboardController::class, 'showInfo'])->middleware('auth')->name('user.info');
Route::middleware('auth')->prefix('user')->group(function () {
    Route::get('/profile', [UserDashboardController::class, 'showInfo'])->name('user.info');
    Route::put('/profile', [UserDashboardController::class, 'updateInfo'])->name('user.info.update');
    Route::get('/bookings', [UserDashboardController::class, 'showbookings'])->name('user.bookings');
    // Route::put('/provider/bookings/{id}/complete', [ProviderDashboardController::class, 'completebooking'])->name('provider.bookings.complete');
    Route::get('/meetings', [UserDashboardController::class, 'showmeetings'])->name('user.meetings');
    // Route::put('/provider/meetings/{id}/complete', [ProviderDashboardController::class, 'completemeeting'])->name('provider.meetings.complete');
    Route::get('/reviews', [UserDashboardController::class, 'reviews'])->name('user.reviews');
    //Route::get('/provider/bookings/{id}', [BookingController::class, 'show'])->name('provider.bookings.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// public site routes(shared views)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/Department', [HomeController::class, 'department'])->name('department');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/single-blog', [HomeController::class, 'single-blog'])->name('single-blog');
Route::get('/team', [HomeController::class, 'team'])->name('team');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact_submit', [HomeController::class, 'contact_submit'])->name('contact_submit');

// admin protected routes
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
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
});
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin_login');
    Route::post('/login_submit', [AdminController::class, 'login_submit'])->middleware('throttle:5,1')->name('admin_login_submit');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');
});

// Provider protected Routes
Route::middleware('provider')->prefix('provider')->group(function () {
    // Route::get('/dashboard', [ProviderController::class, 'dashboard'])->name('provider_dashboard');
    Route::get('/profile', [ProviderDashboardController::class, 'showInfo'])->name('provider.info');
    Route::put('/profile', [ProviderDashboardController::class, 'updateInfo'])->name('provider.info.update');
    Route::get('/bookings', [ProviderDashboardController::class, 'showbookings'])->name('provider.bookings');
    Route::put('/provider/bookings/{id}/complete', [ProviderDashboardController::class, 'completebooking'])->name('provider.bookings.complete');
    Route::get('/meetings', [ProviderDashboardController::class, 'showmeetings'])->name('provider.meetings');
    Route::put('/provider/meetings/{id}/complete', [ProviderDashboardController::class, 'completemeeting'])->name('provider.meetings.complete');
    Route::get('/reviews', [ProviderDashboardController::class, 'reviews'])->name('provider.reviews');
    //Route::get('/provider/bookings/{id}', [BookingController::class, 'show'])->name('provider.bookings.show');
});
//provider routes
Route::prefix('provider')->group(function () {
    Route::get('/login', [ProviderController::class, 'login'])->name('provider_login');
    Route::post('/login_submit', [ProviderController::class, 'login_submit'])->middleware('throttle:5,1')->name('provider_login_submit');
    Route::get('/logout', [ProviderController::class, 'logout'])->name('provider_logout');
    Route::get('/register', [ProviderController::class, 'register'])->name('provider_register');
    Route::post('/register_submit', [ProviderController::class, 'register_submit'])->name('provider_register_submit');
});
