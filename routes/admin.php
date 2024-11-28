<?php

use App\Http\Controllers\Admin\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\Password\ForgetPasswordController;
use App\Http\Controllers\Admin\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Admin\Authorization\AuthorizationConroller;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Contact\ContactController;
use App\Http\Controllers\Admin\GeneralSearchController;
use App\Http\Controllers\Admin\Home\HomeAdminController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Notifiaction\NotificationController;
use App\Http\Controllers\Admin\Post\PostController;
use App\Http\Controllers\Admin\Profile\ProfileController;
use App\Http\Controllers\Admin\Setting\RelatedSitesController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\User\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('wait', function () {
        return view('admin.wait');
    })->name('wait');

    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login.show');
        Route::post('/login/check', 'checkLogin')->name('login.check');
        Route::post('/logout', 'logout')->name('logout');
    });

    Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
        Route::controller(ForgetPasswordController::class)->group(function () {
            Route::get('/email', 'showEmailForm')->name('email');
            Route::post('/email', 'sendOtp')->name('sendOtp');
            Route::get('/verify/{email}', 'showOtpForm')->name('showOtpForm');
            Route::post('/verify', 'verifyOtp')->name('verifyOtp');
        });


        Route::controller(ResetPasswordController::class)->group(function () {
            Route::get('/reset/{email}',  'showResetForm')->name('showResetForm');
            Route::post('/reset',  'resetPassword')->name('reset');
        });
    });
});

Route::get('/test', function () {
    return view('admin.auth.passwords.email');
});


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth:admin', 'checkAdminStatus']], function () {

    //**********page not found*********** */


    Route::fallback(function(){
        return response()->view('errors.404');
    });

    //**********general routes*********** */


    Route::get('search', [GeneralSearchController::class, 'search'])->name('search');


    //Home Route
    Route::get('home', [HomeAdminController::class, 'index'])->name('home');



    //**********authorization  routes*********** */

    Route::resource('authorizations', AuthorizationConroller::class);


    //**********user routes*********** */

    Route::resource('users', UserController::class);
    Route::get('users/status/{id}', [UserController::class, 'changeStatus'])->name('users.changeStatus');

    //**********category routes*********** */
    Route::resource('categories', CategoryController::class);
    Route::get('categories/status/{id}', [CategoryController::class, 'changeStatus'])->name('categories.changeStatus');


     //**********related sites  routes*********** */
     Route::resource('related-sites', RelatedSitesController::class);


    //**********post routes*********** */
    Route::resource('posts', PostController::class);
    Route::get('posts/status/{id}', [PostController::class, 'changeStatus'])->name('posts.changeStatus');
    Route::post('/posts/delete/{image_id}', [PostController::class, 'deletePostImage'])->name('posts.delete-image');
    Route::get('/posts/comment/delete/{comment_id}', [PostController::class, 'deleteComment'])->name('posts.deletecomment');




    //**********setting routes*********** */
    Route::controller(SettingController::class)->prefix('setting')->as('setting.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::post('/update', 'update')->name('update');
    });
    //**********Profile routes*********** */
    Route::controller(ProfileController::class)->prefix('profile')->as('profile.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::post('/update', 'update')->name('update');
    });

    //**********admins routes*********** */
    Route::resource('admins', AdminController::class);
    Route::get('admins/status/{id}', [AdminController::class, 'changeStatus'])->name('admins.changeStatus');

    //**********contact routes*********** */
    Route::controller(ContactController::class)->prefix('contact')->as('contact.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
    });

    //**********notification routes*********** */
    Route::controller(NotificationController::class)->prefix('notification')->as('notification.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
        Route::get('/delete-all', 'deleteAll')->name('deleteAll');
    });
});
