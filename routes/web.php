<?php

use App\Http\Controllers\AboutController;
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

Route::controller(AboutController::class)->group(function(){
    Route::get('/about/page', 'AboutPage')->name('about.page');
    Route::post('/update/about', 'UpdateAbout')->name('update.about');
    Route::get('/about', 'HomeAbout')->name('home.about');
    Route::get('/about/multi/image', 'AboutMultiImage')->name('about.multi.image');
    Route::post('/store/multi/image', 'StoreMultiImage')->name('store.multi.image');
    Route::get('/all/multi/image', 'AllMultiImage')->name('all.multi.image');
    Route::get('/edit/multi/image/{id}', 'EditMultiImage')->name('edit.multi.image');
    Route::post('/update/multi/image', 'UpdateMultiImage')->name('update.multi.image');
    Route::get('/delete/multi/image/{id}', 'DeleteMultiImage')->name('delete.multi.image');
});
require __DIR__.'/auth.php';
