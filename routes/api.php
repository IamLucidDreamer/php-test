<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\PackageController;
use App\Http\Controllers\API\PromoCodeController;
use App\Http\Controllers\API\InterestAPIController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ForgotPasswordController;

use App\Http\Controllers\API\CodeCheckController;
use App\Http\Controllers\API\UserAPIController;
//use App\Http\Controllers\API\ResetPasswordController;

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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    Route::get('/interest', [UserAPIController::class,'allInterest'] );

    return $request->user();
});*/


Route::post('register', [RegisterController::class, 'register']);


Route::post('user-password', [RegisterController::class, 'setPassword']);



Route::post('login', [RegisterController::class, 'login']);

Route::post('otpVerify', [RegisterController::class, 'otpVerify']);

Route::post('resendOTP', [RegisterController::class, 'resendOTP']);

Route::get('packages', [PackageController::class,'getAllPackage'] );

Route::get('promoCodes', [PromoCodeController::class,'getAllPromoCode'] );

Route::post('forgot-password', [RegisterController::class, 'forgotPassword']);



Route::post('change-password', [RegisterController::class, 'changePassword']);


//  Route::post('password/forgot',  ForgotPasswordController::class);

Route::post('password/reset', [RegisterController::class, 'passwordReset']);
//Route::post('password/reset', ResetPasswordController::class);


Route::get('subscription-list', [UserAPIController::class, 'getSubscriptionList']);

Route::post('create-rack', [UserAPIController::class, 'createRack']);

Route::post('create-track', [UserAPIController::class, 'createTrack']);

Route::post('create-group', [UserAPIController::class, 'createGroup']);





Route::post('user-subscription', [UserAPIController::class, 'getUserSubscription']);
Route::post('upgrade-user-subscription', [UserAPIController::class, 'updateUserSubscription']);

Route::post('unsubscribe-user', [UserAPIController::class, 'updateUserSubscription']);

Route::post('update-user-notification', [UserAPIController::class, 'updateUserNotification']);

Route::post('change-user-password', [UserAPIController::class, 'changePassword']);

Route::get('all-interest', [PromoCodeController::class,'interest'] );

Route::get('all-challenges', [UserAPIController::class,'challenge'] );

Route::get('levels', [UserAPIController::class,'levelsByChallenge'] );

Route::get('faq', [UserAPIController::class,'faq'] );

Route::post('user-interest', [UserAPIController::class,'storeUserInterest'] );

Route::post('user-post', [UserAPIController::class,'storeUserPost'] );

Route::post('create-event', [UserAPIController::class,'storeUserEvent'] );

Route::get('all-events', [UserAPIController::class,'showAllEvents']);

Route::post('my-events', [UserAPIController::class,'userEvents']);

Route::post('store-feedback', [UserAPIController::class,'storeFeedback']);


// create album route


/*Route::post('occassions-list', [UserAPIController::class, 'getOccassionsList']);


Route::post('album-list', [UserAPIController::class, 'getAlbumList']);

Route::post('album-image-list', [UserAPIController::class, 'getAlbumImageList']);

Route::post('create-album', [UserAPIController::class, 'storeAlbum']);

Route::post('create-folder', [UserAPIController::class, 'storeFolder']);
Route::post('upload-images', [UserAPIController::class, 'uploadImageToFolderAlbum']);

Route::post('folder-image-list', [UserAPIController::class, 'getFolderImageList']);


Route::post('folder-list', [UserAPIController::class, 'getFolderList']);

Route::post('move-albumfolder', [UserAPIController::class, 'moveAlbumFolder']);

*/
Route::middleware('auth:sanctum')->group( function () {
    
    Route::post('logout', [RegisterController::class, 'logout']);
    Route::post('update-profile', [UserAPIController::class, 'updateProfile']);
    Route::post('get-profile', [UserAPIController::class, 'getprofile']);

    Route::resource('products', ProductController::class);

});
