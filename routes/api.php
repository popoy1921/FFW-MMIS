<?php

use App\Http\Controllers\FederationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FederationOfficerController;
use App\Http\Controllers\ProvisionController;
use App\Http\Controllers\RegionalDistributionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user/userDetails', [UserController::class, 'getUserDetails'])->name('api.user.user-details');
Route::get('/user/getList', [UserController::class, 'getList'])->name('api.user.list');
Route::get('/federation/getList', [FederationController::class, 'getList'])->name('api.federation.list');
Route::get('/federation-officer/getList', [FederationOfficerController::class, 'getList'])->name('api.federation-officers.list');
Route::get('/federation-distribution/getList', [RegionalDistributionController::class, 'getList'])->name('api.regional-distribution.list');
Route::get('/provision/getList', [ProvisionController::class, 'getList'])->name('api.provision.list');