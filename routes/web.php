<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\BlogController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\ReviewController;
use App\Http\Controllers\Auth\MeetingController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminAdminController;
use App\Http\Controllers\Auth\BlogCommentController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminMeetingController;
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

//breeze routes
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/book_submit', [HomeController::class, 'book_submit'])->name('book_submit');
});

require __DIR__ . '/auth.php';

// user protected Routes (user dashboard)
Route::middleware('auth')->prefix('user')->group(function () {
    Route::get('/profile', [UserDashboardController::class, 'showInfo'])->name('user.info');
    Route::put('/profile', [UserDashboardController::class, 'updateInfo'])->name('user.info.update');
    Route::get('/bookings', [UserDashboardController::class, 'showbookings'])->name('user.bookings');
    // Route::put('/provider/bookings/{id}/complete', [ProviderDashboardController::class, 'completebooking'])->name('provider.bookings.complete');
    Route::get('/meetings', [UserDashboardController::class, 'showmeetings'])->name('user.meetings');
    // Route::put('/provider/meetings/{id}/complete', [ProviderDashboardController::class, 'completemeeting'])->name('provider.meetings.complete');
    Route::get('/reviews', [UserDashboardController::class, 'reviews'])->name('user.reviews');
    //Route::get('/provider/bookings/{id}', [BookingController::class, 'show'])->name('provider.bookings.show');
    Route::get('/favorites', [UserDashboardController::class, 'showFavorites'])->name('user.favorites');
    Route::get('/blogs', [UserDashboardController::class, 'showBlogs'])->name('user.blogs');
});

//blog routes
// Authenticated blog routes
Route::middleware('auth')->group(function () {
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
    Route::post('/blogs/{blog}/comment', [BlogCommentController::class, 'store'])->name('blogs.comment');
    Route::post('/blogs/{blog}/like', [BlogController::class, 'like'])->name('blogs.like');
    Route::post('/blogs/{blog}/favorites', [BlogController::class, 'toggleFavorite'])->name('blogs.toggleFavorite');
    Route::post('/comments/{comment}/reply', [BlogCommentController::class, 'reply'])->name('comments.reply');
    Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');
    Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
    //request a meeting protected route
    Route::post('/meetings/request/{provider}', [MeetingController::class, 'store'])->name('meetings.request');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('user.reviews.store');
});
// Public blog routes
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');
Route::get('/blogs/service/{service}', [BlogController::class, 'filterByService'])->name('blogs.filterByService');


// public site routes(shared views)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [HomeController::class, 'service'])->name('services');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/team', [HomeController::class, 'team'])->name('team');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact_submit', [HomeController::class, 'contact_submit'])->name('contact_submit');
Route::get('/book', [HomeController::class, 'book'])->name('book');
Route::get('/get-providers', [HomeController::class, 'getProviders'])->name('get.providers');
Route::get('/provider/info/{id}', [HomeController::class, 'providerInfo'])->name('show.provider.info');
Route::get('/thanks', [HomeController::class, 'thanks'])->name('thankyou');


