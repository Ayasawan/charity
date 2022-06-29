<?php

namespace App\Http\Controllers;

use App\Models\College;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    use  ApiResponseTrait;

    public function index()
    {
        $colleges  =CollegeResource::collection(College::get());
        return $this->apiResponse($colleges,'ok',200);
    }

   
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        $college = College::find($id);
        if($college) {
            return $this->apiResponse(new CollegeResource($college), 'ok', 200);
        }
        return $this->apiResponse(null, 'This college not found', 404);
    }

   


    public function update(Request $request, College $college)
    {
        //
    }

  

    
    public function destroy(College $college)
    {
        //
    }
}
