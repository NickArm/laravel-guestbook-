<?php

use App\Http\Controllers\Admin\UserController;
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

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

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

    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    // Properties
    Route::prefix('properties')->name('properties.')->group(function () {
        Route::get('/create', [PropertyController::class, 'create'])->name('create');
        Route::post('/', [PropertyController::class, 'store'])->name('store');
        Route::get('/{property}/edit', [PropertyController::class, 'edit'])->name('edit');
        Route::put('/{property}', [PropertyController::class, 'update'])->name('update');
        Route::delete('/{property}', [PropertyController::class, 'destroy'])->name('destroy');
        Route::patch('/{property}/toggle', [PropertyController::class, 'toggleActive'])->name('toggle');
    });
    Route::delete('/properties/{property}/images/{image}', [PropertyController::class, 'deleteImage'])->name('properties.image.delete');
    Route::get('/properties/{property}/pdf-preview', [PropertyPdfController::class, 'generate'])->name('properties.pdf');
    Route::get('/property/{property}/preview', [PropertyPdfController::class, 'preview'])->name('property.preview');

    Route::get('/recommendations', [RecommendationController::class, 'index'])->name('recommendations.index');
    Route::get('/recommendations/create', [RecommendationController::class, 'create'])->name('recommendations.create');
    Route::post('/recommendations', [RecommendationController::class, 'store'])->name('recommendations.store');
    Route::get('/recommendations/{recommendation}/edit', [RecommendationController::class, 'edit'])->name('recommendations.edit');
    Route::put('/recommendations/{recommendation}', [RecommendationController::class, 'update'])->name('recommendations.update');
    Route::delete('/recommendations/{recommendation}', [RecommendationController::class, 'destroy'])->name('recommendations.destroy');

    Route::get('/properties/{property}/recommendations', [RecommendationController::class, 'index'])->name('properties.recommendations.index');
    Route::post('/properties/{property}/recommendations/sync', [RecommendationController::class, 'syncPropertyRecommendations'])->name('properties.recommendations.sync');

});

Route::prefix('properties/{property}/appliances')->name('properties.appliances.')->middleware(['auth'])->group(function () {
    Route::post('/', [App\Http\Controllers\ApplianceController::class, 'store'])->name('store');
    Route::get('/{appliance}/edit', [App\Http\Controllers\ApplianceController::class, 'edit'])->name('edit');
    Route::put('/{appliance}', [App\Http\Controllers\ApplianceController::class, 'update'])->name('update');
    Route::delete('/{appliance}', [App\Http\Controllers\ApplianceController::class, 'destroy'])->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Superadmin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'is_superadmin'])
    ->prefix('admin')
    ->name('admin.users.')
    ->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('index');
        Route::get('/users/create', [UserController::class, 'create'])->name('create');
        Route::post('/users', [UserController::class, 'store'])->name('store');
        Route::patch('/users/{user}/toggle', [UserController::class, 'toggleStatus'])->name('toggle');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('update');
        Route::patch('/properties/{property}/change-owner', [UserController::class, 'transferOwnership'])->name('transferOwnership');
    });
/*
|--------------------------------------------------------------------------
| Pages Routes
|--------------------------------------------------------------------------
*/
Route::view('/faqs', 'pages.faqs')->name('pages.faqs');
Route::view('/contact', 'pages.contact')->name('pages.contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
