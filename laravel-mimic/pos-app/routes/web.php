<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

// Page Routes
Route::get('/',[HomeController::class,'HomePage']);
Route::get('/userLogin',[UserController::class,'LoginPage']);
Route::get('/userRegistration',[UserController::class,'RegistrationPage']);
Route::get('/sendOtp',[UserController::class,'SendOtpPage']);
Route::get('/verifyOtp',[UserController::class,'VerifyOTPPage']);
Route::get('/resetPassword',[UserController::class,'ResetPasswordPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/dashboard',[DashboardController::class,'DashboardPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/userProfile',[UserController::class,'ProfilePage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/categoryPage',[CategoryController::class,'CategoryPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/customerPage',[CustomerController::class,'CustomerPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/productPage',[ProductController::class,'ProductPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/invoicePage',[InvoiceController::class,'InvoicePage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/salePage',[InvoiceController::class,'SalePage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/reportPage',[ReportController::class,'ReportPage'])->middleware([TokenVerificationMiddleware::class]);


// Web API Routes
Route::post('/user-registration', [UserController::Class, 'UserRegistration']);
Route::post('/user-login', [UserController::Class, 'UserLogin']);
Route::post('/send-otp', [UserController::Class, 'SendOTP']);
Route::post('/verify-otp', [UserController::Class, 'VerifyOTP']);
Route::post('/reset-password', [UserController::Class, 'ResetPassword'])
            ->middleware([TokenVerificationMiddleware::class]);
Route::get('/logout', [UserController::Class, 'UserLogout']);
Route::get('/user-profile', [UserController::Class, 'UserProfile'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/user-update', [UserController::Class, 'UserUpdate'])
    ->middleware([TokenVerificationMiddleware::class]);

//category API
Route::get('/list-category', [CategoryController::Class, 'ListCategory'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/create-category', [CategoryController::Class, 'CategoryCreate'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/category-by-id', [CategoryController::Class, 'CategoryByID'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/update-category', [CategoryController::Class, 'CategoryUpdate'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/delete-category', [CategoryController::Class, 'CategoryDelete'])
    ->middleware([TokenVerificationMiddleware::class]);

//customer API
Route::get('/list-customer', [CustomerController::Class, 'ListCustomer'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/create-customer', [CustomerController::Class, 'CustomerCreate'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/customer-by-id', [CustomerController::Class, 'CustomerByID'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/update-customer', [CustomerController::Class, 'CustomerUpdate'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/delete-customer', [CustomerController::Class, 'CustomerDelete'])
    ->middleware([TokenVerificationMiddleware::class]);

//product API
Route::get('/list-product', [ProductController::Class, 'ListProduct'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/create-product', [ProductController::Class, 'ProductCreate'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/product-by-id', [ProductController::Class, 'ProductByID'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/update-product', [ProductController::Class, 'ProductUpdate'])
    ->middleware([TokenVerificationMiddleware::class]);
Route::post('/delete-product', [ProductController::Class, 'ProductDelete'])
    ->middleware([TokenVerificationMiddleware::class]);
