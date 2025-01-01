<?php

use App\Http\Controllers\AppControllers\GuestBlogController;
use App\Http\Controllers\AppControllers\GuestBulletinsController;
use App\Http\Controllers\AppControllers\GuestLocalGuideController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppControllers\AuthController;
use App\Http\Controllers\AppControllers\AdminBlogController;
use App\Http\Controllers\AppControllers\AdminLocalGuideController;
use App\Http\Controllers\AppControllers\AdminPhotoAlbumController;
use App\Http\Controllers\AppControllers\GuestPhotoAlbumController;

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
Route::post('register', [AuthController::class, 'register']);
Route::get('house-list', [AuthController::class, 'houseList']);
Route::get('countries-list', [AuthController::class, 'countriesList']);
Route::get('states-list', [AuthController::class, 'statesList']);

// Guest-related Routes
Route::controller(GuestController::class)
    ->prefix('guest')
    ->group(function () {
        // Protected Routes
        Route::middleware('auth:sanctum')->group(function () {
            // Blog Routes
            Route::controller(GuestBlogController::class)
                ->prefix('blog')
                ->group(function () {
                    Route::get('/blog-list', 'blogList');
                    Route::get('/show', 'show');
                });

            // Local Guide Routes
            Route::controller(GuestLocalGuideController::class)
                ->prefix('local-guide')
                ->group(function () {
                    Route::get('/local-guide-list', 'localGuideList');
                    Route::get('/show', 'show');
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
                    Route::get('/photo-list', 'photoList');
                });

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
        Route::controller(AdminBlogController::class)
            ->prefix('/blog')
            ->group(function () {
                Route::get('/blog-list', 'blogList');
                Route::post('/create', 'createBlog');
                Route::delete('/delete', 'destroy');
            });

        Route::controller(AdminLocalGuideController::class)
            ->prefix('/local-guide')
            ->group(function () {
                Route::get('/local-guide-list', 'LocalGuideList');
                Route::post('/create', 'createLocalGuide');
                Route::delete('/delete', 'destroy');
            });

        Route::controller(AdminPhotoAlbumController::class)
            ->prefix('/photo-album')
            ->group(function () {
                Route::get('/albums-list', 'albumsList');
                Route::get('/album-photos', 'albumPhotos');
                Route::post('/create-photo', 'createNewPhoto');
                Route::delete('/delete-photo', 'destroyPhoto');
            });
    });
