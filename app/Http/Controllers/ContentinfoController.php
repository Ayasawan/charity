<?php

namespace App\Http\Controllers;
use App\Http\Resources\ContentinfoResource;
use App\Models\Contentinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContentinfoController extends Controller
{
    use  ApiResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conect =ContentinfoResource::collection(Contentinfo::get());
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
          'department' => 'required',
            'contact' => 'required',
            'charity_id' => 'required',

        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        $conect =Contentinfo::query()->create([
            'department' =>$request->department,
            'contact' =>$request->contact,
            'charity_id' =>$request->charity_id,
        ]);
        if ($conect) {
            return $this->apiResponse(new ContentinfoResource($conect), 'the conection  save', 201);
        }
        return $this->apiResponse(null, 'the conection  not save', 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contentinfo  $contentinfo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conect= Contentinfo::find($id);
        if($conect){
            return $this->apiResponse(new ContentinfoResource($conect) , 'ok' ,200);
        }
        return $this->apiResponse(null ,'the conect not found' ,404);

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
        $conect= Contentinfo::find($id);
        if(!$conect)
        {
            return $this->apiResponse(null ,'the conect not found ',404);
        }
        $conect->update($request->all());
        if($conect)
        {
            return $this->apiResponse(new ContentinfoResource($conect) , 'the conect update',201);

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
        $conect= Contentinfo::find($id);
        if(!$conect)
        {
            return $this->apiResponse(null ,'the conect not found ',404);
        }
        $conect->delete($id);
        if($conect)
            return $this->apiResponse(null ,'the conect delete ',200);
    }
}
