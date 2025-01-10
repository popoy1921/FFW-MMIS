<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // SUPER-ADMIN
    Route::middleware('checkUserRole:1')->group(function () {
        Route::get('/super-admin/blank', [ProfileController::class, 'edit'])->name('super-admin.blank');
    });
    
    // ADMIN
    Route::middleware('checkUserRole:2')->group(function () {
        Route::get('/admin/blank', [ProfileController::class, 'edit'])->name('admin.blank');
    });

    // FEDERATION-POINT-PERSON
    Route::middleware('checkUserRole:3')->group(function () {
        Route::get('/federation-point-person/blank', [ProfileController::class, 'edit'])->name('federation-point-person.blank');
    });

    // UNION-POINT-PERSON
    Route::middleware('checkUserRole:4')->group(function () {
        Route::get('/union-point-person/blank', [ProfileController::class, 'edit'])->name('union-point-person.blank');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');


require __DIR__.'/auth.php';
