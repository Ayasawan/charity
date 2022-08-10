<?php

namespace App\Http\Controllers;
use App\Http\Resources\ChallengeResource;
use App\Http\Resources\ChallResource;
use App\Http\Resources\DonationResource;
use App\Models\Donation;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Chall;
use App\Models\Challenge;
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

        $input = $request->all();
        $validator = Validator::make($input, [
            'challenge_id' => 'required',
            'c_amount' => 'required',
            'bank_num'=>'required',

        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        $chall = Chall::query()->create([
            'challenge_id' => $request->challenge_id,
            'user_id' =>auth()->id(),
            'c_amount' => $request->c_amount,
            'bank_num' => $request->bank_num,
            'c_date' =>date("d/m/y"),
        ]);


        if ($chall) {
            $id = $chall->challenge_id;

            $challenge = Challenge::find($id);
            if (!$challenge) {
                return $this->apiResponse(null, 'the  not found ', 404);
            }
            if ($challenge) {
                if ($challenge->id == $chall->challenge_id)
                {
                    if (($chall->c_amount + $challenge->amount_paid) > $challenge->amount  )
                    {
                        if($challenge->amount == $challenge->amount_paid) {
                            $challenge->delete($id);
                            return $this->apiResponse(null, 'THANK YOU ^^ , the Challenge had enough money ', 200);
                        }

                    }

                    if($chall->c_amount <= $challenge->amount - $challenge->amount_paid){
                        $total_amount_paid = ($challenge->amount_paid + $chall->c_amount);
                        $challenge->amount_paid = $total_amount_paid;
                        $challenge->update(['amount_paid' => $total_amount_paid]);
                        return $this->apiResponse(new ChallengeResource($challenge), 'ok', 200);
                    }
                }

                if ($challenge->id == $chall->challenge_id)
                {
                    if($chall->c_amount > $challenge->amount - $challenge->amount_paid){
                        $chall->delete();
                        return $this->apiResponse(null, 'The Challenge needs less amount of money ', 200);}

                }


            }

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


    public function us_sum()
    {
        $chall = ChallResource::collection(Chall::get())->where('user_id', '=', auth()->id());
         return $chall->sum('c_amount');


    }

}
