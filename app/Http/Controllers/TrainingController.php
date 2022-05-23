<?php

namespace App\Http\Controllers;
use App\Http\Resources\TrainingResource;
use App\Models\Job;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator;

use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    use  ApiResponseTrait;
    public function index()
    {
        $training  =TrainingResource::collection(Training::get());
        return $this->apiResponse($training,'ok',200);
    }


    public function store(Request $request)
    {
        $input=$request->all();
        $validator = Validator::make($input , [
            'name'=>'required',
            'about'=>'required',
            'out_date'=>'required',
            'phone'=>'required',
            'charity_id'=>'required',
        ]);

        if ($validator->fails()){
            return $this->apiResponse(null,$validator ->errors() , 400);
        }
        $training =Training::create($request->all());
        if($training) {
            return $this->apiResponse(new TrainingResource($job), 'This Training save', 201);
        }
        return $this->apiResponse(null, 'This Training not save', 400);
    }


    public function show(Training $training)
    {
        $training = Training::find($id);
        if( $training) {
            return $this->apiResponse(new JobResource($training), 'ok', 200);
        }
        return $this->apiResponse(null, 'This Training not found', 404);
    }


    public function update(Request $request, Training $training)
    {
        $validator = Validator::make($request->all() , [
            'name'=>'required',
            'about'=>'required',
            'out_date'=>'required',
            'phone'=>'required',
            'charity_id'=>'required',
        ]);

        if ($validator->fails()){
            return $this->apiResponse(null,$validator ->errors() , 400);
        }

        $training = Training::find($id);
        if(!$training){
            return $this->apiResponse(null, 'This training not found', 404);
        }

        $training->update($request->all());
        if($training) {
            return $this->apiResponse(new TrainingResource(  $training), 'This training update', 201);
        }
    }


    public function destroy(Training $training)
    {
        $training = Training::find($id);
        if(! $training){
            return $this->apiResponse(null, 'This Training not found', 404);
        }
        $training->delete($id);
        if( $training) {
            return $this->apiResponse(null, 'This Training deleted', 200);
        }
    }
}
