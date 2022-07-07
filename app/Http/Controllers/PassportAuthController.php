<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PassportAuthController extends Controller
{

    public function Login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8','max:15'],
        ]);
        if($validator->fails()){
            return response()->json( $validator->errors()->all(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials)){
            throw new AuthenticationException();
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');

        $user=User::where('id','=',auth()->id())->first();//aa

        $role=Role::where('id','=',$user->role_id)->first();//aa

        $data["user"] = $user;
        $data["token_type"] = 'Bearer';
        $data["access_token"] = $tokenResult->accessToken;

        $data["role"]=$role;//aa
        $data["permissions"]=$role->permissions()->get();//aa

        return response()->json($data,Response::HTTP_OK);
    }




    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'email' => ['required', 'string', 'email', 'max:255' ,'unique:users',],
            'password' => ['required', 'string', 'min:8'],
            'first_name' => ['required', 'string', 'max:255', 'min:3'],
            'last_name' => ['required', 'string', 'max:255', 'min:3'],
        ]);
        if($validator->fails()){
            return $validator->errors()->all();
        }

        $request['password'] = Hash::make($request['password']);

        $user = User::create([

            'email' => $request->email,
            'password' => $request->password,
            'first_name'=> $request->first_name,
            'last_name'=> $request->last_name,

        ]);
        $tokenResult = $user->createToken('Personal Access Token');
        $data["message"] = 'User Successfully registered';
        $data["user"] = $user;
        $data["token_type"] = 'Bearer';
        $data["access_token"] = $tokenResult->accessToken;

        return response()->json($data,Response::HTTP_OK);
    }
    public function logout(Request $request)
    {
        $token=$request->user()->token();
        $token->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

}
