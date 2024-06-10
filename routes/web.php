<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\ApplicantController;

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


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'home']);
    Route::resource('admin/member_type', 'App\Http\Controllers\MembershipTypeController');
    Route::resource('admin/member', 'App\Http\Controllers\MemberController');
    Route::resource('admin/payment', 'App\Http\Controllers\PaymentController');
    Route::get('/admin/applicants', [ApplicantController::class, 'index']);
    Route::get('/approve', [ApplicantController::class, 'approve']);
    Route::get('/get-certificate', [MemberController::class, 'generateCertificate']);
    Route::get('/get-receipt', [PaymentController::class, 'generateReceipt']);
    Route::get('/generate-qr-code', [MemberController::class, 'generate_qr']);
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/share-receipt', [PaymentController::class, 'ShareWidget']);

    Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::get('/user-profile', [InfoUserController::class, 'create']);
    Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
        return view('dashboard');
    })->name('sign-up');
});

Route::get('apply', [ApplicantController::class, 'create']);
Route::post('application-store', [ApplicantController::class, 'store']);
Route::get('/application/{applicant}', [ApplicantController::class, 'edit'])->name('application.edit');
Route::put('/application-update/{applicant}', [ApplicantController::class, 'update']);
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
    Route::get('/login/forgot-password', [ResetController::class, 'create']);
    Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
    Route::get('/member/{id}', [MemberController::class, 'member_verification']);
});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');
