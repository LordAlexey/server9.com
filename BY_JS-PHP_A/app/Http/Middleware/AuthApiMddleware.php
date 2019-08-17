<?php

namespace App\Http\Middleware;

use App\Attendee;
use Closure;

class AuthApiMddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Attendee::where('api_token',$request->token)->first();

        if($user && $request->token) {
            $request->user = $user;
            return $next($request);
        }
        return response()->json(['message'=>'Unauthorized user'],401);

    }
}
