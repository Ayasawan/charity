<?php

namespace App\Http\Controllers;
use App\Http\Resources\ApplicantResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Applicant;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    use  ApiResponseTrait;

    public function index()
    {
        $applicants  =ApplicantResource::collection(Applicant::get());
        return $this->apiResponse($applicants,'ok',200);
    }
    public function store(Request $request)
    {
        $input=$request->all();
        $validator = Validator::make($input , [
            'user_id'=>'required',
            'scolarship_id'=>'required',
            'age'=> ['required', 'string', 'min:2'] ,
            'gender'=>'required',
            'location'=>'required',
            'phone'=> ['required', 'string', 'min:10'] ,
        ]);

        if ($validator->fails()){
            return $this->apiResponse(null,$validator ->errors() , 400);
        }
        $applicant =Applicant::create($request->all());
        if($applicant) {
            return $this->apiResponse(new ApplicantResource($applicant), 'This  applicant save', 201);
        }
        return $this->apiResponse(null, 'This  applicant not save', 400);
    }
    public function show($id)
    {
        $applicant = Applicant::find($id);
        if( $applicant) {
            return $this->apiResponse(new ApplicantResource($applicant), 'ok', 200);
        }
        return $this->apiResponse(null, 'This  applicant not found', 404);
    }




    public function update(Request $request,$id)
    {

        $applicant = Applicant::find($id);
        if(!$applicant){
            return $this->apiResponse(null, 'This  applicant not found', 404);
        }
        $applicant->update($request->all());
        if($applicant) {
            return $this->apiResponse(new ApplicantResource(  $applicant), 'This  applicant updated', 201);
        }
    }




    public function destroy($id)
    {
        $applicant = Applicant::find($id);
        if(! $applicant){
            return $this->apiResponse(null, 'This applicant not found', 404);
        }
        $applicant->delete($id);
        if( $applicant) {
            return $this->apiResponse(null, 'This  applicant deleted', 200);
        }
    }

}
