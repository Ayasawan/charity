<?php

namespace App\Http\Controllers;

use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    use  ApiResponseTrait;

    public function index()
    {
        $conect = ImageResource::collection(Image::get());
        return $this->apiResponse($conect, 'ok', 200);
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
            'img_url' => ['nullable',],
            'charity_id' => 'required',

        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        $file_name = $this->saveImage($request->img_url, 'images/charity');

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



    public function update(Request $request,  $id)
    {
        $image= Image::find($id);
        if(!$image)
        {
            return $this->apiResponse(null ,'the image not found ',404);
        }
        $image->update($request->all());
        if($image)
        {
<<<<<<< Updated upstream
            return $this->apiResponse(new  ImageResource($imag) , 'the imag update',201);
=======
            return $this->apiResponse(new  ImageResource($image) , 'the image update',201);
>>>>>>> Stashed changes

        }
    }


    public function destroy($id)
    {
        $image= Image::find($id);
        if(!$image)
        {
            return $this->apiResponse(null ,'the image not found ',404);
        }
        $image->delete($id);
        if($image)
            return $this->apiResponse(null ,'the image delete ',200);
    }
}
