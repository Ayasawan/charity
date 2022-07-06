<?php

namespace App\Http\Controllers;
use App\Http\Resources\JobResource;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

use App\Models\Job;
use Illuminate\Http\Request;


class JobController extends Controller
{
    use  ApiResponseTrait;
    public function index()
    {
        $jobs  =JobResource::collection(Job::get());
        return $this->apiResponse($jobs,'ok',200);
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
        $job =Job::create($request->all());
        if($job) {
            return $this->apiResponse(new JobResource($job), 'This Job save', 201);
        }
        return $this->apiResponse(null, 'This Job not save', 400);
    }





    public function show( $id)
    {
        $job = Job::find($id);
        if( $job) {
            return $this->apiResponse(new JobResource($job), 'ok', 200);
        }
        return $this->apiResponse(null, 'This Job not found', 404);
    }


    public function update(Request $request,  $id)
    {

        $job = Job::find($id);
        if(!$job){
            return $this->apiResponse(null, 'This Job not found', 404);
        }

        $job->update($request->all());
        if($job) {
            return $this->apiResponse(new JobResource(  $job), 'This Job update', 201);
        }
    }


    public function destroy( $id)
    {
        $job = Job::find($id);
        if(! $job){
            return $this->apiResponse(null, 'This Job not found', 404);
        }
        $job->delete($id);
        if( $job) {
            return $this->apiResponse(null, 'This Job deleted', 200);
        }
    }

    //search on one product
    public function search($name)
    {
        $job=Job::where("name","like","%".$name."%")->get();
        if($job) {
            return $this->apiResponse($job, 'ok', 200);
        }
    }
}
