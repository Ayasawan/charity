<?php

namespace App\Http\Controllers;
use App\Http\Resources\PicResource;

use App\Models\Document;
use App\Models\Pic;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator;

class PicController extends Controller
{

    public function index()
    {
        $pic = PicResource::collection(Pic::get());
        return $this->apiResponse($pic, 'ok', 200);
    }


    public function store(Request $request)
    {
        $input=$request->all();
        $validator = Validator::make( $input, [
            'name' => ['nullable',],
            'request_id' => 'required',

        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        $file_name = $this->saveImage($request->name, 'images/request');

        $pic =Pic::query()->create([
            'name' =>$file_name,
            'request_id' =>$request->request_id,
        ]);
        if ($pic) {
            return $this->apiResponse(new  PicResource($pic), 'the picture  save', 201);
        }
        return $this->apiResponse(null, 'the picture  not save', 400);
    }



    public function show( $id)
    {
        $pic= Pic::find($id);
        if($pic){
            return $this->apiResponse(new  PicResource($pic) , 'ok' ,200);
        }
        return $this->apiResponse(null ,'the picture not found' ,404);
    }



    public function update(Request $request,  $id)
    {
        $validator = Validator::make($request->all(), [

            'name' => ['nullable',],
            'request_id' => 'required',

        ]);

        $file_name = $this->saveImage($request->name, 'images/request');


        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        $pic = Pic::find($id);
        if (!$pic) {
            return $this->apiResponse(null, 'the picture not found ', 404);
        }
        $pic->update($request->all());
        $pic = Pic::query()->update([
            'name' => $file_name,
            'request_id' => $request->request_id,
        ]);
        // dd($document->toArray());

        if ($pic) {
            return $this->apiResponse(new  PicResource($pic), 'the picture update', 201);

        }
    }


    public function destroy( $id)
    {
        $pic= Pic::find($id);
        if(!$pic)
        {
            return $this->apiResponse(null ,'the picture not found ',404);
        }
        $pic->delete($id);
        if($pic)
            return $this->apiResponse(null ,'the picture deleted ',200);
    }
}
