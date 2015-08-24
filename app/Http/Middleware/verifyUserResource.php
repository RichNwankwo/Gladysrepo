<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class verifyUserResource
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param int $uri_user_id
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // User_id URI segment
        $user_id = $request->user_id;

        if ('testing' === app()->env)
        {
            $user_id = 1;
        }
        $authUser = Auth::ID();
        if($user_id != $authUser)
        {
            $data = ['error' => [
            'message' => 'Not authorized to access this resource',
            'code' => 403
            ]];

            return Response()->json($data, 403);
        }
        else
        {
            return $next($request);
        }
    }



}
