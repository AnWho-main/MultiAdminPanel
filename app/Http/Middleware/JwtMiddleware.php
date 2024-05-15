<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    
    public function handle($request, Closure $next)
    {
        
        try 
        {
            $app = JWTAuth::parseToken()->authenticate();
        } 
        catch (Exception $e) 
        {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException)
            {
                return response()->json(['message' => 'Token is Invalid', 'status_code' => 401, 'status' => false], Response::HTTP_UNAUTHORIZED);
            }
            else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException)
            {
                
                return response()->json(['message' => 'Token is Expired', 'status_code' => 419, 'status' => false], 419);
            }
            else
            {
                return response()->json(['message' => 'Authorised Token Not Found', 'status_code' => 403, 'status' => false], Response::HTTP_FORBIDDEN);
            }
        }
        return $next($request);
    }
}
