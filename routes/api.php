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

//      jobs routes
Route::prefix("jobs")->group(function () {
    Route::get('/', [JobController::class, 'index']);

    Route::post('/', [JobController::class, 'store']);

    Route::get('/{id}', [JobController::class, 'show']);

     Route::post('/update/{id}', [JobController::class, 'update']);

    Route::post('/{id}', [JobController::class, 'destroy']);
});

