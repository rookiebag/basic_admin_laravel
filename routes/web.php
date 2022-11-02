<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AdminController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/admin/logout', 'destroy')->name('admin.logout'); 
});
require __DIR__.'/auth.php';
