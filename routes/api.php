<?php

use App\Http\Controllers\Api\Account\NotificationController;
use App\Http\Controllers\Api\Account\PostController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\Password\ForgetPasswordController;
use App\Http\Controllers\Api\Auth\Password\RestPasswordController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\VerifyEmailController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\GeneralController;
use App\Http\Controllers\Api\Account\SettingController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//**********auth routes*********** */


//********** Auth Register *********** */
Route::post('auth/register', [RegisterController::class, 'register'])->middleware('throttle:register');



//**********  Auth Login *********** */

Route::controller(LoginController::class)->group(function () {

    Route::post('auth/login', 'login');
    Route::delete('auth/logout', 'logout')->middleware('auth:sanctum');
});


//********** Auth Email Verify *********** */

Route::middleware(['auth:sanctum','throttle:verify'])->controller(VerifyEmailController::class)->group(function () {

    Route::post('auth/email/verify', 'verify');
    Route::get('auth/email/verify-again', 'sendOtpAgain');
});

//**********  forget  password   Verify *********** */
Route::controller(ForgetPasswordController::class)->group(function () {

    Route::post('password/email', 'snedOtp');

});

//**********  Reset  password   Verify *********** */
Route::controller(RestPasswordController::class)->group(function () {

    Route::post('password/rest', 'restPassword');

});




//**********Account Routes *********** */
Route::middleware(['auth:sanctum','checkUserStatus','verifyEmail'])->prefix('account')->group(function(){
    Route::get('user', function () {

        return UserResource::make(auth()->user());
    });

    Route::put('setting/{user_id}',[SettingController::class,'updateSetting']);
    Route::put('setting/change-password/{user_id}',[SettingController::class,'changePassword']);



    Route::controller(PostController::class)->prefix('posts')->group(function () {

        Route::get('/', 'getUserPosts');

        Route::post('/store', 'storeUserPost');
        Route::put('/update/{post_id}', 'updateUserPost');

        Route::delete('/destroy/{post_id}', 'destroyUserPost');


        Route::get('/comments/{post_id}', 'getPostComments');
        Route::post('/comments/store', 'storeComments');





    });

    Route::get('/notifications',[NotificationController::class,'getNotifications']);
    Route::get('/notifications/read/{id}',[NotificationController::class,'readNotifications']);





});



//**********Home Page routes*********** */7
Route::controller(GeneralController::class)->group(function () {

    Route::get('posts', 'getPosts');
    Route::get('posts/search/{keyword?}', 'searchPosts');
    Route::get('posts/show/{slug}',  'showPosts');
    Route::get('posts/comments/{slug}', 'showPostComment');

});



//**********category routes*********** */

Route::controller(CategoryController::class)->group(function () {

    Route::get('categories',  'getCategory');
    Route::get('categories/{slug}/posts', 'getCategoryPosts');

});


//**********contact routes*********** */
Route::post('contacts/store', [ContactController::class, 'storeContact'])->middleware('throttle:contact');



//**********setting routes*********** */
Route::get('settings', [SettingController::class, 'getSettings']);
