<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', function () {
    return redirect()->route('home');
});

Route::group(['middleware' => ['role:admin']], function (): void {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/vr/list', [\App\Http\Controllers\Admin\VrController::class, 'vrList'])->name('vr_list');
    Route::get('/tour-agency', [\App\Http\Controllers\Admin\AgencyController::class, 'index'])->name('agency_list');
    Route::get('/moderation/identification', [\App\Http\Controllers\Admin\ModerationController::class, 'identificationModerationList'])->name('moder_identification');
    Route::get('/moderation/vr', [\App\Http\Controllers\Admin\ModerationController::class, 'vrModerationList'])->name('moder_vr');
    Route::get('/payments', [App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('payments');
    Route::get('/course/category', [\App\Http\Controllers\Admin\CourseController::class, 'categories'])->name('course_categories');
    Route::get('/product/category', [\App\Http\Controllers\Admin\ProductController::class, 'categories'])->name('product_categories');
    Route::resource('user', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('course', \App\Http\Controllers\Admin\CourseController::class);
    Route::resource('region', \App\Http\Controllers\Admin\RegionController::class);
    Route::resource('country', \App\Http\Controllers\Admin\CountyController::class);
    Route::resource('city', \App\Http\Controllers\Admin\CityController::class);
    Route::resource('product', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('pocket', \App\Http\Controllers\Admin\PocketController::class);
});
