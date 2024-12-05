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
use App\Http\Controllers\SuperAdminController;
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
        Route::get('/pricing', 'pricing')->name('pricing');
        Route::get('/terms-of-service', 'termsService')->name('terms-of-service');
        Route::get('/privacy-policy', 'PrivacyPolicy')->name('privacy-policy');
        Route::get('/ical/{ical:slug}', 'ical')->name('ical');

        Route::post('/house-data', 'getHouseImage')->name('get-house-data');




        Route::middleware(['auth'])->group(function () {
            Route::get('/guest-calendar', 'calendar')->name('guest-calendar');
            Route::get('/guest-request-to-join-vacation', 'requestToJoinVacation')->name('guest-request-to-join-vacation');
            Route::get('/search-house', 'searchHouse')->name('search-house');
//            Route::get('/bulletin/{HouseId}', [Cards::class, 'cardItem'])->name('card');
            Route::get('/local-guide', 'localGuide')->name('local-guide');
            Route::get('/single-album', 'singleAlbum')->name('single-album');
            Route::get('/album-photo', 'photoGalleryView')->name('album-photo');

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
                ->prefix('photo-albums')
                ->name('photo-album.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                });
        });

        Route::post('/paypal/ipn', 'paypalIPN')->name('paypal-ipn');
    });


Route::controller(\App\Http\Controllers\Select2Controller::class)
    ->name('select2.')
    ->prefix('select2')
    ->group(function () {
        Route::get('houses', 'houses')->name('houses');
    });

require_once __DIR__ . '/fortify.php';

Route::get('/super-admin/login', [SuperAdminController::class, 'index'])->name('super-admin.login');
Route::post('/super-admin/login', [SuperAdminController::class, 'login'])->name('super-admin.login-super-admin');
Route::get('/super-admin/manage-users', [SuperAdminController::class, 'manageUsers'])->name('super-admin.manage-users')->middleware('auth');

Route::get('/super-admin/forgot-password', [SuperAdminController::class, 'forgotPassword'])->name('super-admin.forgot-password');
Route::post('/super-admin/reset-super-admin-password', [SuperAdminController::class, 'resetSuperAdminPassword'])->name('reset-super-admin-password');

Route::middleware([
    'auth',
    config('jetstream.auth_session'),
    'verified',
    'check-subscription-status',
    'check.primary-user.subscribed-any-plan'
])
    ->name('dash.')
    ->group(function () {
//        Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');

        Route::get('/schedule-vacation', [DashboardController::class, 'scheduleVacation'])->name('schedule-vacation');
        Route::get('/schedule-vacation-room', [DashboardController::class, 'scheduleVacationRoom'])->name('schedule-vacation-room');
        Route::get('/request-to-join-vacation', [DashboardController::class, 'requestToJoinVacation'])->name('request-to-join-vacation');
        Route::get('/schedule-calendar-task', [DashboardController::class, 'scheduleCalendarTask'])->name('schedule-calendar-task');
        Route::get('/calendar', [DashboardController::class, 'calendar'])->name('calendar');
        Route::resource('users', UserController::class);
        Route::get('/blogs', [DashboardController::class, 'blogs'])->name('blogs');
        Route::get('/houses', [DashboardController::class, 'houses'])->name('houses');
        Route::get('/manage-albums', [DashboardController::class, 'photoAlbums'])->name('photo-albums');
        Route::get('/manage-albums/{id}/photos', [DashboardController::class, 'photos'])->name('photo-albums.photos');
        Route::get('/bulletins', [DashboardController::class, 'bulletins'])->name('bulletins');

        Route::get('/local-guides', [DashboardController::class, 'localGuide'])->name('local-guide');

        Route::get('manage-bulletin-boards', [DashboardController::class, 'manageBulletinBoard'])->name('manage-bulletin-boards');
        Route::get('manage-blogs', [DashboardController::class,'manageBlog'])->name('manage-blogs');
        Route::get('manage-guest-books', [DashboardController::class,'guestBook'])->name('manage-guest-books');

        Route::get('/notifications', [DashboardController::class, 'notifications'])->name('notifications');
        Route::get('/notification/{id}', [DashboardController::class, 'markAsReadSingleNotification'])->name('mark-as-read-single-notification');
        Route::get('/notifications/mark-as-read', [DashboardController::class, 'markAsReadNotifications'])->name('mark-as-read-notifications');
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
                Route::get('calendar-settings', 'calendarSettings')->name('calendar-settings');
                Route::get('billing', 'billing')->name('billing');
                Route::get('users', 'users')->name('users');
                Route::get('rooms', 'rooms')->name('rooms');
                Route::get('additional-houses', 'additionalHouses')->name('additional-houses');
                Route::get('house-setting', 'houseSetting')->name('house-setting');
                Route::get('notifications', 'notifications')->name('notifications');
                Route::get('vacations', 'vacations')->name('vacations');
                Route::get('vacation-request-approval', 'vacationRequestApproval')->name('vacation-request-approval');
                Route::get('audit-history', 'auditHistory')->name('audit-history');
                Route::get('category', 'category')->name('category');
                Route::get('unsubscribe-plan', 'unsubscribePlan')->name('unsubscribe-plan');
            });

        Route::controller(\App\Http\Controllers\PaypalController::class)
            ->prefix('paypal')
            ->name('paypal.')
            ->group(function () {
                Route::get('/{plan}/{billed}/processing', 'process')->name('process');
                Route::get('/{plan}/{billed}/succeeded', 'succeeded')->name('succeeded');
                Route::get('/{plan}/{billed}/canceled', 'canceled')->name('canceled');
                Route::get('/{plan}/{billed}/revise', 'reviseSubscription')->name('revise');
//                Route::post('/ipn', 'ipn')->name('ipn');
            });
    });
