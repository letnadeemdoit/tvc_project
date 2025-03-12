<?php

use App\Http\Controllers\AppControllers\AdminNotificationsController;
use App\Http\Controllers\AppControllers\GuestBlogController;
use App\Http\Controllers\AppControllers\GuestBulletinsController;
use App\Http\Controllers\AppControllers\GuestLocalGuideController;
use App\Http\Controllers\AppControllers\RequestToJoinVacationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppControllers\AuthController;
use App\Http\Controllers\AppControllers\AdminBlogController;
use App\Http\Controllers\AppControllers\AdminLocalGuideController;
use App\Http\Controllers\AppControllers\AdminGuestBookController;
use App\Http\Controllers\AppControllers\AdminFoodItemsController;
use App\Http\Controllers\AppControllers\VacationApprovalController;
use App\Http\Controllers\AppControllers\PaypalController;
use App\Http\Controllers\AppControllers\UserProfileController;
use App\Http\Controllers\AppControllers\CalendarViewController;
use App\Http\Controllers\AppControllers\CalendarTaskController;
use App\Http\Controllers\AppControllers\VacationRoomsController;
use App\Http\Controllers\AppControllers\GuestPhotoAlbumController;
use App\Http\Controllers\AppControllers\GuestFoodItemsController;
use App\Http\Controllers\AppControllers\GuestBookController;
use App\Http\Controllers\AppControllers\CalendarSettingsController;
use App\Http\Controllers\AppControllers\HouseSettingsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Authenticated User
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Authentication Routes
Route::post('login', [AuthController::class, 'login']);
Route::post('guest-login', [AuthController::class, 'guestLogin']);
Route::post('register', [AuthController::class, 'register']);
Route::get('house-list', [AuthController::class, 'houseList']);
Route::get('countries-list', [AuthController::class, 'countriesList']);
Route::get('states-list', [AuthController::class, 'statesList']);

Route::prefix('guest')->middleware('auth:sanctum')->group(function () {
    // Blog Routes
    Route::controller(GuestBlogController::class)
        ->prefix('blog')
        ->group(function () {
            Route::get('/blog-list', 'blogList');
            Route::post('/create', 'createBlog');
            Route::delete('/delete', 'destroy');
            Route::get('/show', 'show');
            Route::post('/like-blog', 'likeBlog');
            Route::post('/blog-comment', 'addBlogComment');
            Route::delete('/delete-blog-comment', 'deleteBlogComment');
        });

    // Local Guide Routes
    Route::controller(GuestLocalGuideController::class)
        ->prefix('local-guide')
        ->group(function () {
            Route::get('/local-guide-list', 'localGuideList');
            Route::post('/create', 'createLocalGuide');
            Route::delete('/delete', 'destroy');
            Route::get('/show', 'show');
            Route::post('/add-review', 'addReview');
            Route::delete('/delete-review', 'deleteReview');
        });

    // Bulletins Routes
    Route::controller(GuestBulletinsController::class)
        ->prefix('bulletin')
        ->group(function () {
            Route::get('/bulletin-list', 'bulletinList');
        });

    // Photo Album Routes
    Route::controller(GuestPhotoAlbumController::class)
        ->prefix('photo-album')
        ->group(function () {
            Route::get('/albums-list', 'albumsList');
            Route::get('/album-photos', 'photoList');
            Route::post('/create-photo', 'createNewPhoto');
            Route::delete('/delete-photo', 'destroyPhoto');

        });

    // Food Items Routes
    Route::controller(GuestFoodItemsController::class)
        ->prefix('food-items')
        ->group(function () {
            Route::get('/food-list', 'foodList');
            Route::post('/create-food', 'createFood');
            Route::delete('/delete-food', 'destroyFood');

            Route::get('/shopping-list', 'shoppingList');
            Route::post('/create-shopping', 'createShopping');
            Route::delete('/delete-shopping', 'destroyShopping');
        });

    // Guest Book Routes
    Route::controller(GuestBookController::class)
        ->prefix('guest-book')
        ->group(function () {
            Route::get('/guest-book-list', 'guestBookList');
            Route::post('/create-guest-book', 'createGuestBook');
            Route::delete('/delete-guest-book', 'deleteGuestBook');
        });

    // Calendar Setting Routes
    Route::controller(CalendarSettingsController::class)
        ->prefix('calendar-settings')
        ->group(function () {
            Route::get('/get-calendar-and-user-settings', 'getCalendarSettings');
        });

    // Calendar Setting Routes
    Route::controller(AuthController::class)
        ->prefix('user')
        ->group(function () {
            Route::get('/auth-user', 'getAuthUser');
        });

    Route::controller(UserProfileController::class)
        ->prefix('/profile')
        ->group(function () {
            Route::get('/user', 'getUser');
            Route::post('/update-picture', 'updateProfilePicture');
            Route::post('/update-basic-info', 'updateBasicInfo');
            Route::post('/update-email', 'updateEmailAddress');
            Route::post('/update-admin-password', 'updateAdminPassword');
            Route::post('/update-guest-password', 'updateGuestPassword');
            Route::post('/update-preferences', 'updatePreferences');
            Route::post('/logout-other-browsers', 'logoutOtherBrowsers');
        });


});

