<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrganizationController;

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

Route::middleware([
    'splade'
])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::prefix('admin')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'splade'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::name('master-data.')->group(function () {
        Route::resource('organizations', OrganizationController::class);
    });
});
