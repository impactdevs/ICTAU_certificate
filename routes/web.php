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
use App\Http\Controllers\FormbuilderController;

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
    //Route::resource('admin/formBuilder/{id}', 'App\Http\Controllers\FormbuilderController');
    Route::get('admin/formBuilder/', [FormbuilderController::class, 'index'])->name('form_builder');
    Route::get('admin/formBuilder/create/', [FormbuilderController::class, 'create']);
    Route::get('admin/formBuilder/edit/{id}', [FormbuilderController::class, 'edit'])->name('form_builder_edit_form');
    Route::put('admin/formBuilder/update/{id}', [FormbuilderController::class, 'update']);
    Route::delete('admin/formBuilder/delete/{id}', [FormbuilderController::class, 'destroy']);
    Route::post('admin/formBuilder/create_form', [FormbuilderController::class, 'store'])->name('create_form_post');
    Route::get('admin/formBuilder/show_form/{id}', [FormbuilderController::class, 'show'])->name('show_form');
    Route::post('admin/formBuilder/create_form_field/{id}', [FormbuilderController::class, 'addFormField'])->name('create_form_field');
    Route::get('admin/formBuilder/form/{id}', [FormbuilderController::class, 'viewForm'])->name('view_form');
    Route::get('admin/formBuilder/form/response/{form_id}', [FormbuilderController::class, 'viewResponse'])->name('view_response');
    Route::post('admin/formBuilder/form/store_response/{form_id}', [FormbuilderController::class, 'storeResponse'])->name('store_response');
    Route::get('admin/formBuilder/form/delete_response/{form_id}', [FormbuilderController::class, 'destroyResponse'])->name('destroy_response');
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