// Dashboard Routes
Route::middleware([
    'auth:sanctum',
    'verified',
    'check-subscription-status',
    'check.primary-user.subscribed-any-plan'
])
    ->prefix('dash')
    ->group(function () {

        Route::controller(AdminNotificationsController::class)
            ->prefix('/notifications')
            ->group(function () {
                Route::get('/notifications-list', 'notificationsList');
                Route::get('/read-notification', 'readNotification');
                Route::get('/read-all-notifications', 'readAllNotifications');
            });

        Route::controller(CalendarViewController::class)
            ->prefix('/calendar')
            ->group(function () {
                Route::post('/events', 'getVacations');
                Route::get('/house-properties', 'houseRelevantProperties');
                Route::get('/rooms', 'getRooms');
                Route::post('/create-vacation', 'saveVacations');
                Route::delete('/delete-event', 'deleteCalendarEvent');
            });

        Route::controller(CalendarTaskController::class)
            ->prefix('/task')
            ->group(function () {
                Route::post('/create-task', 'createTask');
                Route::delete('/delete-task', 'deleteTask');
            });

        Route::controller(VacationRoomsController::class)
            ->prefix('/vacation-room')
            ->group(function () {
                Route::get('/vacations-and-rooms-list', 'getRoomsList');
                Route::get('/change-vacation', 'getSpecificVacation');
                Route::get('/change-room', 'getSpecificVacationRoom');
                Route::post('/create', 'createVacationRoom');
                Route::delete('/delete', 'deleteVacationRoom');
            });

        Route::controller(VacationApprovalController::class)
            ->prefix('/vacation-approval')
            ->group(function () {
                Route::get('/vacation-list', 'getVacationList');
                Route::post('/is-approve', 'approveVacation');
                Route::delete('/reject-vacation', 'rejectVacation');
            });

        Route::controller(PaypalController::class)
            ->prefix('/paypal')
            ->group(function () {
//                Route::get('/plans-and-pricing', 'planAndPricing');
                Route::get('/revise', 'processSubscription');
                Route::get('/canceled', 'canceledSubscription');

            });

        Route::controller(HouseSettingsController::class)
            ->prefix('/house-settings')
            ->group(function () {
                Route::get('/house-details', 'getHouseDetails');
                Route::post('/update-house-settings', 'updateHouseSettings');
            });


        // Request To Join Vacation Routes
        Route::controller(RequestToJoinVacationController::class)
            ->prefix('vacation')
            ->group(function () {
                Route::post('/request-to-join', 'RequestToJoinVacation');
                Route::post('/request-to-use-house', 'RequestToUseHouse');
            });


    });


Route::middleware([
    'auth:sanctum'
])
    ->prefix('dash')
    ->group(function () {
        Route::controller(PaypalController::class)
            ->prefix('/paypal')
            ->group(function () {
                Route::get('/process', 'processSubscription');
                Route::get('/plans-and-pricing', 'planAndPricing');
                Route::get('/reset', 'resetSubscription');

            });
    });
