<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageRendererController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // USER
    Route::get('/accout-settings', [PageRendererController::class, 'showAccountSettingsPage'])->name('user.account-settings');
    Route::patch('/user/update', [UserController::class, 'updateUser'])->name('user.update');
    Route::patch('/user/updatePassword', [UserController::class, 'updateUserPassword'])->name('user.update-password');

    // SUPER-ADMIN
    Route::middleware('checkUserRole:1')->group(function () {
        Route::get('/super-admin', [PageRendererController::class, 'showSuperAdminBlankPage'])->name('super-admin.users');
    });
    
    // ADMIN
    Route::middleware('checkUserRole:2')->group(function () {
        Route::get('/admin/local-unions', [PageRendererController::class, 'showAdminLocalUnionsPage'])->name('admin.local-unions');
        Route::get('/admin/users', [PageRendererController::class, 'showAdminUsersPage'])->name('admin.users');
        Route::get('/admin/user-details', [PageRendererController::class, 'showAdminUserDetialsPage'])->name('admin.user-details');
    });

    // FEDERATION-POINT-PERSON
    Route::middleware('checkUserRole:3')->group(function () {       
        Route::get('/federation-point-person', [PageRendererController::class, 'showFederationProfilePage'])->name('federation-point-person.profile');
    });

    // UNION-POINT-PERSON
    Route::middleware('checkUserRole:4')->group(function () {
        Route::get('/union-point-person/union-profile', [PageRendererController::class, 'showUnionProfilePage'])->name('union-point-person.profile');
    });
});

Route::get('/unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');


require __DIR__.'/auth.php';
