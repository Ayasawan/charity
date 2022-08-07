<?php

namespace App\Http\Controllers;

use App\Http\Resources\CharityfoResource;
use App\Models\Charity;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
class CharityController extends Controller
{
    use  ApiResponseTrait;

    public function index()
    {
        $charity =CharityfoResource ::collection(Charity::get());
        return $this->apiResponse($charity, 'ok', 200);
    }
    public function us_index()
    {
        $charity =CharityfoResource ::collection(Charity::get());
        return $this->apiResponse($charity, 'ok', 200);
    }

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

    public function show($id)
    {
        $charity= Charity::find($id);
        if($charity){
            return $this->apiResponse(new CharityfoResource ($charity) , 'ok' ,200);
        }
        return $this->apiResponse(null ,'the charity not found' ,404);

    }

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
