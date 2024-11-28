<?php

use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\Dashboard\NotificationController;
use App\Http\Controllers\Frontend\Dashboard\ProfileController;
use App\Http\Controllers\Frontend\Dashboard\SettingController;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewSubscriberController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\SearchController;
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

Route::redirect('/', '/home');

Route::group([
    'as' => 'frontend.',
], function () {


    Route::fallback(function(){
        return response()->view('errors.404');
    });

    Route::get('wait', function(){
        return view('frontend.wait');
    })->name('wait');

    Route::get('/home', [HomeController::class, 'index'])->name('index');
    Route::post('news-subscribe', [NewSubscriberController::class, 'store'])->name('news.subscribe');
    Route::get('category/{slug}', CategoryController::class)->name('category.posts');
    //Post routes
    Route::controller(PostController::class)->name('post.')->prefix('post')->group(function () {

        Route::get('/{slug}', 'show')->name('show');
        Route::get('/comments/{slug}', 'getAllComments')->name('getAllComments');
        Route::post('/comments/store', 'addNewComment')->name('addNewComment');
    });
    //contact routes
    Route::controller(ContactController::class)->name('contact.')->prefix('contact-us')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::post('/send-message', 'sendMessage')->name('sendMessage')->middleware('throttle:contact-web');
    });


    //search route
    Route::match(['get', 'post'], 'search', SearchController::class)->name('search');
    //match use post and get

    //Dashbord Routes

    Route::prefix('account')->name('dashboard.')->middleware(['auth:web', 'verified','checkUserStatus'])->group(function () {
        //profile route
        Route::controller(ProfileController::class)->group(function () {

            Route::get('/profile', 'index')->name('profile');
            //add post route in profile
            Route::post('/post/store', 'postStore')->name('post.store');
            Route::delete('/post/delete', 'deletePost')->name('post.delete');
            Route::get('/post/get-comments/{id}', 'getComments')->name('post.comments');
            Route::get('/post/{slug}/edit', 'showEditForm')->name('post.edit');
            Route::post('/post/update', 'updatePost')->name('post.update');
            Route::post('/post/delete/{image_id}', 'deletePostImage')->name('post.delete-image');
        });

        //setting route
        Route::prefix('setting')->controller(SettingController::class)->group(function () {
            Route::get('/', 'index')->name('setting');
            Route::post('/update', 'settingUpdate')->name('setting.update');
            Route::post('/change-password', 'changePassword')->name('setting.change-password');
        });

        //Notification Routes
        Route::prefix('notification')->controller(NotificationController::class)->group(function () {
            Route::get('/', 'index')->name('notification');
            Route::post('/delete', 'delete')->name('notification.delete');
            Route::get('/delete-all', 'deleteAll')->name('notification.delete-all');
            Route::get('/read-all', 'readAll')->name('notification.read-all');
        });


    });
});



Auth::routes();
Route::controller(VerificationController::class)->name('verification.')->prefix('email')->group(function () {

    Route::get('verify', 'show')->name('notice');
    Route::get('verify/{id}/{hash}', 'verify')->name('verify');
    Route::post('resend', 'resend')->name('resend');
});

Route::get('auth/{provider}/redirect',[SocialLoginController::class,'redirect'])->name('auth.google.redirect');
Route::get('auth/{provider}/callback',[SocialLoginController::class,'callback'])->name('auth.google.callback');

