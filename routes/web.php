<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeSliderController;

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
    return view('frontend.index');    
});

Route::controller(AdminController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/admin/logout', 'destroy')->name('admin.logout'); 
    Route::get('/admin/profile', 'profile')->name('admin.profile'); 
    Route::get('/edit/profile', 'editProfile')->name('edit.profile');
    Route::post('/store/profile', 'updateProfile')->name('update.profile');
    Route::get('/change/password', 'ChangePassword')->name('change.password');
    Route::post('/update/password', 'UpdatePassword')->name('update.password');
});

Route::controller(HomeSliderController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/home/slide', 'HomeSlider')->name('home.slide');
    Route::get('/home/slide/create', 'CreateSlider')->name('home.slide.create');
    Route::post('/home/slide/store', 'StoreSlider')->name('home.slide.store');
    Route::put('/home/slide/{slide}', 'UpdateSlider')->name('home.slide.update');
});

require __DIR__.'/auth.php';
