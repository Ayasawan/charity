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
use App\Http\Controllers\LocationController;




use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('admin/login',[\App\Http\Controllers\PassportAuthController::class,'adminLogin'])->name('adminLogin');

Route::group( ['prefix' => 'admin','middleware' => ['auth:admin-api','scopes:admin'] ],function(){
   // authenticated staff routes here
    //Route::get('dashboard',[PassportAuthController::class,'adminDashboard']);
    Route::get('logout',[PassportAuthController::class,'adminlogout'])->name('adminLogout');
    Route::post('delete/{id}', [\App\Http\Controllers\PassportAuthController::class, 'destroy']);



        // location
    Route::post('Location',[\App\Http\Controllers\LocationController::class,'store']);
    Route::get('Location',[\App\Http\Controllers\LocationController::class,'index']);
    Route::post('Location/{id}',[\App\Http\Controllers\LocationController::class,'destroy']);
    Route::post('Location/update/{id}',[\App\Http\Controllers\LocationController::class,'update']);
    Route::get('Location/{id}',[\App\Http\Controllers\LocationController::class,'show']);


    //      jobs routes
    Route::prefix("jobs")->group(function () {
        Route::get('/', [JobController::class, 'index']);
        Route::post('/', [JobController::class, 'store']);
        Route::get('/{id}', [JobController::class, 'show']);
        Route::post('/update/{id}', [JobController::class, 'update']);
        Route::post('/{id}', [JobController::class, 'destroy']);
        Route::get('search/{id}', [JobController::class, 'search']);

    });


    //      trainings routes
    Route::prefix("trainings")->group(function () {
        Route::get('/', [TrainingController::class, 'index']);
        Route::post('/', [TrainingController::class, 'store']);
        Route::get('/{id}', [TrainingController::class, 'show']);
        Route::post('/update/{id}', [TrainingController::class, 'update']);
        Route::post('/{id}', [TrainingController::class, 'destroy']);
        Route::get('search/{id}', [TrainingController::class, 'search']);

    });



    //      challenges routes
    Route::prefix("challenges")->group(function () {
        Route::get('/', [ChallengeController::class, 'index']);
        Route::post('/', [ChallengeController::class, 'store']);
        Route::get('/count', [ChallengeController::class, 'count']);
        Route::get('/{id}', [ChallengeController::class, 'show']);
        Route::post('/update/{id}', [ChallengeController::class, 'update']);
        Route::post('/{id}', [ChallengeController::class, 'destroy']);
        Route::get('search/{id}', [ChallengeController::class, 'search']);

    });


    //      challs routes
    Route::prefix("challs")->group(function () {
        Route::get('/', [ChallController::class, 'index']);
        Route::get('/{id}', [ChallController::class, 'show']);
        Route::post('/{id}', [ChallController::class, 'destroy']);
    });



    //      zones routes
    Route::prefix("zones")->group(function () {
        Route::get('/', [ZoneController::class, 'index']);
        Route::get('/count', [ZoneController::class, 'count']);
        Route::post('/', [ZoneController::class, 'store']);
        Route::get('/{id}', [ZoneController::class, 'show']);
        Route::post('/update/{id}', [ZoneController::class, 'update']);
        Route::post('/{id}', [ZoneController::class, 'destroy']);
        Route::get('search/{id}', [ZoneController::class, 'search']);

    });




    // scolarships

    Route::get('scolarships',[\App\Http\Controllers\ScolarshipController::class,'index']);
    Route::post('scolarships',[\App\Http\Controllers\ScolarshipController::class,'store']);
    Route::get('scolarships/{id}',[\App\Http\Controllers\ScolarshipController::class,'show']);
    Route::post('scolarships/update/{id}',[\App\Http\Controllers\ScolarshipController::class,'update']);
    Route::post('scolarships/{id}',[\App\Http\Controllers\ScolarshipController::class,'destroy']);




    // applicants

    Route::get('applicants',[\App\Http\Controllers\ApplicantController::class,'index']);
    Route::get('applicants/{id}',[\App\Http\Controllers\ApplicantController::class,'show']);
    Route::post('applicants/{id}',[\App\Http\Controllers\ApplicantController::class,'destroy']);



    // Documents_applicants

    Route::get('documents',[\App\Http\Controllers\DocumentController::class,'index']);
    Route::get('documents/{id}',[\App\Http\Controllers\DocumentController::class,'show']);
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

    Route::get('donation',[\App\Http\Controllers\DonationController::class,'index']);
    Route::get('donation/count',[\App\Http\Controllers\DonationController::class,'count']);
    Route::get('donation/sum',[\App\Http\Controllers\DonationController::class,'sum']);
    Route::post('donation/{id}',[\App\Http\Controllers\DonationController::class,'destroy']);
    Route::post('donation/update/{id}',[\App\Http\Controllers\DonationController::class,'update']);
    Route::get('donation/{id}',[\App\Http\Controllers\DonationController::class,'show']);


    //beneficiary
    Route::post('beneficiary',[\App\Http\Controllers\BeneficiariesController::class,'store']);
    Route::get('beneficiary/count',[\App\Http\Controllers\BeneficiariesController::class,'count']);
    Route::get('beneficiary',[\App\Http\Controllers\BeneficiariesController::class,'index']);
    Route::post('beneficiary/{id}',[\App\Http\Controllers\BeneficiariesController::class,'destroy']);
    Route::post('beneficiary/update/{id}',[\App\Http\Controllers\BeneficiariesController::class,'update']);
    Route::get('beneficiary/{id}',[\App\Http\Controllers\BeneficiariesController::class,'show']);
    Route::get('beneficiary/search/{id}', [\App\Http\Controllers\BeneficiariesController::class, 'search']);


    //      requests routes
    Route::prefix("requests")->group(function () {
        Route::get('/', [ReqController::class, 'index']);
        Route::get('/{id}', [ReqController::class, 'show']);
      Route::post('/accept/{id}', [ReqController::class, 'accept']);
        Route::post('/{id}', [ReqController::class, 'destroy']);

    });


    //      sponsors routes
    Route::prefix("sponsors")->group(function () {
        Route::get('/', [SponsorController::class, 'index']);
        Route::get('/count',[SponsorController::class,'count']);
      //  Route::post('/', [SponsorController::class, 'store']);
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



    });
