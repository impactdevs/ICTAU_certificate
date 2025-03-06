<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\CommunicationController;


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneralSettingsController;

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


Route::middleware(['auth', 'admin.check'])->group(function () {
    Route::get('/', [HomeController::class, 'home']);
    Route::resource('admin/member_type', 'App\Http\Controllers\MembershipTypeController');
    Route::resource('admin/member', 'App\Http\Controllers\MemberController');
    Route::resource('admin/events', 'App\Http\Controllers\TrainingController');
    Route::resource('admin/payment', 'App\Http\Controllers\PaymentController');
    Route::get('/admin/applicants', [ApplicantController::class, 'index']);
    Route::get('/admin/applicants/{applicant}', [ApplicantController::class, 'show']);
    Route::get('/approve', [ApplicantController::class, 'approve']);
    Route::get('/get-certificate', [MemberController::class, 'generateCertificate']);
    Route::get('/get-attendance-certificate', [AttendanceController::class, 'generateCertificate']);
    Route::get('/certificate', [AttendanceController::class, 'certificate']);
    Route::get('/get-receipt', [PaymentController::class, 'generateReceipt']);
    Route::get('/generate-qr-code', [MemberController::class, 'generate_qr']);
    Route::get('dashboard',  [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/share-receipt', [PaymentController::class, 'ShareWidget']);

    Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::get('/user-profile', [InfoUserController::class, 'create']);
    Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
        return view('dashboard');
    })->name('sign-up');

    Route::get('admin/general-settings', [GeneralSettingsController::class, 'edit'])->name('admin.general_settings.update');
    Route::put('admin/general-settings-update', [GeneralSettingsController::class, 'update']);
    Route::get('admin/attendance', [AttendanceController::class, 'index']);

    //communications
    Route::get('admin/communications', [CommunicationController::class, 'index']);
    //route('sendEmail')
    Route::get('admin/communications/send-email', [CommunicationController::class, 'create']);
    Route::post('admin/communications/send-email', [CommunicationController::class, 'sendEmail'])->name('sendEmail');
});
Route::post('application-store', [ApplicantController::class, 'store']);
Route::get('/application/{applicant}', [ApplicantController::class, 'edit'])->name('application.edit');
Route::put('/application-update/{applicant}', [ApplicantController::class, 'update']);
Route::get('/summit-attendance-registration', [AttendanceController::class, 'register'])->name('attendance.register');
Route::post('/record-attendance', [AttendanceController::class, 'store'])->name('attendance.store');


Route::group(['middleware' => 'guest'], function () {
    // Route::get('/register', [RegisterController::class, 'create']);
    // Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
    Route::get('/login/forgot-password', [ResetController::class, 'create']);
    Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
    Route::get('/member/{id}', [MemberController::class, 'member_verification']);
    Route::get('/attendance/{id}', [AttendanceController::class, 'attendance_verification']);

    Route::get('apply', [ApplicantController::class, 'create']);
    Route::get('/apply-to-become-a-member/{application_type}', [ApplicantController::class, 'step1']);
});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');
