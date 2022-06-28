<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobResource;
use App\Http\Resources\SponsorResource;
use App\Models\Job;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator;

class SponsorController extends Controller
{
    use  ApiResponseTrait;
    public function index()
    {
        $sponsors  =SponsorResource::collection(Sponsor::get());
        return $this->apiResponse($sponsors,'ok',200);
    }


    public function store( Request $request)
    {
        $input=$request->all();
        $validator = Validator::make($input , [
            'submission_date'=>'required',

        ]);

        if ($validator->fails()){
            return $this->apiResponse(null,$validator ->errors() , 400);
        }
        $sponsor =Sponsor::create($request->all());
        if($sponsor) {
            return $this->apiResponse(new SponsorResource($sponsor), 'This Sponsor save', 201);
        }
        return $this->apiResponse(null, 'This Sponsor not save', 400);
    }



    public function show( $id)
    {
        $sponsor = Sponsor::find($id);
        if( $sponsor) {
            return $this->apiResponse(new SponsorResource($sponsor), 'ok', 200);
        }
        return $this->apiResponse(null, 'This Sponsor not found', 404);
    }


    public function update(Request $request,  $id)
    {
        $sponsor = Sponsor::find($id);
        if(!$sponsor){
            return $this->apiResponse(null, 'This Sponsor not found', 404);
        }

        $sponsor->update($request->all());
        if($sponsor) {
            return $this->apiResponse(new SponsorResource(  $sponsor), 'This Sponsor update', 201);
        }
    }



    public function destroy( $id)
    {
        $sponsor = Sponsor::find($id);
        if(! $sponsor){
            return $this->apiResponse(null, 'This Sponsor not found', 404);
        }
        $sponsor->delete($id);
        if( $sponsor) {
            return $this->apiResponse(null, 'This Sponsor deleted', 200);
        }
    }
}
