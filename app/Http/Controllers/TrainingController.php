<?php

namespace App\Http\Controllers;
use App\Http\Resources\TrainingResource;

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
            'phone'=> ['required', 'string', 'min:10'] ,
            'charity_id'=>'required',
        ]);

        if ($validator->fails()){
            return $this->apiResponse(null,$validator ->errors() , 400);
        }
        $training =Training::create($request->all());
        if($training) {
            return $this->apiResponse(new TrainingResource($training), 'This Training save', 201);
        }
        return $this->apiResponse(null, 'This Training not save', 400);
    }


    public function show($id )
    {
        $training = Training::find($id);
        if( $training) {
            return $this->apiResponse(new TrainingResource($training), 'ok', 200);
        }
        return $this->apiResponse(null, 'This Training not found', 404);
    }


    public function update(Request $request, $id)
    {
        $training = Training::find($id);
        if(!$training){
            return $this->apiResponse(null, 'This training not found', 404);
        }

        $training->update($request->all());
        if($training) {
            return $this->apiResponse(new TrainingResource(  $training), 'This training update', 201);
        }
    }


    public function destroy($id)
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

    //search on one product
    public function search($name)
    {
        $training=Training::where("name","like","%".$name."%")->get();
        if($training) {
            return $this->apiResponse($training, 'ok', 200);
        }
    }
}
