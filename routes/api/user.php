<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\PicController;
use App\Http\Controllers\ReqController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\ChallController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PassportAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('user/register', [PassportAuthController::class, 'register'])->name('register');
Route::post('user/login', [PassportAuthController::class, 'userLogin'])->name('userLogin');


Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

Route::group( ['prefix' =>'user','middleware' => ['auth:user-api','scopes:user'] ],function(){
   // authenticated staff routes here
//    Route::get('dashboard',[PassportAuthController::class, 'userDashboard']);
    Route::get('logout',[PassportAuthController::class,'logout'])->name('userLogout');

    // location
    Route::get('Location', [\App\Http\Controllers\LocationController::class, 'us_index']);
    Route::get('Location/{id}', [\App\Http\Controllers\LocationController::class, 'us_show']);

    //      jobs routes
    Route::prefix("jobs")->group(function () {
        Route::get('/', [JobController::class, 'us_index']);
        Route::get('/{id}', [JobController::class, 'us_show']);
        Route::get('search/{id}', [JobController::class, 'us_search']);
    });

    //      trainings routes
    Route::prefix("trainings")->group(function () {
        Route::get('/', [TrainingController::class, 'us_index']);
        Route::get('/{id}', [TrainingController::class, 'us_show']);
        Route::get('search/{id}', [TrainingController::class, 'us_search']);

    });


    //      challenges routes
    Route::prefix("challenges")->group(function () {
        Route::get('/count', [ChallengeController::class, 'us_count']);
        Route::get('/', [ChallengeController::class, 'us_index']);
        Route::get('/date', [ChallengeController::class, 'index_date']);
        Route::get('/{id}', [ChallengeController::class, 'us_show']);
        Route::get('search/{id}', [ChallengeController::class, 'us_search']);

    });


//    //      challs routes
//    Route::prefix("challs")->group(function () {
//        Route::get('/', [ChallController::class, 'us_index']);
//        Route::get('/{id}', [ChallController::class, 'us_show']);
//    });


    //      zones routes
    Route::prefix("zones")->group(function () {
        Route::get('/', [ZoneController::class, 'us_index']);
        Route::get('/{id}', [ZoneController::class, 'us_show']);
        Route::get('search/{id}', [ZoneController::class, 'us_search']);

    });


    // scolarships
    Route::get('scolarships', [\App\Http\Controllers\ScolarshipController::class, 'us_index']);
    Route::get('scolarships/{id}', [\App\Http\Controllers\ScolarshipController::class, 'us_show']);
    Route::post('scolarships/search/{id}',[\App\Http\Controllers\ScolarshipController::class,'us_search']);



    // applicants

    Route::post('applicants',[\App\Http\Controllers\ApplicantController::class,'store']);


//    // Documents_applicants
    Route::post('documents',[\App\Http\Controllers\DocumentController::class,'store']);
    Route::post('documents/update/{id}',[\App\Http\Controllers\DocumentController::class,'update']);



    // conection
    Route::get('conection', [\App\Http\Controllers\ContentinfoController::class, 'us_index']);
    Route::get('conection/{id}', [\App\Http\Controllers\ContentinfoController::class, 'us_show']);

    // charity
    Route::get('charity', [\App\Http\Controllers\CharityController::class, 'us_index']);
//    Route::get('charity/{id}', [\App\Http\Controllers\CharityController::class, 'us_show']);



    // images_charity
    Route::get('image', [\App\Http\Controllers\ImageController::class, 'us_index']);
    Route::get('image/{id}', [\App\Http\Controllers\ImageController::class, 'us_show']);


    //donation
    Route::get('donation/count',[\App\Http\Controllers\DonationController::class,'us_count']);
    Route::post('donation', [\App\Http\Controllers\DonationController::class, 'us_store']);


    //      requests routes
    Route::prefix("requests")->group(function () {
        Route::post('/update/{id}', [ReqController::class, 'update']);

        Route::post('/', [ReqController::class, 'us_store']);
    });


    //      pics routes
    Route::prefix("pics")->group(function () {
        Route::post('/', [PicController::class, 'store']);
    });
    Route::get('beneficiary/count',[\App\Http\Controllers\BeneficiariesController::class,'us_count']);


});




