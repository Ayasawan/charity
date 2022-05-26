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


//      scolarship
Route::prefix("scolarships")->group(function () {
    Route::get('/', [ScolarshipController::class, 'index']);
    Route::post('/', [ScolarshipController::class, 'store']);
    Route::get('/{id}', [ScolarshipController::class, 'show']);
    Route::post('/update/{id}', [ScolarshipController::class, 'update']);
    Route::post('/{id}', [ScolarshipController::class, 'destroy']);
});