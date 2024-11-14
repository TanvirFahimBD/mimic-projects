<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

// Page Routes
// Route::get('/',[HomeController::class,'HomePage']);
Route::get('/userLogin', [UserController::class, 'LoginPage']);
Route::get('/userRegistration', [UserController::class, 'RegistrationPage']);
Route::get('/sendOtp', [UserController::class, 'SendOtpPage']);
Route::get('/verifyOtp', [UserController::class, 'VerifyOTPPage']);
Route::get('/resetPassword', [UserController::class, 'ResetPasswordPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/dashboard', [DashboardController::class, 'DashboardPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/userProfile', [UserController::class, 'ProfilePage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/categoryPage', [CategoryController::class, 'CategoryPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/customerPage', [CustomerController::class, 'CustomerPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/productPage', [ProductController::class, 'ProductPage'])->middleware([TokenVerificationMiddleware::class]);
// Route::get('/invoicePage',[InvoiceController::class,'InvoicePage'])->middleware([TokenVerificationMiddleware::class]);
// Route::get('/salePage',[InvoiceController::class,'SalePage'])->middleware([TokenVerificationMiddleware::class]);
// Route::get('/reportPage',[ReportController::class,'ReportPage'])->middleware([TokenVerificationMiddleware::class]);

// auth level api
Route::post('/user-registration', [UserController::class, 'UserRegistration']);
Route::post('/user-login', [UserController::class, 'UserLogin']);
Route::post('/send-otp', [UserController::class, 'SendOTP']);
Route::post('/verify-otp', [UserController::class, 'VerifyOTP']);
Route::post('/reset-password', [UserController::class, 'ResetPassword'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::get('/logout', [UserController::class, 'UserLogout']);

//profile api
Route::get('/user-profile', [UserController::class, 'UserProfile'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/user-update', [UserController::class, 'UserUpdate'])
    ->middleware([TokenVerificationMiddleware::class]);

//category api
Route::get('/list-category', [CategoryController::class, 'ListCategory'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/create-category', [CategoryController::class, 'CategoryCreate'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/category-by-id', [CategoryController::class, 'CategoryByID'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/update-category', [CategoryController::class, 'CategoryUpdate'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/delete-category', [CategoryController::class, 'CategoryDelete'])
    ->middleware([TokenVerificationMiddleware::class]);

//customer api
Route::get('/list-customer', [CustomerController::class, 'ListCustomer'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/create-customer', [CustomerController::class, 'CustomerCreate'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/customer-by-id', [CustomerController::class, 'CustomerByID'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/update-customer', [CustomerController::class, 'CustomerUpdate'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/delete-customer', [CustomerController::class, 'CustomerDelete'])
    ->middleware([TokenVerificationMiddleware::class]);

//product api
Route::get('/list-product', [ProductController::class, 'ListProduct'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/create-product', [ProductController::class, 'ProductCreate'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/product-by-id', [ProductController::class, 'ProductByID'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/update-product', [ProductController::class, 'ProductUpdate'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/delete-product', [ProductController::class, 'ProductDelete'])
    ->middleware([TokenVerificationMiddleware::class]);
