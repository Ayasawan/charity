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
Route::post('Location/{id}',[\App\Http\Controllers\LocationController::class,'destroy']);
Route::post('Location/update/{id}',[\App\Http\Controllers\LocationController::class,'update']);
Route::get('Location/{id}',[\App\Http\Controllers\LocationController::class,'show']);


//      jobs routes
Route :: group(['middleware'=>['auth:api','access.control']],function(){
        Route::prefix("jobs")->group(function () {
            Route::get('/', [JobController::class, 'index']);

            Route::post('/', [JobController::class, 'store']);

            Route::get('/{id}', [JobController::class, 'show']);

             Route::post('/update/{id}', [JobController::class, 'update']);

            Route::post('/{id}', [JobController::class, 'destroy']);
        });
});


//      trainings routes
Route::prefix("trainings")->group(function () {
    Route::get('/', [TrainingController::class, 'index']);

    Route::post('/', [TrainingController::class, 'store']);

    Route::get('/{id}', [TrainingController::class, 'show']);

    Route::post('/update/{id}', [TrainingController::class, 'update']);

    Route::post('/{id}', [TrainingController::class, 'destroy']);
});



//// Training
//
//Route::post('Training',[\App\Http\Controllers\TrainingController::class,'store']);
//Route::get('Training',[\App\Http\Controllers\TrainingController::class,'index']);
//Route::delete('Training/{id}',[\App\Http\Controllers\TrainingController::class,'destroy']);
//Route::put('Training/{id}',[\App\Http\Controllers\TrainingController::class,'update']);
//Route::get('Training/{id}',[\App\Http\Controllers\TrainingController::class,'show']);


//      challenges routes
Route::prefix("challenges")->group(function () {
    Route::get('/', [ChallengeController::class, 'index']);

    Route::post('/', [ChallengeController::class, 'store']);

    Route::get('/{id}', [ChallengeController::class, 'show']);

    Route::post('/update/{id}', [ChallengeController::class, 'update']);

    Route::post('/{id}', [ChallengeController::class, 'destroy']);
});


//      challs routes
Route::prefix("challs")->group(function () {
    Route::get('/', [ChallController::class, 'index']);

    Route::post('/', [ChallController::class, 'store']);

    Route::get('/{id}', [ChallController::class, 'show']);

    Route::post('/update/{id}', [ChallController::class, 'update']);

    Route::post('/{id}', [ChallController::class, 'destroy']);
});



//      zones routes
Route::prefix("zones")->group(function () {
    Route::get('/', [ZoneController::class, 'index']);

    Route::post('/', [ZoneController::class, 'store']);

    Route::get('/{id}', [ZoneController::class, 'show']);

    Route::post('/update/{id}', [ZoneController::class, 'update']);

    Route::post('/{id}', [ZoneController::class, 'destroy']);
});




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
Route::post('conection/{id}',[\App\Http\Controllers\ContentinfoController::class,'destroy']);
Route::post('conection/update/{id}',[\App\Http\Controllers\ContentinfoController::class,'update']);
Route::get('conection/{id}',[\App\Http\Controllers\ContentinfoController::class,'show']);

// charity

Route::post('charity',[\App\Http\Controllers\CharityController::class,'store']);
Route::get('charity',[\App\Http\Controllers\CharityController::class,'index']);
Route::post('charity/{id}',[\App\Http\Controllers\CharityController::class,'destroy']);
Route::post('charity/update/{id}',[\App\Http\Controllers\CharityController::class,'update']);
Route::get('charity/{id}',[\App\Http\Controllers\CharityController::class,'show']);

//
// images_charity

Route::post('image',[\App\Http\Controllers\ImageController::class,'store']);
Route::get('image',[\App\Http\Controllers\ImageController::class,'index']);
Route::post('image/{id}',[\App\Http\Controllers\ImageController::class,'destroy']);
Route::post('image/update/{id}',[\App\Http\Controllers\ImageController::class,'update']);
Route::get('image/{id}',[\App\Http\Controllers\ImageController::class,'show']);


//donation
Route::post('donation',[\App\Http\Controllers\DonationController::class,'store']);
Route::get('donation',[\App\Http\Controllers\DonationController::class,'index']);
Route::post('donation/{id}',[\App\Http\Controllers\DonationController::class,'destroy']);
Route::post('donation/update/{id}',[\App\Http\Controllers\DonationController::class,'update']);
Route::get('donation/{id}',[\App\Http\Controllers\DonationController::class,'show']);


//beneficiary
Route::post('beneficiary',[\App\Http\Controllers\BeneficiariesController::class,'store']);
Route::get('beneficiary',[\App\Http\Controllers\BeneficiariesController::class,'index']);
Route::post('beneficiary/{id}',[\App\Http\Controllers\BeneficiariesController::class,'destroy']);
Route::post('beneficiary/update/{id}',[\App\Http\Controllers\BeneficiariesController::class,'update']);
Route::get('beneficiary/{id}',[\App\Http\Controllers\BeneficiariesController::class,'show']);



//      requests routes
Route::prefix("requests")->group(function () {
    Route::get('/', [ReqController::class, 'index']);

    Route::post('/', [ReqController::class, 'store']);

    Route::get('/{id}', [ReqController::class, 'show']);

    Route::post('/update/{id}', [ReqController::class, 'update']);

    Route::post('/{id}', [ReqController::class, 'destroy']);
});


//      sponsors routes
Route::prefix("sponsors")->group(function () {
    Route::get('/', [SponsorController::class, 'index']);

    Route::post('/', [SponsorController::class, 'store']);

    Route::get('/{id}', [SponsorController::class, 'show']);

    Route::post('/update/{id}', [SponsorController::class, 'update']);

    Route::post('/{id}', [SponsorController::class, 'destroy']);
});



//      pics routes
Route::prefix("pics")->group(function () {
    Route::get('/', [PicController::class, 'index']);

    Route::post('/', [PicController::class, 'store']);

    Route::get('/{id}', [PicController::class, 'show']);

    Route::post('/update/{id}', [PicController::class, 'update']);

    Route::post('/{id}', [PicController::class, 'destroy']);
});



// college routes
Route::get('college',[\App\Http\Controllers\CollegeController::class,'index']);
Route::get('college/{id}',[\App\Http\Controllers\CollegeController::class,'show']);





//Route::prefix('auth')->group(function (){
//    Route::post('login',[UserController::class,'login']);
//});
//
//
//Route::group(['middleware'=>['auth:api','access.control']],function (){
//
//    Route::prefix('test')->group(function (){
//        Route::get('list',[TestController::class,'list'])->name('list_test');
//        Route::post('',[TestController::class,'add'])->name('add_test');
//
//        Route::prefix('{id}')->group(function (){
//            Route::put('',[TestController::class,'update'])->name('update_test');
//            Route::delete('',[TestController::class,'delete'])->name('delete_test');
//            Route::get('',[TestController::class,'view'])->name('view_test');
//        });
//    });
//
//});


