<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AccessControl
{
    use ApiResponseTrait;
   
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        $user_role = Role::find($user->role_id);

        $permissionName = $request->route->getName();

        if( ! $user_role->check($permissionName))
        //    return  $this->apiResponse(null,$validator ->errors() , 400);
           return $this->apiResponse(null, 'Access Denied', 403);

        return $next($request);
    }
}
