<?php

namespace App\Http\Controllers;
use App\Http\Resources\ChallResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator;

use App\Models\Chall;
use Illuminate\Http\Request;

class ChallController extends Controller
{
    use  ApiResponseTrait;
    public function index()
    {
        $chall = ChallResource::collection(Chall::get());
        return $this->apiResponse($chall, 'ok', 200);
    }


    public function store(Request $request)
    {
        $input=$request->all();
        $validator = Validator::make( $input, [
            'challenge_id' => 'required',
            'user_id' => 'required',
            'c_amount' => 'required',
            'c_date' => 'required',

        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        $chall =Chall::query()->create([
            'challenge_id' =>$request->challenge_id,
            'user_id' =>$request->user_id,
            'c_amount' =>$request->c_amount,
            'c_date' =>$request->c_date,
        ]);
        if ($chall) {
            return $this->apiResponse(new ChallResource($chall), 'the Chall  save', 201);
        }
        return $this->apiResponse(null, 'the Chall  not save', 400);
    }


    public function show( $id)
    {
        $chall= Chall::find($id);
        if($chall){
            return $this->apiResponse(new ChallResource($chall) , 'ok' ,200);
        }
        return $this->apiResponse(null ,'the Chall not found' ,404);
    }


    public function update(Request $request,  $id)
    {
        $chall= Chall::find($id);
        if(!$chall)
        {
            return $this->apiResponse(null ,'the Chall not found ',404);
        }
        $chall->update($request->all());
        if($chall)
        {
            return $this->apiResponse(new ChallResource($chall) , 'the Chall update',201);

        }
    }


    public function destroy( $id)
    {
        $chall= Chall::find($id);
        if(!$chall)
        {
            return $this->apiResponse(null ,'the Chall not found ',404);
        }
        $chall->delete($id);
        if($chall)
            return $this->apiResponse(null ,'the Chall delete ',200);
    }
}
