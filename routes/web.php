<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageRendererController;
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

    // SUPER-ADMIN
    Route::middleware('checkUserRole:1')->group(function () {
        Route::get('/super-admin', [PageRendererController::class, 'showSuperAdminBlankPage'])->name('super-admin.users');
    });
    
    // ADMIN
    Route::middleware('checkUserRole:2')->group(function () {
        Route::get('/admin', [PageRendererController::class, 'showAdminBlankPage'])->name('admin.local-unions');
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
