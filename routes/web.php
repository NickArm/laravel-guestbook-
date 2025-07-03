<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ApplianceController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyPdfController;
use App\Http\Controllers\RecommendationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::redirect('/', '/login');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
        Route::put('/password', 'updatePassword')->name('password.update');
    });

    // Properties Routes
    Route::controller(PropertyController::class)->prefix('properties')->name('properties.')->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{property}/edit', 'edit')->name('edit');
        Route::put('/{property}', 'update')->name('update');
        Route::delete('/{property}', 'destroy')->name('destroy');
        Route::patch('/{property}/toggle', 'toggleActive')->name('toggle');
        Route::delete('/{property}/images/{image}', 'deleteImage')->name('image.delete');
    });

    // Property PDF Routes
    Route::controller(PropertyPdfController::class)->group(function () {
        Route::get('/properties/{property}/pdf-preview', 'generate')->name('properties.pdf');
        Route::get('/property/{property}/preview', 'preview')->name('property.preview');
    });

    // Recommendations Routes
    Route::controller(RecommendationController::class)->group(function () {
        Route::prefix('recommendations')->name('recommendations.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{recommendation}/edit', 'edit')->name('edit');
            Route::put('/{recommendation}', 'update')->name('update');
            Route::delete('/{recommendation}', 'destroy')->name('destroy');
        });

        // Property-specific recommendations
        Route::prefix('properties/{property}/recommendations')->name('properties.recommendations.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/sync', 'syncPropertyRecommendations')->name('sync');
        });
    });

    // Appliances Routes
    Route::controller(ApplianceController::class)
        ->prefix('properties/{property}/appliances')
        ->name('properties.appliances.')
        ->group(function () {
            Route::post('/', 'store')->name('store');
            Route::get('/{appliance}/edit', 'edit')->name('edit');
            Route::put('/{appliance}', 'update')->name('update');
            Route::delete('/{appliance}', 'destroy')->name('destroy');
        });
});

/*
|--------------------------------------------------------------------------
| Superadmin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'is_superadmin'])
    ->controller(UserController::class)
    ->prefix('admin')
    ->name('admin.users.')
    ->group(function () {
        Route::get('/users', 'index')->name('index');
        Route::get('/users/create', 'create')->name('create');
        Route::post('/users', 'store')->name('store');
        Route::get('/users/{user}/edit', 'edit')->name('edit');
        Route::put('/users/{user}', 'update')->name('update');
        Route::patch('/users/{user}/toggle', 'toggleStatus')->name('toggle');
        Route::patch('/properties/{property}/change-owner', 'transferOwnership')->name('transferOwnership');
    });

/*
|--------------------------------------------------------------------------
| Public Pages Routes
|--------------------------------------------------------------------------
*/
Route::view('/faqs', 'pages.faqs')->name('pages.faqs');
Route::get('/contact', fn () => view('pages.contact'))->name('pages.contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
