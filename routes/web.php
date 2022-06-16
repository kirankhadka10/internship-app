<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiteController;
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

Route::get('/', [AuthController::class,'home']
)->name('welcome');

Route::get('/home',[\App\Http\Controllers\SiteController::class, 'home'])
->name('home')
->middleware('auth');

// Registration
Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('user-login',[AuthController::class,'customLogin'])->name('custom.login');

Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('user-register',[AuthController::class,'customRegister'])->name('custom.register');

// Email Verification For Registered User
Route::get('/email/verify',[AuthController::class,'verificationNotice'])
->middleware('auth')
->name('verification.notice');


Route::get('/email/verify/{id}/{hash}',[AuthController::class,'verifyingEmail'])
->middleware(['auth', 'signed'])
->name('verification.verify');

Route::post('/email/resend-verification-link',[AuthController::class,'resendVerification'])
->middleware(['auth', 'throttle:6,1'])
->name('verification.resend');



Route::get('/logout',[AuthController::class,'logout'])->name('logout');

// Password Reset
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.request');
Route::put('/forgot-password', [AuthController::class,'verifyEmail'])->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class,'passwordReset'])
->middleware('guest')
->name('password.reset');

Route::post('/reset-password', [AuthController::class,'resetHandler'])
->middleware('guest')
->name('password.update');

// Admin Controller
Route::middleware(['auth','admin'])->name('admin.')->prefix('admin')->group(function(){
Route::get('/',[\App\Http\Controllers\AuthController::class,'index'])->name('index');
Route::resource('users',UserController::class);
Route::resource('posts',PostController::class);
});

// Frontend

Route::get('/', [\App\Http\Controllers\Frontend\PostController::class, 'index'])->name('welcome');

Route::get('/post/{id}', [\App\Http\Controllers\Frontend\PostController::class, 'show']);
Route::get('/create-post', [\App\Http\Controllers\Frontend\PostController::class,'create'])->name('create-post');
Route::post('/save-post', [\App\Http\Controllers\Frontend\PostController::class, 'store'])->name('save-post')->middleware('auth');
