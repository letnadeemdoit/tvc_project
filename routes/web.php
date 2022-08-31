<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BulletinBoardController;
use App\Http\Controllers\GuestBookController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\PhotoAlbumController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HouseItemController;
use App\Http\Controllers\LocalGuideController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\BulletinBoard\BulletinCards\Cards;
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
//        Route::get('/blog-cards','blog')->name('blog');
//      Route::get('/blog-details/{BlogId}','blogDetails')->name('blog-details');
        Route::get('/privacy-policy', 'PrivacyPolicy')->name('privacy-policy');
//        Route::get('/guest-login','guestLogin')->name('guest-login');
//        Route::get('/book-cards','guestBook')->name('guest-book');
//        Route::get('/login-account','loginAccount')->name('login-account');
        Route::get('/search-house', 'searchHouse')->name('search-house');
        Route::get('/bulletin/{HouseId}', [Cards::class, 'cardItem'])->name('card');
//        Route::get('/guest-book-frontend','guestBookFrontend')->name('guest-book-frontend');
        Route::get('/local-guide', 'localGuide')->name('local-guide');
        Route::get('/photo-album', 'photoAlbum')->name('photo-album');
        Route::get('/single-album', 'singleAlbum')->name('single-album');


        Route::controller(BlogController::class)
            ->prefix('blog')
            ->name('blog.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{post:slug}', 'show')->name('show');
            });
        Route::get('/blog-details/{BlogId}', [BlogDetail::class])->name('blog-details');


        Route::controller(GuestBookController::class)
            ->prefix('guest-book')
            ->name('guest-book.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
            });

        Route::controller(LocalGuideController::class)
            ->prefix('local-guide')
            ->name('local-guide.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{dt:id}', 'show')->name('show');
            });

        Route::controller(BulletinBoardController::class)
            ->prefix('bulletin-board')
            ->name('bulletin-board.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
            });

        Route::controller(HouseItemController::class)
            ->prefix('house-items')
            ->name('house-items.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
            });
        Route::controller(PhotoAlbumController::class)
            ->prefix('photo-album')
            ->name('photo-album.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{album:name}', 'show')->name('show');
            });

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
    'auth',
    config('jetstream.auth_session'),
    'verified'
])
    ->name('dash.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
        Route::get('/calendar', [DashboardController::class, 'calendar'])->name('calendar');

        Route::resource('users', UserController::class);
        Route::get('/blogs', [DashboardController::class, 'blogs'])->name('blogs');
        Route::get('/houses', [DashboardController::class, 'houses'])->name('houses');

//        Route::get('/photo-albums-old', [DashboardController::class, 'photoAlbum'])->name('photo-albums-old');
//        Route::get('/photo-albums-old/show/{id}', [DashboardController::class, 'showSingleAlbum'])->name('show-single-album-old');


        Route::get('/photo-albums', [DashboardController::class, 'photoAlbums'])->name('photo-albums');
        Route::get('/photo-albums/{id}/photos', [DashboardController::class, 'photos'])->name('photo-albums.photos');


        Route::get('/bulletins', [DashboardController::class, 'bulletins'])->name('bulletins');
//        Route::get('/bulletin-boards', [DashboardController::class, 'bulletinBoard'])->name('bulletin-board');
        Route::get('/local-guides', [DashboardController::class, 'localGuide'])->name('local-guide');
        Route::get('/notifications', [DashboardController::class, 'notifications'])->name('notifications');
        Route::get('/food-item-list', [DashboardController::class, 'foodItemList'])->name('food-item-list');
        Route::get('/shopping-item-list', [DashboardController::class, 'shoppingItemList'])->name('shopping-item-list');
        Route::get('/plans-and-pricing', [DashboardController::class, 'planAndPricing'])->name('plans-and-pricing');
        Route::put('/current-house', [DashboardController::class, 'switchHouse'])->name('switch-house');
        Route::controller(\App\Http\Controllers\SettingController::class)
            ->prefix('settings')
            ->name('settings.')
            ->group(function () {
                Route::redirect('/', '/settings/account-information');
                Route::get('account-information', 'accountInformation')->name('account-information');
                Route::get('billing', 'billing')->name('billing');
                Route::get('users', 'users')->name('users');
                Route::get('rooms', 'rooms')->name('rooms');
                Route::get('additional-houses', 'additionalHouses')->name('additional-houses');
                Route::get('house-setting', 'houseSetting')->name('house-setting');
                Route::get('notifications', 'notifications')->name('notifications');
                Route::get('vacations', 'vacations')->name('vacations');
                Route::get('bulletin-boards', 'bulletinBoard')->name('bulletin-boards');
                Route::get('audit-history', 'auditHistory')->name('audit-history');
                Route::get('blog', 'blog')->name('blog');
                Route::get('category', 'category')->name('category');
                Route::get('guest-books', 'guestBook')->name('guest-books');
            });

        Route::controller(\App\Http\Controllers\PaypalController::class)
            ->prefix('paypal')
            ->name('paypal.')
            ->group(function () {
                Route::get('/{plan}/processing', 'process')->name('process');
                Route::get('/{plan}/{house}/succeeded', 'succeeded')->name('succeeded');
                Route::get('/{plan}/{house}/canceled', 'canceled')->name('canceled');
                Route::get('/ipn', 'ipn')->name('ipn');
            });
    });

