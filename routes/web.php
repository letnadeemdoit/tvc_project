<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\BulletinController;
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

Route::controller(GuestController::class)
    ->name('guest.')
    ->group(function () {
        Route::get('/', 'welcome')->name('welcome');
        Route::get('/contact', 'contact')->name('contact');
        Route::post('/contact', 'contactMail')->name('contact.mail');
        Route::get('/policies', 'policies')->name('policies');
        Route::get('/help', 'help')->name('help');
        Route::get('/blog','blog')->name('blog');
        Route::get('/bulletin','bulletinBoard')->name('bulletinBoard');
        Route::get('/privacy-policy','PrivacyPolicy')->name('privacy-policy');
    });


Route::resource('blogs', BlogController::class);
Route::resource('bulletin', BulletinController::class);

Route::get('/dashboard', function () {
    return view('dash.index');
})->name('dashboard');


//Route::middleware([
//    'auth:sanctum',
//    config('jetstream.auth_session'),
//    'verified'
//])->group(function () {
//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    })->name('dashboard');
//});
