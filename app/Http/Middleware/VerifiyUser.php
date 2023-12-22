<?php

namespace App\Http\Middleware;

use App\Help\JWTToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifiyUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       $token= $request->header('token');
       $verifiedEmail= JWTToken::TestToken($token);
       if($verifiedEmail=='notValid'){
        return response()->json([
            'status'=>"failed",
            'message'=>"not valid user"
        ]);
       } else {
         $request->headers->set('email',$verifiedEmail);
        return $next($request);
       }
         
    }
}
