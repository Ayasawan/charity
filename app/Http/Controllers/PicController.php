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
    use  ApiResponseTrait;
    public function index()
    {
        $pic = PicResource::collection(Pic::get());
        return $this->apiResponse($pic, 'ok', 200);
    }


    public function store(Request $request)
    {
        $input=$request->all();
        $validator = Validator::make( $input, [
            'name' =>['nullable',],
          'requ_id' =>'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        $file_name=$this->saveImage($request->name,'images/request');

        $pic =Pic::query()->create([
            'name'=>$file_name,
            'requ_id'=>$request->requ_id,
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
        $pic= Pic::find($id);
        if(!$pic)
        {
            return $this->apiResponse(null ,'the picture not found ',404);
        }

        $pic->update($request->all());
        $file_name=$this->saveImage($request->name,'images/request');
        $pic->name= $file_name;
        $pic->update(['name' => $file_name]);

        if($pic)
        {
            return $this->apiResponse(new  PicResource($pic) , 'the picture update',201);
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
