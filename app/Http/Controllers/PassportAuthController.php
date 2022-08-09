<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\RefreshToken;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;

class PassportAuthController extends Controller
{
    use  ApiResponseTrait;


    // public function Login(Request $request)
    // {
    //     $validator = Validator::make($request->all(),[
    //         'email' => ['required', 'string', 'email', 'max:255'],
    //         'password' => ['required', 'string', 'min:8','max:15'],
    //     ]);
    //     if($validator->fails()){
    //         return response()->json( $validator->errors()->all(), Response::HTTP_UNPROCESSABLE_ENTITY);
    //     }
    //     $credentials = request(['email', 'password']);
    //     if(!Auth::attempt($credentials)){
    //         throw new AuthenticationException();
    //     }

    //     $user = $request->user();
    //     $tokenResult = $user->createToken('Personal Access Token');

    //     $user=User::where('id','=',auth()->id())->first();//aa

    //     $role=Role::where('id','=',$user->role_id)->first();//aa

    //     $data["user"] = $user;
    //     $data["token_type"] = 'Bearer';
    //     $data["access_token"] = $tokenResult->accessToken;

    //     $data["role"]=$role;//aa
    //     $data["permissions"]=$role->permissions()->get();//aa

    //     return response()->json($data,Response::HTTP_OK);
    // }

    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => ['required', 'string', 'email', 'max:255' ,'unique:users',],
            'password' => ['required', 'string', 'min:8'],
           'first_name' => [ 'required' , 'string','min:3'],
           'last_name' => [ 'required' , 'string','min:3'],
        ]);
        if ($validator->fails()) {
            return $validator->errors()->all();
        }
        $request['password'] = Hash::make($request['password']);

        $user = User::create([
            'first_name'=> $request->first_name,
            'last_name'=> $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'login_date'=> date("d/m/y"),

        ]);
        $tokenResult = $user->createToken('Personal Access Token');
        $data["message"] = 'User Successfully registered';
        $data["user_type"] = 'user ';

        $data["user"] = $user;
        $data["token_type"] = 'Bearer';
        $data["access_token"] = $tokenResult->accessToken;

        return response()->json($data, Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function adminLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if(auth()->guard('admin')->attempt(['email' => request('email'), 'password' => request('password')])){

            config(['auth.guards.api.provider' => 'admin']);

            $admin = Admin::select('admins.*')->find(auth()->guard('admin')->user()->id);
            $success =  $admin;
            $success['token'] =  $admin->createToken('MyApp',['admin'])->accessToken;

            return response()->json($success, 200);
        }else{
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
        }
    }
   // public function adminDashboard()
//    {
//        $users = Admin::all();
//        $success =  $users;
//
//        return response()->json($success, 200);
//
//    }

    public function adminlogout(Request $request)
    {
        $token=$request->user()->token();
        $token->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function userLogin(Request $request)
    {           // $data["message"] = $success;

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if(auth()->guard('user')->attempt(['email' => request('email'), 'password' => request('password')])){

            config(['auth.guards.api.provider' => 'user']);

            $user = User::select('users.*')->find(auth()->guard('user')->user()->id);
            $success =  $user;
            $success["user_type"] = 'user ';
            $success['token'] =  $user->createToken('MyApp',['user'])->accessToken;

            return response()->json($success, 200);
        }else{
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
        }
    }



public function destroy($id)
{


    $res= User::find($id);
    if(!$res)
    {
        return $this->apiResponse(null ,'the user not found ',404);
    }
    $res->delete($id);
    if($res)
        return $this->apiResponse(null ,'the user delete ',200);

}
}
