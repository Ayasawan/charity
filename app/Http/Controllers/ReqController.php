<?php

namespace App\Http\Controllers;
use App\Http\Resources\ReqResource;

use App\Models\Job;
use App\Models\Req;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator;

class ReqController extends Controller
{
    use  ApiResponseTrait;
    public function index()
    {
        $reqs  =ReqResource::collection(Req::get());
        return $this->apiResponse($reqs,'ok',200);
    }


    public function store(Request $request)
    {
        $input=$request->all();
        $validator = Validator::make($input , [
            'user_id'=>'user_id',
            'sponsor_id'=>'sponsor_id',
            'age'=>'age',
            'gender'=>'gender',
            'location'=>'location',
            'specialization'=>'specialization',
            'academic_years'=>'academic_years',
            'value'=>'value',
            'description'=>'description',
            'phone'=>'phone',
            'status'=>'status',
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Req  $req
     * @return \Illuminate\Http\Response
     */
    public function show(Req $req)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Req  $req
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Req $req)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Req  $req
     * @return \Illuminate\Http\Response
     */
    public function destroy(Req $req)
    {
        //
    }
}
