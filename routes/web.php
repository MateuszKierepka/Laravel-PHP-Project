<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserCourseController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController; // Add this line

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/courses', [CourseController::class, 'index']);

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{course}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{course}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/apply-discount', [CartController::class, 'applyDiscount'])->name('cart.applyDiscount');
Route::post('/cart/apply-discount-ajax', [CartController::class, 'applyDiscountAjax'])->name('cart.applyDiscountAjax');
Route::post('/cart/save-discount-code', [CartController::class, 'saveDiscountCode'])->name('cart.saveDiscountCode');
Route::get('/checkout', [CartController::class, 'checkout'])->middleware('auth')->name('checkout');

Route::post('/checkout/applyDiscount', [CartController::class, 'applyDiscount'])->name('checkout.applyDiscount');
Route::post('/checkout/selectPaymentMethod', [CheckoutController::class, 'selectPaymentMethod'])->name('checkout.selectPaymentMethod');
Route::post('/checkout/clear-discount', [CheckoutController::class, 'clearDiscount'])->name('checkout.clearDiscount');
Route::post('/checkout/apply-discount-ajax', [CheckoutController::class, 'applyDiscountAjax'])->name('checkout.applyDiscountAjax');

Route::get('/payment', [PaymentController::class, 'index'])->middleware('auth')->name('payment');

Route::post('/user-courses', [UserCourseController::class, 'store'])->name('user_courses.store');

Route::post('/help/submit', [HelpController::class, 'submit'])->name('help.submit');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/my-courses', [UserCourseController::class, 'myCourses'])->name('my-courses');
    Route::get('/purchase-history', [UserCourseController::class, 'purchaseHistory'])->name('purchase-history');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users');
});

Route::middleware(['auth', 'can:isAdmin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::delete('/admin/users/{user}/courses/{course}', [UserController::class, 'removeCourse'])->name('admin.users.removeCourse');
    Route::get('/admin/courses', [CourseController::class, 'manage'])->name('admin.courses');
    Route::put('/admin/courses/{course}', [CourseController::class, 'update'])->name('admin.courses.update');
});

require __DIR__.'/auth.php';
