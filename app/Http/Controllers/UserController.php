<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponseTrait;

    public function login(Request $request)
    {
        $login_data = Validator::make($request->all(), [
            "email" => "required",
            "password" => "required|min:6|max:15",
        ]);
    }
}
