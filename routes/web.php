<?php

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\PackageController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\PromoCodeController;
use App\Http\Controllers\admin\OccassionController;
use App\Http\Controllers\admin\InterestController;
use App\Http\Controllers\admin\ChallengeController;
use App\Http\Controllers\admin\LevelController;
use App\Http\Controllers\admin\FaqController;
use App\Http\Controllers\admin\TrackController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|+}|}
*/
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

    Route::group(['prefix' => 'admin'],function(){
    Route::group(['middleware' => 'admin.guest'],function(){
	// will define guest routes without login 

	Route::get('/login',[AdminLoginController::class,'index'])->name('admin.login');

	Route::post('/login',[AdminLoginController::class,'authenticate'])->name('admin.auth');

		
		
 	});

	Route::group(['middleware' => 'admin.auth'],function(){
	// will define Password protected routes 

	Route::get('/otp',[AdminLoginController::class,'otpCode'])->name('admin.otp');

	Route::post('/otp-verify',[AdminLoginController::class,'otpVerify'])->name('otp-verify');

	Route::get('/resend',[AdminLoginController::class,'resend'])->name('otp-resend');

//	Route::view('/dashboard' , 'admin.dashboard')->name('admin.dashboard');	
	
	Route::get('/dashboard', [AdminLoginController::class,'dashboard'] )->name('admin.dashboard');
	Route::get('/profile', [AdminLoginController::class,'profile'] )->name('admin.profile');
	Route::post('/profile/{id}' , [AdminLoginController::class,'profileUpdate'] )->name('profile-update');
	Route::post('change-password' , [AdminLoginController::class,'changPasswordStore'] )->name('change-password');
	Route::post('profile-upload' , [AdminLoginController::class,'upload'] )->name('profile-upload');
	Route::get('logout', [AdminLoginController::class,'logout'] )->name('admin.logout');
	Route::post('/social-profile/{id}', [AdminLoginController::class,'socialProfileUpdate'] )->name('social-profile');
	Route::get('/remove-logo/' , [AdminLoginController::class,'destroy'] )->name('profile-logo-remove');
// User controller 
	Route::get('/users', [UserController::class,'index'] )->name('admin.users');
	Route::get('/user/delete/{id}', [UserController::class,'destroy'] )->name('user.delete');
// Package Controller
	Route::get('/create-package', [PackageController::class,'create'] )->name('admin-create-package');
	Route::post('/create-package', [PackageController::class,'store'] )->name('admin-store-package');
	Route::get('/packages', [PackageController::class,'index'] )->name('admin-package');
	Route::get('/edit-package/{id}', [PackageController::class,'edit'] )->name('admin-package-edit');
	Route::post('/update-package/{id}', [PackageController::class,'packageUpdate'] )->name('admin-package-update');
	Route::get('/package/delete/{id}', [PackageController::class,'destroy'] )->name('admin-package-delete');
//  Promo code controller

   Route::get('/create-promo-code', [PromoCodeController::class,'create'] )->name('admin-create-promo');
   Route::post('/create-promo-code', [PromoCodeController::class,'store'] )->name('admin-store-promo');
   Route::get('/promo-codes', [PromoCodeController::class,'index'] )->name('admin-promo-codes');
   Route::get('/edit-promo-code/{id}', [PromoCodeController::class,'edit'] )->name('admin-prmo-edit');
	Route::post('/update-promo/{id}', [PromoCodeController::class,'promoCodeUpdate'] )->name('admin-update-promo');
   Route::get('/promo/delete/{id}', [PromoCodeController::class,'destroy'] )->name('admin-promo-delete');
  //Occassion

	Route::get('/occassions', [OccassionController::class,'index'] )->name('admin-occ-list');
	Route::get('/create-occassion', [OccassionController::class,'create'] )->name('admin-occ-create');
	Route::get('/create-occassion', [OccassionController::class,'store'] )->name('admin-occ-store');
     

  //intrests
	Route::get('/interests', [InterestController::class,'index'] )->name('admin-interest-list');
	Route::get('/create-interest', [InterestController::class,'create'] )->name('admin-interest-create');
	Route::post('/create-interest', [InterestController::class,'store'] )->name('admin-store-interest');
	Route::get('/edit-interest/{id}', [InterestController::class,'edit'] )->name('admin-interest-edit');
	Route::post('/update-interest/{id}', [InterestController::class,'update'] )->name('admin-update-interest');
	Route::get('/interest/delete/{id}', [InterestController::class,'destroy'] )->name('admin-interest-delete');

// Challnege

   Route::get('/challenges', [ChallengeController::class,'index'] )->name('admin-challenge-list');
	Route::get('/create-challenge', [ChallengeController::class,'create'] )->name('admin-create-challenge');
	Route::post('/create-challenge', [ChallengeController::class,'store'] )->name('admin-store-challenge');
	Route::get('/edit-challenge/{id}', [ChallengeController::class,'edit'] )->name('admin-edit-challenge');
	Route::post('/update-challenge/{id}', [ChallengeController::class,'update'] )->name('admin-update-challenge');
    Route::get('/challenge/delete/{id}', [ChallengeController::class,'destroy'] )->name('admin-delete-challenge');

     
// Manage Level

    Route::get('/levels', [LevelController::class,'index'] )->name('admin-level-list');
	Route::get('/create-level', [LevelController::class,'create'] )->name('admin-level-create');
	Route::post('/create-level', [LevelController::class,'store'] )->name('admin-level-store');

	Route::get('/edit-level/{id}', [LevelController::class,'edit'] )->name('admin-edit-level');
	Route::post('/update-level/{id}', [LevelController::class,'update'] )->name('admin-update-level');
    Route::get('/level/delete/{id}', [LevelController::class,'destroy'] )->name('admin-delete-level');


       //FAQ's

        Route::get('/faqs', [FaqController::class,'index'] )->name('admin-list-faq');
	  Route::get('/create-faq', [FaqController::class,'create'] )->name('admin-create-faq');
      Route::post('/create-faq', [FaqController::class,'store'] )->name('admin-store-faq');
       Route::get('/edit-faq/{id}', [FaqController::class,'edit'] )->name('admin-faq-edit');
       Route::post('/update-faq/{id}', [FaqController::class,'update'] )->name('admin-faq-udate');
        Route::get('delete-faq/{id}', [FaqController::class,'destroy'] )->name('admin-faq-delete');


        // Track Category

   // Route::get('/track-categories', [TrackController::class,'index'] )->name('admin-track-list');
	Route::get('/create-category', [TrackController::class,'create'] )->name('admin-track-create');
	Route::post('/create-category', [TrackController::class,'store'] )->name('admin-track-store');

//	Route::get('/edit-level/{id}', [TrackController::class,'edit'] )->name('admin-edit-level');
//	Route::post('/update-level/{id}', [TrackController::class,'update'] )->name('admin-update-level');
 //   Route::get('/level/delete/{id}', [TrackController::class,'destroy'] )->name('admin-delete-level');
 


	});
});





