<?php

namespace App\Http\Controllers;
use App\Http\Resources\ContentinfoResource;
use App\Models\Contentinfo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class ContentinfoController extends Controller
{
    use  ApiResponseTrait;

    public function index()
    {
        $conect =ContentinfoResource::collection(Contentinfo::get());
        return $this->apiResponse($conect, 'ok', 200);
    }
    public function us_index()
    {
        $conect =ContentinfoResource::collection(Contentinfo::get());
        return $this->apiResponse($conect, 'ok', 200);
    }

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

    public function show($id)
    {
        $conect= Contentinfo::find($id);
        if($conect){
            return $this->apiResponse(new ContentinfoResource($conect) , 'ok' ,200);
        }
        return $this->apiResponse(null ,'the conect not found' ,404);

    }

    public function us_show($id)
    {
        $conect= Contentinfo::find($id);
        if($conect){
            return $this->apiResponse(new ContentinfoResource($conect) , 'ok' ,200);
        }
        return $this->apiResponse(null ,'the conect not found' ,404);

    }

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
