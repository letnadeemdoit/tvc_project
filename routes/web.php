<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\UserController;
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
        Route::get('/blog-cards','blog')->name('blog.card');
        Route::get('/bulletin-cards','bulletinBoard')->name('bulletinBoard');
        Route::get('/privacy-policy','PrivacyPolicy')->name('privacy-policy');
        Route::get('/guest-login','guestLogin')->name('guest-login');
        Route::get('/book-cards','guestBook')->name('guest-book');
        Route::get('/login-account','loginAccount')->name('login-account');
        Route::get('/search-house','searchHouse')->name('search-house');
        Route::get('/card', 'card')->name('card');
    });

Route::controller(\App\Http\Controllers\Select2Controller::class)
    ->name('select2.')
    ->prefix('select2')
    ->group(function () {
        Route::get('houses', 'houses')->name('houses');
    });




require_once __DIR__ . '/fortify.php';
//
//Route::get('/dashboard', function () {
//    return view('dash.index');
//})->name('dashboard');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])
    ->name('dash.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');


        Route::resource('users', UserController::class);

        Route::get('/blogs', [DashboardController::class, 'blogs'])->name('blogs');
        Route::get('/houses', [DashboardController::class, 'houses'])->name('houses');
        Route::get('/photo-albums', [DashboardController::class, 'photoAlbum'])->name('photo-albums');
        Route::get('/photo-albums/show/{id}', [DashboardController::class, 'showSingleAlbum'])->name('show-single-album');
        Route::resource('/guest-book', GuestBookController::class);
        Route::resource('bulletins', BulletinController::class);

        Route::get('/bulletin/{HouseId}', [Cards::class, 'cardItem'])->name('card');

        Route::controller(\App\Http\Controllers\ManageAccountController::class)
            ->prefix('account')
            ->name('account.')->group(function () {
                Route::get('/settings', 'settings')->name('settings');
                Route::get('/subscriptions', 'subscriptions')->name('subscriptions');
                Route::get('/invoices', 'invoices')->name('invoices');
            });
    });
