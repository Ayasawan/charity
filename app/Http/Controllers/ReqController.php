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
        return $this->apiResponse($reqs ,'ok',200);
    }


    public function store(Request $request)
    {

        $input=$request->all();
        $validator = Validator::make($input , [
            'user_id'=>'required',
            'sponsor_id'=>'required',
            'age'=>'required',
            'gender'=>'required',
            'location'=>'required',
            'specialize'=>'required',
            'academic_years'=>'required',
            'value'=>'required',
            'description'=>'required',
            'phone'=> ['required', 'string', 'min:10'] ,
            'status'=>'required',
        ]);

        if ($validator->fails()){
            return $this->apiResponse(null,$validator ->errors() , 400);
        }
        $req =Req::create($request->all());
        if($req) {
            return $this->apiResponse(new ReqResource($req), 'This Request save', 201);
        }
        return $this->apiResponse(null, 'This Request not save', 400);
    }




    public function show( $id)
    {
        $req = Req::find($id);
        if( $req) {
            return $this->apiResponse(new ReqResource($req), 'ok', 200);
        }
        return $this->apiResponse(null, 'This Request not found', 404);
    }



    public function update(Request $request,  $id)
    {
        $req = Req::find($id);
        if(!$req){
            return $this->apiResponse(null, 'This Request not found', 404);
        }

        $req->update($request->all());
        if($req) {
            return $this->apiResponse(new ReqResource(  $req), 'This Request update', 201);
        }
    }


    public function destroy( $id)
    {
        $req = Req::find($id);
        if(! $req){
            return $this->apiResponse(null, 'This Request not found', 404);
        }
        $req->delete($id);
        if( $req) {
            return $this->apiResponse(null, 'This Request deleted', 200);
        }
    }
}
