<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\Auth\AdminRegisterController;
use App\Http\Controllers\Auth\CustomerRegisterController;
use App\Http\Controllers\Auth\AdminVerificationController;
use App\Http\Controllers\Auth\CustomForgotPasswordController;



// HomePage (Routes)
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/search', [IndexController::class, 'search'])->name('search');

// User manual document
Route::get('/user-manual', function () {return view('user_manual');})->name('user.manual');

// Email Customer
Route::get('/chat-customer', function () {return view('chat_customer');})->name('chat-customer');

// Admin Manage Car (Routes)
Route::get('/admin/cars', [CarController::class, 'index'])->name('cars.manage');
Route::post('/admin/cars', [CarController::class, 'store'])->name('cars.store');
Route::get('/admin/cars/{car}', [CarController::class, 'edit'])->name('cars.edit');
Route::post('/admin/cars/{car}/update', [CarController::class, 'update'])->name('cars.update');
Route::post('/admin/cars/{car}/delete', [CarController::class, 'destroy'])->name('cars.destroy');

// ADMIN MANAGE BOOKING
Route::get('/admin/bookings/manage', [BookingController::class, 'manageBookings'])->name('admin.bookings.manage');
Route::post('/admin/bookings/{booking}/complete', [BookingController::class, 'markCompleted'])->name('admin.bookings.complete');

// ViewCarDetail (Routes)
Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');

// Dashboard and Auth Routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Choose role landing page
Route::get('/login', function () {return view('auth.choose-role');})->name('choose.role');

// Admin Routes
Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// Chat Message Admin
Route::middleware(['auth:admin'])->group(function () {
    Route::get('admin/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('admin/chat', [ChatController::class, 'store'])->name('chat.store');
});

// Customer Routes
Route::get('/customer/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
Route::post('/customer/login', [CustomerAuthController::class, 'login'])->name('customer.login.submit');

// Show the form
Route::get('/forgot-password', [CustomForgotPasswordController::class, 'showForgotForm'])
    ->name('custom.password.request');

// Reset Password
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.store');

require __DIR__.'/auth.php';

// Handle the form submission
Route::post('/forgot-password', [CustomForgotPasswordController::class, 'sendResetLink'])->name('custom.password.email');

// Register Accounter
Route::get('/register/customer', [CustomerRegisterController::class, 'show'])->name('register.customer');
Route::post('/register/customer', [CustomerRegisterController::class, 'register']);

Route::get('/register/admin', [AdminRegisterController::class, 'show'])->name('register.admin');
Route::post('/register/admin', [AdminRegisterController::class, 'register']);

Route::get('/admin/verify-code', [AdminVerificationController::class, 'showVerificationForm'])->name('verify.admin.code');
Route::post('/admin/verify-code', [AdminVerificationController::class, 'verifyCode'])->name('verify.admin.code.submit');

// About us
Route::view('/about', 'about')->name('about');

// Profile Customer
Route::middleware('auth:customer')->group(function () {
    Route::get('/profile', [CustomerProfileController::class, 'index'])->name('customer.profile');
});

// Logout Customer
Route::post('/logout', function () {Auth::guard('customer')->logout();request()->session()->invalidate();request()->session()->regenerateToken();return redirect('/');})->name('customer.logout');

// Profile Admin
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/profile', [AdminProfileController::class, 'index'])->name('admin.profile');

// Logout Admin
    Route::post('/admin/logout', function () {Auth::guard('admin')->logout();request()->session()->invalidate();request()->session()->regenerateToken();return redirect('/');})->name('admin.logout');});




// LARAVEL BREEZE
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
});

Route::middleware(['auth:customer'])->group(function () {
    Route::get('/customer/profile', function () {
        return view('customer.profile');
    });
});

// Show edit profile form
Route::get('/admin/edit', [AdminProfileController::class, 'edit'])->name('admin.edit');

// Handle form submission
Route::post('/admin/update', [AdminProfileController::class, 'update'])->name('admin.update');

//Route::get('/profile/{username}', [UserController::class, 'show'])->name('user.profile');

Route::get('/feedback', function () {
    return view('feedback');
});

Route::get('/customer/edit', [CustomerProfileController::class, 'edit'])->name('customer.edit');
Route::post('/customer/update', [CustomerProfileController::class, 'update'])->name('customer.update');


Route::get('/feedback/{bookingID}', [FeedbackController::class, 'showForm'])->name('feedback.form');
Route::post('/feedback/submit', [FeedbackController::class, 'submit'])->name('feedback.submit');

Route::get('/booking-history', [BookingController::class, 'showBookingHistory'])->name('booking.history');

Route::get('/feedback/{id}/edit', [FeedbackController::class, 'edit'])->name('feedback.edit');
Route::post('/feedback/{id}/update', [FeedbackController::class, 'update'])->name('feedback.update');



//Payment Booking
//user must get authenticate and verified in order to use the route
Route::middleware(['auth:customer', 'verified'])->group(function () {
    Route::get('/homepage', [BookingController::class, 'index1'])->name('booking.index');
    Route::get('/car-list', [BookingController::class, 'index2'])->name('car.index');

    Route::get('/booking/create/{car}', [BookingController::class, 'createWithCar'])->name('booking.create.withCar');
    Route::post('/booking/{car}', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/detail/{booking}', [BookingController::class, 'show'])->name('booking.detail');

    Route::get('/booking/{booking}/edit', [BookingController::class, 'edit'])->name('booking.edit');
    Route::put('/booking/{booking}', [BookingController::class, 'update'])->name('booking.update');
    Route::delete('/booking/{booking}', [BookingController::class, 'destroy'])->name('booking.destroy');


    Route::get('/payment/{booking}', [PaymentController::class, 'index'])->name('payment.index');
    Route::get('/payment/success/{booking}', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    Route::post('/payment/update/{booking}', [PaymentController::class, 'update'])->name('payment.update');
    Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
});