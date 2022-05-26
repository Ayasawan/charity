<?php

namespace App\Http\Controllers;
use App\Http\Resources\ZoneResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    use  ApiResponseTrait;

    public function index()
    {
        $zones  =ZoneResource::collection(Zone::get());
        return $this->apiResponse($zones,'ok',200);

    }




    public function store(Request $request)
    {
        $input=$request->all();
        $validator = Validator::make($input , [
            'name'=>'required',
            'location'=>'required',
            'phone'=>'required',
            'available_times'=>'required',
            'description'=>'required',
            'charity_id'=>'required',

        ]);

        if ($validator->fails()){
            return $this->apiResponse(null,$validator ->errors() , 400);
        }
        $zone =Zone::create($request->all());
        if($zone) {
            return $this->apiResponse(new ZoneResource($zone), 'This Zone save', 201);
        }
        return $this->apiResponse(null, 'This Zone not save', 400);
    }

    


    public function show($id)
    {
        $zone = Zone::find($id);
        if( $zone) {
            return $this->apiResponse(new ZoneResource($zone), 'ok', 200);
        }
        return $this->apiResponse(null, 'This Zone not found', 404);
    }

    


    public function update(Request $request,$id)
    {
        // $validator = Validator::make($request->all() , [
        //     'name'=>'required',
        //     'about'=>'required',
        //     'out_date'=>'required',
        //     'phone'=>'required',
        //     'charity_id'=>'required',
        // ]);

        // if ($validator->fails()){
        //     return $this->apiResponse(null,$validator ->errors() , 400);
        // }

        $zone = Zone::find($id);
        if(!$zone){
            return $this->apiResponse(null, 'This  Study Zone not found', 404);
        }

        $zone->update($request->all());
        if($zone) {
            return $this->apiResponse(new ZoneResource(  $zone), 'This  Study Zone updated', 201);
        }
    }




    public function destroy($id)
    {
        $zone = Zone::find($id);
        if(! $zone){
            return $this->apiResponse(null, 'This Zone not found', 404);
        }
        $zone->delete($id);
        if( $zone) {
            return $this->apiResponse(null, 'This Zone deleted', 200);
        }
    }
}
