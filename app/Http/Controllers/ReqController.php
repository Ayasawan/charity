<?php

namespace App\Http\Controllers;
use App\Http\Resources\ReqResource;
use App\Http\Resources\PicResource;

use App\Models\Pic;
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

    public function us_index()
    {
        foreach (Req::query()->get() as $reqs){

          if($reqs['status']=1)  {
              return $this->apiResponse($reqs ,'ok',200);
          }
        }}

    public function us_store(Request $request)
    {
        $input=$request->all();
        $validator = Validator::make($input , [
            'age'=>'required',
            'gender'=>'required',
            'location'=>'required',
            'specialize'=>'required',
            'academic_years'=>'required',
            'value'=>'required',
            'description'=>'required',
            'phone'=> ['required', 'string', 'min:10'] ,

        ]);

        if ($validator->fails()){
            return $this->apiResponse(null,$validator ->errors() , 400);
        }

        $req =Req::query()->create([
            'user_id'=>auth()->id(),
            'age' => $request->age,
            'gender' => $request->gender,
            'location' => $request->location,
            'specialize' => $request->specialize,
            'academic_years' => $request->academic_years,
            'value' => $request->value,
            'description' => $request->description,
            'phone' => $request->phone,
            'status'=>'0',

        ]);
        if($req) {
            return $this->apiResponse(new ReqResource($req), 'Your request will be processed', 201);
        }
        return $this->apiResponse(null, 'This Request not save', 400);
    }

    public function show( $id)
    {
        $req = Req::find($id);
        if( $req) {
//            $pic = PicResource::collection(Pic::get())->where('request_id', '=', $req->id)->index();
//          //  $pic->show();
            return $this->apiResponse(new ReqResource($req), 'ok', 200);
        }
        return $this->apiResponse(null, 'This Request not found', 404);
    }



    public function accept(Request $request,  $id)
    {

        $req = Req::find($id);
        if(!$req){
            return $this->apiResponse(null, 'This Request not found', 404);
        }

        $req->update(['status' =>'1']);
        if($req) {
            return $this->apiResponse(new ReqResource(  $req), 'This Request accept', 201);
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
            return $this->apiResponse(null, 'This Request refuse', 200);
        }

    }









}
