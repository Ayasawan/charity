<?php

namespace App\Http\Controllers;

use App\Http\Resources\BeneficiaryResource;
use App\Models\Beneficiary;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class BeneficiariesController extends Controller
{
    use  ApiResponseTrait;
    public function index()
    {
        $beneficiary = BeneficiaryResource::collection(Beneficiary::get());
        return $this->apiResponse($beneficiary, 'ok', 200);
    }

    public function store(Request $request)
    {
        $input=$request->all();
        $validator = Validator::make( $input, [
            'name' => 'required',
            'age' => 'required',
            'location' => 'required',
            'date' => 'required',
            'amount' => 'required',
            'reason_off_benefit' => 'required',
            'charity_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        $beneficiary =Beneficiary::query()->create([
            'name' =>$request->name,
            'age' =>$request->age,
            'location' =>$request->location,
            'date' =>$request->date,
            'amount' =>$request->amount,
            'reason_off_benefit' =>$request->reason_off_benefit,
            'charity_id' =>$request->charity_id,
        ]);
        if ($beneficiary) {
            return $this->apiResponse(new BeneficiaryResource($beneficiary), 'the beneficiary  save', 201);
        }
        return $this->apiResponse(null, 'the beneficiary  not save', 400);
    }
    public function show($id)
    {
        $beneficiary= Beneficiary::find($id);
        if($beneficiary){
            return $this->apiResponse(new BeneficiaryResource($beneficiary) , 'ok' ,200);
        }
        return $this->apiResponse(null ,'the beneficiary not found' ,404);

    }
    public function update(Request $request,  $id)
    {
        $beneficiary= Beneficiary::find($id);
        if(!$beneficiary)
        {
            return $this->apiResponse(null ,'the beneficiary not found ',404);
        }
        $beneficiary->update($request->all());
        if($beneficiary)
        {
            return $this->apiResponse(new BeneficiaryResource($beneficiary) , 'the beneficiary update',201);

        }
    }
    public function destroy($id)
    {
        $beneficiary= Beneficiary::find($id);
        if(!$beneficiary)
        {
            return $this->apiResponse(null ,'the beneficiary not found ',404);
        }
        $beneficiary->delete($id);
        if($beneficiary)
            return $this->apiResponse(null ,'the beneficiary delete ',200);
    }

    //search on one product
    public function search($name)
    {
        $beneficiary=Beneficiary::where("name","like","%".$name."%")->get();
        if($beneficiary) {
            return $this->apiResponse($beneficiary, 'ok', 200);
        }
    }
}
