<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebhookController;
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

Route::get('application-get/{app_id}', [DashboardController::class, 'applicationGet']);
Route::post('profile-update', [UserController::class, 'profileUpdate']);

Route::middleware(['lab'])->group(function () {
    Route::post('application', [UserController::class, 'application']);
    Route::post('application-update', [UserController::class, 'applicationUpdate']);
    /*Route::get('login', [UserController::class, 'login']);*/
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::get('apply/{id}', [UserController::class, 'apply']);
    Route::get('app-edit/{id}', [UserController::class, 'editApply']);
    Route::get('app-draft/{id}', [UserController::class, 'editDraft']);
});
Route::middleware(['admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'admin'])->name('dashboard');
    Route::get('application-list', [DashboardController::class, 'applicationList'])->name('application.list');

    Route::post('remark-create', [DashboardController::class, 'storeRemark']);
    Route::post('mansha-create', [DashboardController::class, 'ManSha']);

    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::get('user-get/{id}', [UserController::class, 'show']);
    Route::get('user-delete/{id}', [UserController::class, 'destroy']);
    Route::get('user-status/{id}', [UserController::class, 'edit']);


    Route::get('form', [FormController::class, 'index'])->name('form.index');
    Route::get('form-get/{id}', [FormController::class, 'show']);
    Route::get('field/{id}', [FormController::class, 'field']);
    Route::get('form-delete/{id}', [FormController::class, 'destroy']);
    Route::get('form-status/{id}', [FormController::class, 'edit']);
    Route::post('form-create', [FormController::class, 'store']);
    Route::post('field-create', [FormController::class, 'fieldStore']);
    Route::post('form-field-update', [FormController::class, 'fieldUpdate']);
    Route::get('field-delete/{id}', [FormController::class, 'destroyField']);
    Route::post('form-update', [FormController::class, 'update']);

    Route::get('type', [TypeController::class, 'index'])->name('type.index');
    Route::get('type-get/{id}', [TypeController::class, 'show']);
    Route::get('type-delete/{id}', [TypeController::class, 'destroy']);
    Route::get('type-status/{id}', [TypeController::class, 'edit']);
    Route::post('type-create', [TypeController::class, 'store']);
    Route::post('type-update', [TypeController::class, 'update']);


    Route::get('admin', [DashboardController::class, 'admin'])->name('admin');

});



Route::get('/test', [DashboardController::class, 'test']);


Route::get('register', [UserController::class, 'register']);
Route::get('forgot', [UserController::class, 'forgot']);
Route::get('recover/{token}', [UserController::class, 'recover']);

Route::get('/', [DashboardController::class, 'index'])->name('/');
Route::post('/do-login', [DashboardController::class, 'Login'])->middleware('login');
Route::get('logout',[DashboardController::class, 'LogOut'])->name('logout');
Route::get('/login', [DashboardController::class, 'Login'])->name('login');
Route::get('lab', [DashboardController::class, 'lab'])->name('lab')->middleware('lab');
Route::get('reception', [DashboardController::class, 'reception'])->name('reception')->middleware('reception');


Route::post('user-create', [UserController::class, 'store']);
Route::post('user-forget', [UserController::class, 'forget']);
Route::post('reset-user-pass', [UserController::class, 'reset']);
Route::post('user-update', [UserController::class, 'update']);


Route::get('/check', function () {
    return view('welcome');
});
Route::post('passbase-webhooks', [WebhookController::class, 'receive_passbase_webhook']);
