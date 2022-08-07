<?php

namespace App\Http\Controllers;
use App\Http\Resources\ReqResource;

use App\Models\Job;
use App\Models\Req;
use App\Models\Sponsor;
use App\Http\Resources\JobResource;
// use App\Http\Resources\ReqResource;
use App\Http\Resources\SponsorResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller;
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
          //  'user_id'=>auth()->id(),
           // 'sponsor_id'=>'required',
            'age'=>'required',
            'gender'=>'required',
            'location'=>'required',
            'specialize'=>'required',
            'academic_years'=>'required',
            'value'=>'required',
            'description'=>'required',
            'phone'=> ['required', 'string', 'min:10'] ,
          //  'status'=>'required',
        ]);

        if ($validator->fails()){
            return $this->apiResponse(null,$validator ->errors() , 400);
        }
       // $req =Req::create($request->all());
        $req =Req::query()->create([
            'user_id'=>auth()->id(),
            'sponsor_id' => '0',
            'age' => $request->age,
            'gender' => $request->gender,
            'location' => $request->location,
            'specialize' => $request->specialize,
            'academic_years' => $request->academic_years,
            'value' => $request->value,
            'description' => $request->description,
            'phone' => $request->phone,
            'status'=>'0'

            
        ]);
        if($req) {
            return $this->apiResponse(new ReqResource($req), 'This Request save', 201);
        }
        return $this->apiResponse(null, 'This Request not save', 400);
    }


    public function us_store(Request $request)
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






//    public function userstore(Request $request)
//     {

//         $input=$request->all();
//         $validator = Validator::make($input , [
//             'user_id'=>auth()->id(),
//            // 'sponsor_id'=>'required',
//             'age'=>'required',
//             'gender'=>'required',
//             'location'=>'required',
//             'specialize'=>'required',
//             'academic_years'=>'required',
//             'value'=>'required',
//             'description'=>'required',
//             'phone'=> ['required', 'string', 'min:10'] ,
//            // 'status'=>'required',
//         ]);

//         if ($validator->fails()){
//             return $this->apiResponse(null,$validator ->errors() , 400);
//         }
//         $req =Req::create($request->all());
//         if($req) {
//             return $this->apiResponse(new ReqResource($req), 'This Request save', 201);
//         }
//         return $this->apiResponse(null, 'This Request not save', 400);
//     }


public function spons(Request $request,  $id){
    $req = Req::find($id);
    // if(!$req){
    //     return $this->apiResponse(null, 'This Request not found', 404);
    // }

    // if($req->status='1'){
    //     return $this->apiResponse(null, 'This Request not found', 404);
    // }
    if($req) {
    // $spp=Sponsor::find($id2);
    // if(!$spp){
        $validator = Validator::make($request->all() , [
            'bank_num'=>['required', 'string', 'min:10'] ,
            'first_paid'=>['required', 'double', 'min:10'] ,      
        ]);
        if ($validator->fails()){
            return $this->apiResponse(null,$validator ->errors() , 400);
        $spp=Sponsor::where("bank_num","like",$request->bank_num)->get();
     if(!$spp)
        $ssp =Sponsor::query()->create([
            'bank_num' => $request->bank_num,
            'first_paid' => $request->first_paid,
            'submission_date'=>date("d/m/y"),
        ]);
        $req->update($request->all());
        $req->update(['sponsor_id' =>$ssp ->id(),
                         'status'=>'true',
                         'value'=>$request->value,]);
    }

    if($spp){
       $req = Req::find($id);
        $req->update(['sponsor_id' =>$spp->$id,
                         'status'=>'true',
                         'value'=>$request->value,]);
    }
        return $this->apiResponse(new ReqResource( $req), 'This student sponsored', 201);
    }
}

    
}