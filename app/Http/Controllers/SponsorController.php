<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobResource;
use App\Http\Resources\ReqController;
use App\Http\Resources\SponsorResource;
use App\Models\Job;
use App\Models\Sponsor;
use App\Models\Req;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller;
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
            'phone'=>'required',
            'bank_num'=>'required',
           'first_paid'=>'required',


        ]);

        if ($validator->fails()){
            return $this->apiResponse(null,$validator ->errors() , 400);
        }
        $sponsor =Sponsor::create([
                        'bank_num' => $request->bank_num,
                        'first_paid' => $request->first_paid,
                       'submission_date'=>date("d/m/y"),
                             'phone'=>$request->phone,

        ]);
        if($sponsor) {
            return $this->apiResponse(new SponsorResource($sponsor), 'Thank you for your warranty, we will contact you soon', 201);
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
        if (!$sponsor) {
            return $this->apiResponse(null, 'This Sponsor not found', 404);
        }
        $sponsor->delete($id);
        if ($sponsor) {
            return $this->apiResponse(null, 'This Sponsor deleted', 200);
        }
    }

        public function count()
    {
        $sponsor = SponsorResource::collection(Sponsor::get());
        return $sponsor->count();
    }

        public function us_count()
    {
        $sponsor = SponsorResource::collection(Sponsor::get());
        return $sponsor->count();
    }










    // public function spons(Request $request,  $id){
    //     $req = Req::find($id);
    //     if(!$req){
    //         return $this->apiResponse(null, 'This Request not found', 404);
    //     }

    //     if($req->status=true){
    //         return $this->apiResponse(null, 'This Request not found', 404);
    //     }
    //     if($req) {
    //     // $spp=Sponsor::find($id2);
    //     // if(!$spp){
    //         $validator = Validator::make($request->all() , [
    //             'bank_num'=>['required', 'string', 'min:10'] ,
    //             'first_paid'=>['required', 'double', 'min:10'] ,
    //         ]);
    //         if ($validator->fails()){
    //             return $this->apiResponse(null,$validator ->errors() , 400);
    //         $spp=Sponsor::where("bank_num","like",$request->bank_num)->get();
    //      if(!$spp)
    //         $ssp =Sponsor::query()->create([
    //             'bank_num' => $request->bank_num,
    //             'first_paid' => $request->first_paid,
    //             'submission_date'=>date("d/m/y"),
    //         ]);
    //         $req->update($request->all());
    //         $req->update(['sponsor_id' =>$ssp ->id(),
    //                          'status'=>'true',
    //                          'value'=>$request->value,]);
    //     }

    //     if($spp){
    //        $req = Req::find($id);
    //         $req->update(['sponsor_id' =>$spp->$id,
    //                          'status'=>'true',
    //                          'value'=>$request->value,]);
    //     }
    //         return $this->apiResponse(new ReqResource( $req), 'This student sponsored', 201);
    //     }
    // }

}
