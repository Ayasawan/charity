<?php
use App\Http\Controllers\JobController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\ZoneController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
    Route::post('register', [\App\Http\Controllers\PassportAuthController::class, 'register']);
    Route::post('Login', [\App\Http\Controllers\PassportAuthController::class, 'Login']);

    Route::middleware(['auth:api']) ->group(function (){
        Route::get('logout', [\App\Http\Controllers\PassportAuthController::class, 'logout']);
    });
    // location
Route::post('Location',[\App\Http\Controllers\LocationController::class,'store']);
Route::get('Location',[\App\Http\Controllers\LocationController::class,'index']);
Route::delete('Location/{id}',[\App\Http\Controllers\LocationController::class,'destroy']);
Route::put('Location/{id}',[\App\Http\Controllers\LocationController::class,'update']);
Route::get('Location/{id}',[\App\Http\Controllers\LocationController::class,'show']);


//      jobs routes
Route::prefix("jobs")->group(function () {
    Route::get('/', [JobController::class, 'index']);

    Route::post('/', [JobController::class, 'store']);

    Route::get('/{id}', [JobController::class, 'show']);

     Route::post('/update/{id}', [JobController::class, 'update']);

    Route::post('/{id}', [JobController::class, 'destroy']);
});
// Training

Route::post('Training',[\App\Http\Controllers\TrainingController::class,'store']);
Route::get('Training',[\App\Http\Controllers\TrainingController::class,'index']);
Route::delete('Training/{id}',[\App\Http\Controllers\TrainingController::class,'destroy']);
Route::put('Training/{id}',[\App\Http\Controllers\TrainingController::class,'update']);
Route::get('Training/{id}',[\App\Http\Controllers\TrainingController::class,'show']);


//      zone
Route::prefix("zones")->group(function () {
    Route::get('/', [ZoneController::class, 'index']);
    Route::post('/', [ZoneController::class, 'store']);
    Route::get('/{id}', [ZoneController::class, 'show']);
    Route::post('/update/{id}', [ZoneController::class, 'update']);
    Route::post('/{id}', [ZoneController::class, 'destroy']);
});


// //      scolarship
// Route::prefix("scolarships")->group(function () {
//     Route::get('/', [ScolarshipController::class, 'index']);
//     Route::post('/', [ScolarshipController::class, 'store']);
//     Route::get('/{id}', [ScolarshipController::class, 'show']);
//     Route::post('/update/{id}', [ScolarshipController::class, 'update']);
//     Route::post('/{id}', [ScolarshipController::class, 'destroy']);
// });


// scolarships

Route::get('scolarships',[\App\Http\Controllers\ScolarshipController::class,'index']);
Route::post('scolarships',[\App\Http\Controllers\ScolarshipController::class,'store']);
Route::get('scolarships/{id}',[\App\Http\Controllers\ScolarshipController::class,'show']);
Route::post('scolarships/update/{id}',[\App\Http\Controllers\ScolarshipController::class,'update']);
Route::post('scolarships/{id}',[\App\Http\Controllers\ScolarshipController::class,'destroy']);

// applicants

Route::get('applicants',[\App\Http\Controllers\ApplicantController::class,'index']);
Route::post('applicants',[\App\Http\Controllers\ApplicantController::class,'store']);
Route::get('applicants/{id}',[\App\Http\Controllers\ApplicantController::class,'show']);
Route::post('applicants/update/{id}',[\App\Http\Controllers\ApplicantController::class,'update']);
Route::post('applicants/{id}',[\App\Http\Controllers\ApplicantController::class,'destroy']);



// Documents_applicants

Route::get('documents',[\App\Http\Controllers\DocumentController::class,'index']);
Route::post('documents',[\App\Http\Controllers\DocumentController::class,'store']);
Route::get('documents/{id}',[\App\Http\Controllers\DocumentController::class,'show']);
Route::post('documents/update/{id}',[\App\Http\Controllers\DocumentController::class,'update']);
Route::post('documents/{id}',[\App\Http\Controllers\DocumentController::class,'destroy']);


// conection

Route::post('conection',[\App\Http\Controllers\ContentinfoController::class,'store']);
Route::get('conection',[\App\Http\Controllers\ContentinfoController::class,'index']);
Route::delete('conection/{id}',[\App\Http\Controllers\ContentinfoController::class,'destroy']);
Route::put('conection/{id}',[\App\Http\Controllers\ContentinfoController::class,'update']);
Route::get('conection/{id}',[\App\Http\Controllers\ContentinfoController::class,'show']);

// charity

Route::post('charity',[\App\Http\Controllers\CharityController::class,'store']);
Route::get('charity',[\App\Http\Controllers\CharityController::class,'index']);
Route::delete('charity/{id}',[\App\Http\Controllers\CharityController::class,'destroy']);
Route::put('charity/{id}',[\App\Http\Controllers\CharityController::class,'update']);
Route::get('charity/{id}',[\App\Http\Controllers\CharityController::class,'show']);


// images_charity

Route::post('image',[\App\Http\Controllers\ImageController::class,'store']);
Route::get('image',[\App\Http\Controllers\ImageController::class,'index']);
Route::delete('image/{id}',[\App\Http\Controllers\ImageController::class,'destroy']);
Route::put('image/{id}',[\App\Http\Controllers\ImageController::class,'update']);
Route::get('image/{id}',[\App\Http\Controllers\ImageController::class,'show']);


