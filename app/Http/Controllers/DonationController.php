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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donation = DonationResource::collection(Donation::get());
        return $this->apiResponse($donation, 'ok', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $donation= Donation::find($id);
        if($donation){
            return $this->apiResponse(new DonationResource($donation) , 'ok' ,200);
        }
        return $this->apiResponse(null ,'the donation not found' ,404);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
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
}