// admin protected routes
Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::resource('/users', AdminUserController::class);
    Route::put('/users/{id}/restore', [AdminUserController::class, 'restore'])->name('users.restore');
    Route::resource('/providers', AdminProviderController::class);
    Route::put('/providers/{id}/restore', [AdminProviderController::class, 'restore'])->name('providers.restore');
    Route::resource('/admins', AdminAdminController::class);
    Route::put('/admins/{id}/restore', [AdminAdminController::class, 'restore'])->name('admins.restore');
    Route::get('/users/search', [AdminUserController::class, 'search'])->name('users.search');
    Route::resource('/categories', AdminCategoryController::class);
    Route::resource('/services', AdminServiceController::class);
    Route::put('/services/{id}/restore', [AdminServiceController::class, 'restore'])->name('services.restore');
    Route::resource('/bookings', AdminBookingController::class);
    Route::put('/bookings/{id}/restore', [AdminBookingController::class, 'restore'])->name('bookings.restore');
    Route::resource('/reviews', AdminReviewController::class);
    Route::put('/reviews/{id}/restore', [AdminReviewController::class, 'restore'])->name('reviews.restore');
    Route::get('/reports', [AdminReportController::class, 'index'])->name('admin.reports');
    //admin blogs routes 
    Route::get('/blogs', [AdminBlogController::class, 'index'])->name('admin.blogs');
    Route::get('/blogs/{blog}', [AdminBlogController::class, 'show'])->name('admin.blogs.show');
    Route::get('/blogs/{blog}/edit', [AdminBlogController::class, 'edit'])->name('admin.blogs.edit');
    Route::delete('/blogs/{blog}', [AdminBlogController::class, 'destroy'])->name('admin.blogs.destroy');
    Route::put('/blogs/{blog}', [AdminBlogController::class, 'update'])->name('admin.blogs.update');
    Route::get('/blogs/create', [AdminBlogController::class, 'create'])->name('admin.blogs.create');
    Route::post('/blogs', [AdminBlogController::class, 'store'])->name('admin.blogs.store');
    Route::put('/blogs/{blog}/restore', [AdminBlogController::class, 'restore'])->name('admin.blogs.restore');
    Route::resource('/contacts', AdminContactController::class);
    Route::resource('/comments', AdminCommentController::class);
    Route::resource('/meetings', AdminMeetingController::class);
    Route::put('/meetings/{id}/restore', [AdminMeetingController::class, 'restore'])->name('meetings.restore');
});

// Route::middleware('admin')->prefix('admin')->group(function () {
//     Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
// });
// admin public routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin_login');
    Route::post('/login_submit', [AdminController::class, 'login_submit'])->middleware('throttle:5,1')->name('admin_login_submit');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');
});

// Provider protected Routes
Route::middleware('provider')->prefix('provider')->group(function () {
    Route::get('/profile', [ProviderDashboardController::class, 'showInfo'])->name('provider.info');
    Route::put('/profile', [ProviderDashboardController::class, 'updateInfo'])->name('provider.info.update');
    Route::get('/bookings', [ProviderDashboardController::class, 'showbookings'])->name('provider.bookings');
    Route::put('/provider/bookings/{id}/complete', [ProviderDashboardController::class, 'completebooking'])->name('provider.bookings.complete');
    //Route::get('/provider/bookings/{id}', [BookingController::class, 'show'])->name('provider.bookings.show');
    Route::get('/meetings', [ProviderDashboardController::class, 'showmeetings'])->name('provider.meetings');
    Route::put('/meetings/{id}/update', [ProviderDashboardController::class, 'updatmeeting'])->name('provider.meetings.update');
    Route::put('/meetings/{id}/complete', [ProviderDashboardController::class, 'completeMeeting'])->name('provider.meetings.complete');
    Route::delete('/meetings/{id}', [ProviderDashboardController::class, 'deleteMeeting'])->name('provider.meetings.delete');
    Route::get('/reviews', [ProviderDashboardController::class, 'reviews'])->name('provider.reviews');
    // provider blog routes
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('provider.blogs.create');
    Route::post('/blogs/store', [BlogController::class, 'store'])->name('provider.blogs.store');
    Route::get('/blogs', [ProviderDashboardController::class, 'showBlogs'])->name('provider.blogs');
    Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('provider.blogs.edit');
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('provider.blogs.destroy');
    Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('provider.blogs.update');

});
//provider routes
Route::prefix('provider')->group(function () {
    Route::get('/login', [ProviderController::class, 'login'])->name('provider_login');
    Route::post('/login_submit', [ProviderController::class, 'login_submit'])->middleware('throttle:5,1')->name('provider_login_submit');
    Route::post('/logout', [ProviderController::class, 'logout'])->name('provider_logout');
    Route::get('/register', [ProviderController::class, 'register'])->name('provider_register');
    Route::post('/register_submit', [ProviderController::class, 'register_submit'])->name('provider_register_submit');
});
