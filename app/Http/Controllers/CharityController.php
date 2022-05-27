<?php

namespace App\Http\Controllers;

use App\Http\Resources\CharityfoResource;
use App\Models\Charity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class CharityController extends Controller
{
    use  ApiResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $charity =CharityfoResource ::collection(Charity::get());
        return $this->apiResponse($charity, 'ok', 200);
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
            'name' => 'required',
            'about' => 'required',

        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        $charity =Charity::query()->create([
            'name' =>$request->name,
            'about' =>$request->about,


        ]);
        if ($charity) {
            return $this->apiResponse(new CharityfoResource ($charity), 'the charity  save', 201);
        }
        return $this->apiResponse(null, 'the charity  not save', 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contentinfo  $contentinfo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $charity= Charity::find($id);
        if($charity){
            return $this->apiResponse(new CharityfoResource ($charity) , 'ok' ,200);
        }
        return $this->apiResponse(null ,'the charity not found' ,404);

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
        $charity= Charity::find($id);
        if(!$charity)
        {
            return $this->apiResponse(null ,'the charity not found ',404);
        }
        $charity->update($request->all());
        if($charity)
        {
            return $this->apiResponse(new CharityfoResource ($charity) , 'the charity update',201);

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
        $charity= Charity::find($id);
        if(!$charity)
        {
            return $this->apiResponse(null ,'the charity not found ',404);
        }
        $charity->delete($id);
        if($charity)
            return $this->apiResponse(null ,'the charity delete ',200);
    }
}
