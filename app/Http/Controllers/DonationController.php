<?php

namespace App\Http\Controllers;

use App\Http\Resources\DonationResource;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class DonationController extends Controller
{
    use  ApiResponseTrait;

    public function index()
    {
        $donation = DonationResource::collection(Donation::get());
        return $this->apiResponse($donation, 'ok', 200);
    }
    public function store(Request $request)
    {
        $input=$request->all();
        $validator = Validator::make( $input, [
            'd_amount' => 'required',
            'd_date' => 'required',
            'user_id' => 'required',

        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        $donation =Donation::query()->create([
            'd_amount' =>$request->d_amount,
            'd_date' =>$request->d_date,
            'user_id' =>$request->user_id,
        ]);
        if ($donation) {
            return $this->apiResponse(new DonationResource($donation), 'the donation  save', 201);
        }
        return $this->apiResponse(null, 'the donation  not save', 400);
    }
    public function us_store(Request $request)
    {
        $input=$request->all();
        $validator = Validator::make( $input, [
            'd_amount' => 'required',
            'd_date' => 'required',
            'user_id' => 'required',

        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        $donation =Donation::query()->create([
            'd_amount' =>$request->d_amount,
            'd_date' =>$request->d_date,
            'user_id' =>$request->user_id,
        ]);
        if ($donation) {
            return $this->apiResponse(new DonationResource($donation), 'the donation  save', 201);
        }
        return $this->apiResponse(null, 'the donation  not save', 400);
    }

    public function show($id)
    {
        $donation= Donation::find($id);
        if($donation){
            return $this->apiResponse(new DonationResource($donation) , 'ok' ,200);
        }
        return $this->apiResponse(null ,'the donation not found' ,404);

    }


    public function update(Request $request,  $id)
    {
        $donation= Donation::find($id);
        if(!$donation)
        {
            return $this->apiResponse(null ,'the donation not found ',404);
        }
        $donation->update($request->all());
        if($donation)
        {
            return $this->apiResponse(new DonationResource($donation) , 'the donation update',201);

        }
    }


    public function destroy($id)
    {
        $donation= Donation::find($id);
        if(!$donation)
        {
            return $this->apiResponse(null ,'the donation not found ',404);
        }
        $donation->delete($id);
        if($donation)
            return $this->apiResponse(null ,'the donation delete ',200);

}
    public function count()
    {
        $donation = DonationResource::collection(Donation::get());
        return $donation->count();
    }
    public function us_count()
    {
        $donation = DonationResource::collection(Donation::get());
        return $donation->count();
    }

}
