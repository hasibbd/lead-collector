<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
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

Route::get('login', [UserController::class, 'login']);
Route::get('register', [UserController::class, 'register']);
Route::get('forgot', [UserController::class, 'forgot']);
Route::get('recover', [UserController::class, 'recover']);

Route::get('dashboard', [DashboardController::class, 'index']);

Route::get('user', [UserController::class, 'index'])->name('user.index');
Route::get('user-get/{id}', [UserController::class, 'show']);
Route::get('user-delete/{id}', [UserController::class, 'destroy']);
Route::get('user-status/{id}', [UserController::class, 'edit']);
Route::post('user-create', [UserController::class, 'store']);
Route::post('user-update', [UserController::class, 'update']);

Route::get('form', [FormController::class, 'index'])->name('form.index');
Route::get('form-get/{id}', [FormController::class, 'show']);
Route::get('field/{id}', [FormController::class, 'field']);
Route::get('form-delete/{id}', [FormController::class, 'destroy']);
Route::get('form-status/{id}', [FormController::class, 'edit']);
Route::post('form-create', [FormController::class, 'store']);
Route::post('field-create', [FormController::class, 'fieldStore']);
Route::get('field-delete/{id}', [FormController::class, 'destroyField']);
Route::post('form-update', [FormController::class, 'update']);

Route::get('type', [TypeController::class, 'index'])->name('type.index');
Route::get('type-get/{id}', [TypeController::class, 'show']);
Route::get('type-delete/{id}', [TypeController::class, 'destroy']);
Route::get('type-status/{id}', [TypeController::class, 'edit']);
Route::post('type-create', [TypeController::class, 'store']);
Route::post('type-update', [TypeController::class, 'update']);


Route::get('/test', [DashboardController::class, 'test']);
