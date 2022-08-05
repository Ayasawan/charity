<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//use Illuminate\Support\Facades\Validator;


class LocationController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $location = LocationResource::collection(Location::get());
        return $this->apiResponse($location, 'ok', 200);
    }
    public function us_index()
    {
        $location = LocationResource::collection(Location::get());
        return $this->apiResponse($location, 'ok', 200);
    }

    public function store(Request $request)
    {
        $input=$request->all();
        $validator = Validator::make( $input, [
            'govemorate' => 'required',
            'city' => 'required',
            'street' => 'required',
          'charity_id'=>'required',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        $location =Location::create($request->all());

        if ($location) {
            return $this->apiResponse(new LocationResource($location), 'the Location  save', 201);
        }
        return $this->apiResponse(null, 'the Location  not save', 400);
    }

    public function show($id)
    {
        $location= Location::find($id);
        if($location){
            return $this->apiResponse(new LocationResource($location) , 'ok' ,200);
        }
        return $this->apiResponse(null ,'the location not found' ,404);

    }
    public function us_show($id)
    {
        $location= Location::find($id);
        if($location){
            return $this->apiResponse(new LocationResource($location) , 'ok' ,200);
        }
        return $this->apiResponse(null ,'the location not found' ,404);

    }
    public function update(Request $request,  $id)
    {
        $location = Location::find($id);
        if (!$location) {
            return $this->apiResponse(null, 'the Location not found ', 404);
        }
        $location->update($request->all());
        if ($location) {
            return $this->apiResponse(new LocationResource($location), 'the Location update', 201);

        }
    }

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
