<?php

use App\Http\Controllers\FederationController;
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
    Route::get('/account-settings', [PageRendererController::class, 'showAccountSettingsPage'])->name('user.account-settings');
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
        Route::get('/admin/federations', [PageRendererController::class, 'showAdminTradeFederationsPage'])->name('admin.trade-federations');
        Route::get('/admin/add-federation', [PageRendererController::class, 'showAdminCreateFederationpage'])->name('admin.add-federations');
        Route::post('/admin/createFederation', [FederationController::class, 'createFederation'])->name('admin.create-federation');
        Route::patch('/admin/federations/updatestatus', [FederationController::class, 'updateStatus'])->name('admin.trade-federations.update-status');
        Route::get('/admin/federation-details', [PageRendererController::class, 'showAdminTradeFederationDetailsPage'])->name('admin.trade-federation-details');
        Route::get('/admin/federation-region-destributions', [PageRendererController::class, 'showAdminTradeFederationRegionDestributionsPage'])->name('admin.trade-federation-region-destributions');
        Route::get('/admin/federation-officers', [PageRendererController::class, 'showAdminTradeFederationOfficersPage'])->name('admin.trade-federation-officers');
        Route::get('/admin/federation-cba-provisions', [PageRendererController::class, 'showAdminTradeFederationCBAProvisionsPage'])->name('admin.trade-federation-cba-provisions');

        Route::get('/admin/federation-point-persons', [PageRendererController::class, 'showAdminTradeFederationPointPersonsPage'])->name('admin.federation-point-persons');
        Route::get('/admin/add-federation-point-persons', [PageRendererController::class, 'showAdminCreateTradeFederationPointPersonsPage'])->name('admin.add-federation-point-persons');   
        Route::post('/user/create', [UserController::class, 'updateStatus'])->name('user.create');

        // Update Statuses
        Route::patch('/federations/update', [FederationController::class, 'updateFederation'])->name('admin.trade-federation-update');
        Route::patch('/user/update-status', [UserController::class, 'updateStatus'])->name('admin.federation-user-update');
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
