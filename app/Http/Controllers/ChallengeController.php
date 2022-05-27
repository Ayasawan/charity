<?php

namespace App\Http\Controllers;
use App\Http\Resources\ChallengeResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator;


use App\Models\Challenge;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    use  ApiResponseTrait;
    public function index()
    {
        $challenges  =ChallengeResource::collection(Challenge::get());
        return $this->apiResponse($challenges,'ok',200);
    }


    public function store(Request $request)
    {
        $input=$request->all();
        $validator = Validator::make($input , [
            'name'=>'required',
            'description'=>'required',
            'image'=>'required',
            'in_date'=>'required',
            'out_date'=>'required',
            'amount'=>'required',
            'amount_paid'=>'required',
            'charity_id'=>'required',
        ]);

        if ($validator->fails()){
            return $this->apiResponse(null,$validator ->errors() , 400);
        }
        $challenge =Challenge::create($request->all());
        if($challenge) {
            return $this->apiResponse(new ChallengeResource($challenge), 'This Challenge save', 201);
        }
        return $this->apiResponse(null, 'This Challenge not save', 400);
    }



    public function show( $id)
    {
        $challenge= Challenge::find($id);
        if($challenge){
            return $this->apiResponse(new ChallengeResource($challenge) , 'ok' ,200);
        }
        return $this->apiResponse(null ,'the challenge not found' ,404);
    }


    public function update(Request $request,  $id)
    {
        $challenge= Challenge::find($id);
        if(!$challenge)
        {
            return $this->apiResponse(null ,'the Challenge not found ',404);
        }
        $challenge->update($request->all());
        if($challenge)
        {
            return $this->apiResponse(new ChallengeResource($challenge) , 'the Challenge update',201);

        }
    }



    public function destroy( $id)
    {
        $challenge = Challenge::find($id);
        if(!$challenge)
        {
            return $this->apiResponse(null ,'the Challenge not found ',404);
        }
        $challenge->delete($id);
        if($challenge)
            return $this->apiResponse(null ,'the Challenge delete ',200);
    }
}
