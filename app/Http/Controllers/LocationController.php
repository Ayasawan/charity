<?php

namespace App\Http\Controllers;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LocationController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $location = LocationResource::collection(Location::get());
        return $this->apiResponse($location, 'ok', 200);
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
            'govemorate' => 'required',
            'city' => 'required',
            'street' => 'required',

        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        $location =Location::query()->create([
            'govemorate' =>$request->govemorate,
            'city' =>$request->city,
            'street' =>$request->street,
        ]);
        if ($location) {
            return $this->apiResponse(new LocationResource($location), 'the Location  save', 201);
        }
        return $this->apiResponse(null, 'the Location  not save', 400);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location= Location::find($id);
        if($location){
            return $this->apiResponse(new LocationResource($location) , 'ok' ,200);
        }
        return $this->apiResponse(null ,'the location not found' ,404);

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
        $location= Location::find($id);
        if(!$location)
        {
            return $this->apiResponse(null ,'the Location not found ',404);
        }
        $location->update($request->all());
        if($location)
        {
            return $this->apiResponse(new LocationResource($location) , 'the Location update',201);

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
        $location= Location::find($id);
        if(!$location)
        {
            return $this->apiResponse(null ,'the location not found ',404);
        }
        $location->delete($id);
        if($location)
            return $this->apiResponse(null ,'the location delete ',200);
    }
}
