<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LicenceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        // Utilisateur connecté
        return redirect()->route('app_main');
    } else {
        // Invité
        return view('auth.login');
    }
});


/** Traduction route */
Route::get('/lang/{lang}',
    [LanguageController::class, 'switchLang'])
        ->name('app_language');

Route::controller(LicenceController::class)->group(function(){
    Route::get('/add_licence', 'add_licence')->name('app_add_licence');
    Route::get('/generate_license', 'generate_license')->name('app_generate_license');

    Route::post('/save_license', 'save_license')->name('app_save_license');
    Route::post('/create_licence', 'create_licence')->name('app_create_licence');
});

Route::controller(LoginController::class)->group(function(){
    Route::get('/logout', 'logout')->name('app_logout');
    Route::get('/register_user', 'register_user')->name('app_register_user');
    Route::get('/profile', 'profile')->name('app_profile');

    Route::post('/create_user', 'create_user')->name('app_create_user');
    Route::post('/create_user_admin', 'create_user_admin')->name('app_create_user_admin');

    Route::middleware(['auth', 'admin'])->group(function(){
        Route::get('/user_management', 'user_management')->name('app_user_management');
        Route::post('/save_permission', 'save_permission')->name('app_save_permission');
        Route::get('/add_user/{id:int}', 'add_user')->name('app_add_user');
        Route::post('/delete_user', 'delete_user')->name('app_delete_user');
    });

});

Route::controller(MainController::class)->group(function(){
    Route::middleware(['auth', 'check.license'])->group(function () {
        Route::match(['post', 'get'], '/read_notification', 'read_notification')->name('app_read_notification');
        Route::get('/all_notification', 'all_notification')->name('app_all_notification');
        Route::get('/unviewed_notifications', 'unviewed_notifications')->name('app_unviewed_notifications');
        Route::get('/main', 'main')->name('app_main');
    });
});
