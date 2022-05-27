<?php

namespace App\Http\Controllers;

use App\Http\Resources\ScolarshipResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Scolarship;
use Illuminate\Http\Request;

class ScolarshipController extends Controller
{
    use  ApiResponseTrait;

    public function index()

    {
        $scolarships  =ScolarshipResource::collection(Scolarship::get());
        return $this->apiResponse($scolarships,'ok',200);

    }




    public function store(Request $request)
    {
        $input=$request->all();
        $validator = Validator::make($input , [
            'max_number'=>'required',
            'description'=>'required',
            'image'=>['nullable',],
            'academic_years'=>'required',
            'charity_id'=>'required',
            'college_id'=>'required',

        ]);

        $file_name=$this->saveImage($request->image,'images/scolarship');


      

        if ($validator->fails()){
            return $this->apiResponse(null,$validator ->errors() , 400);
        }

        $scolarship = Scolarship::query()->create([
            'max_number' => $request->max_number,
            'image' => $file_name,
            'description' => $request->description,
            'academic_years' => $request->academic_years,
            'charity_id' => $request->charity_id,
            'college_id' => $request->college_id,

        ]);
        if($scolarship) {
            return $this->apiResponse(new ScolarshipResource($scolarship), 'This Scolarship save', 201);
        }
        return $this->apiResponse(null, 'This Scolarship not save', 400);
    }

    


    public function show($id)
    {
        $scolarship = Scolarship::find($id);
        if( $scolarship) {
            return $this->apiResponse(new ScolarshipResource($scolarship), 'ok', 200);
        }
        return $this->apiResponse(null, 'This Scolarship not found', 404);
    }

    


    public function update(Request $request,$id)
    {

       
        $scolarship = Scolarship::find($id);
        if(!$scolarship){
            return $this->apiResponse(null, 'This  Scolarship  not found', 404);
        }

        $scolarship->update($request->all());
        if($scolarship) {
            return $this->apiResponse(new ScolarshipResource(  $scolarship), 'This  Scolarship updated', 201);
        }
    }




    public function destroy($id)
    {
        $scolarship = Scolarship::find($id);
        if(! $scolarship){
            return $this->apiResponse(null, 'This Scolarship not found', 404);
        }
        $scolarship->delete($id);
        if( $scolarship) {
            return $this->apiResponse(null, 'This Scolarship deleted', 200);
        }
    }
}
