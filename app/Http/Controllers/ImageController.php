<?php

namespace App\Http\Controllers;

use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    use  ApiResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contentinfo  $contentinfo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $imag= Image::find($id);
        if($imag){
            return $this->apiResponse(new  ImageResource($imag) , 'ok' ,200);
        }
        return $this->apiResponse(null ,'the imag not found' ,404);

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
        $imag= Image::find($id);
        if(!$imag)
        {
            return $this->apiResponse(null ,'the imag not found ',404);
        }
        $imag->update($request->all());
        if($imag)
        {
            return $this->apiResponse(new  ImageResource($conect) , 'the imag update',201);

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
        $imag= Image::find($id);
        if(!$imag)
        {
            return $this->apiResponse(null ,'the imag not found ',404);
        }
        $imag->delete($id);
        if($imag)
            return $this->apiResponse(null ,'the imag delete ',200);
    }
}
