<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PermissionRoleController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });






Route::domain(config('app.domain'))->group(function () {

    
    Route::group(['middleware' =>'admin.guest'], function () {
        Route::get('/', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.dologin');
        
    });

    Route::group(['middleware' =>'admin.auth'], function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'showDashboard'])->name('admin.dashboard');
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        Route::resource('admin_user', AdminUserController::class);
        Route::post('/admin_user/{id}/active-status', [AdminUserController::class, 'livePause'])->name('admin_user.activeStatus');

        Route::resource('role', RoleController::class);
        Route::post('/role/{id}/active-status', [RoleController::class, 'livePause'])->name('role.activeStatus');

        Route::resource('permission', PermissionController::class);
        Route::post('/permission/{id}/active-status', [PermissionController::class, 'livePause'])->name('permission.activeStatus');

        Route::resource('permission_role', PermissionRoleController::class);
        Route::post('/permission_role/{id}/active-status', [PermissionRoleController::class, 'livePause'])->name('permission_role.activeStatus');
        Route::get('/get-permissions/{roleId}', [PermissionRoleController::class, 'getAllPermissions']);

        
        
    });
    
});