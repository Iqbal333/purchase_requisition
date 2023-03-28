<?php

use App\Http\Controllers\Admin\RequestItemController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListRequestController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RequestItemsController;
use App\Http\Controllers\RequestListController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [LoginController::class, 'showLoginForm']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('posts', PostController::class);

    Route::resource('request_items', RequestItemsController::class);
    Route::resource('division', DivisionController::class);
    Route::resource('employee', EmployeeController::class);

    Route::get('/report/{id}', [ListRequestController::class, 'report']);
    Route::get('/approve', [ListRequestController::class, 'approve'])->name('approve.request');
    Route::get('/reject', [ListRequestController::class, 'reject']);
    Route::resource('list_request', ListRequestController::class);

    Route::get('/engagement', [ChartController::class, 'engagement'])->name('engagement');
    Route::get('/status_request', [ChartController::class, 'status_request'])->name('status.request');
});
