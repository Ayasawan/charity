<?php

namespace App\Http\Controllers;

use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    use  ApiResponseTrait;


    public function index()
    {
        $imag = ImageResource::collection(Image::get());
        return $this->apiResponse($imag, 'ok', 200);
    }
    public function us_index()
    {
        $imag = ImageResource::collection(Image::get());
        return $this->apiResponse($imag, 'ok', 200);
    }
    public function store(Request $request)
    {

        $input=$request->all();
        $validator = Validator::make( $input, [
            'img_url' => ['nullable',],
            'charity_id' => 'required',

        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        $file_name = $this->saveImage($request->img_url,'images/charity');

        $imag =Image::query()->create([
            'img_url' =>$file_name,
            'charity_id' =>$request->charity_id,
        ]);
        if ($imag) {
            return $this->apiResponse(new  ImageResource($imag), 'the imag  save', 201);
        }
        return $this->apiResponse(null, 'the imag  not save', 400);
    }
    public function show($id)
    {
        $imag= Image::find($id);
        if($imag){
            return $this->apiResponse(new  ImageResource($imag) , 'ok' ,200);
        }
        return $this->apiResponse(null ,'the imag not found' ,404);
    }
    public function us_show($id)
    {
        $imag= Image::find($id);
        if($imag){
            return $this->apiResponse(new  ImageResource($imag) , 'ok' ,200);
        }
        return $this->apiResponse(null ,'the imag not found' ,404);

    }
    public function update(Request $request,  $id)
    {
        $imag= Image::find($id);
        if(!$imag)
        {
            return $this->apiResponse(null ,'the image not found ',404);
        }
        $imag->update($request->all());
        $file_name=$this->saveImage($request->$imag,'images/charity');
        $imag->img_url= $file_name;
        $imag->update(['img_url' => $file_name]);

        if($imag)
            $imag->update($request->all());
        if($imag)
        {

            return $this->apiResponse(new  ImageResource($imag) , 'the imag update',201);


        }
    }

    public function destroy($id)
    {
        $imag= Image::find($id);
        if(!$imag)
        {
            return $this->apiResponse(null ,'the image not found ',404);
        }
        $imag->delete($id);
        if($imag)
            return $this->apiResponse(null ,'the image delete ',200);
    }
}
