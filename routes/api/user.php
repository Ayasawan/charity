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

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

Route::post('user/register',[PassportAuthController::class, 'register'])->name('register');
Route::post('user/login',[PassportAuthController::class, 'userLogin'])->name('userLogin');


// scolarships
Route::get('scolarships',[\App\Http\Controllers\ScolarshipController::class,'index']);
Route::get('scolarships/{id}',[\App\Http\Controllers\ScolarshipController::class,'show']);

Route::group( ['prefix' =>'user','middleware' => ['auth:user-api','scopes:user'] ],function(){
   // authenticated staff routes here 
    Route::get('dashboard',[PassportAuthController::class, 'userDashboard']);
    Route::get('logout',[PassportAuthController::class,'logout'])->name('userLogout');
    //Route::get('logout',[PassportAuthController::class, 'logout']);

      // location
      Route::get('Location',[\App\Http\Controllers\LocationController::class,'index']);
      Route::get('Location/{id}',[\App\Http\Controllers\LocationController::class,'show']);
    

      //      jobs routes
    Route::prefix("jobs")->group(function () {
        Route::get('/', [JobController::class, 'index']);
        Route::get('/{id}', [JobController::class, 'show']);
    });


     //      trainings routes
     Route::prefix("trainings")->group(function () {
        Route::get('/', [TrainingController::class, 'index']);
        Route::get('/{id}', [TrainingController::class, 'show']);
    });


     //      challenges routes
     Route::prefix("challenges")->group(function () {
        Route::get('/', [ChallengeController::class, 'index']);
        Route::get('/{id}', [ChallengeController::class, 'show']);
    });



    //      challs routes
    Route::prefix("challs")->group(function () {
        Route::get('/', [ChallController::class, 'index']);
        Route::get('/{id}', [ChallController::class, 'show']);
    });


    //      zones routes
    Route::prefix("zones")->group(function () {
        Route::get('/', [ZoneController::class, 'index']);
        Route::get('/{id}', [ZoneController::class, 'show']);
    });



    // // scolarships
    // Route::get('scolarships',[\App\Http\Controllers\ScolarshipController::class,'index']);
    // Route::get('scolarships/{id}',[\App\Http\Controllers\ScolarshipController::class,'show']);



     // applicants
     Route::get('applicants',[\App\Http\Controllers\ApplicantController::class,'index']);
     Route::get('applicants/{id}',[\App\Http\Controllers\ApplicantController::class,'show']);



      // Documents_applicants
    Route::get('documents',[\App\Http\Controllers\DocumentController::class,'index']);
    Route::get('documents/{id}',[\App\Http\Controllers\DocumentController::class,'show']);


     // conection
     Route::get('conection',[\App\Http\Controllers\ContentinfoController::class,'index']);
     Route::get('conection/{id}',[\App\Http\Controllers\ContentinfoController::class,'show']);

     // charity
     Route::get('charity',[\App\Http\Controllers\CharityController::class,'index']);
     Route::get('charity/{id}',[\App\Http\Controllers\CharityController::class,'show']);

     // images_charity
     Route::get('image',[\App\Http\Controllers\ImageController::class,'index']);
     Route::get('image/{id}',[\App\Http\Controllers\ImageController::class,'show']);


     //donation
     Route::post('donation',[\App\Http\Controllers\DonationController::class,'store']);


   //      requests routes
     Route::prefix("requests")->group(function (){
     Route::post('/', [ReqController::class, 'store']);
    });


       //      pics routes
       Route::prefix("pics")->group(function () {
        Route::post('/', [PicController::class, 'store']);
    });


    // college routes
    Route::get('college',[\App\Http\Controllers\CollegeController::class,'index']);
    Route::get('college/{id}',[\App\Http\Controllers\CollegeController::class,'show']);
    
    
}); 