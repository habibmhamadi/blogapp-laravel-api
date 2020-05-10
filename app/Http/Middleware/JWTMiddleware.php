<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTMiddleware
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
        $message = '';

        try {
            // checks token validations
            JWTAuth::parseToken()->authenticate();
            return $next($request);

      } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
          // do whatever you want to do if a token is expired
          $message = 'token expired';
      } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
          // do whatever you want to do if a token is invalid
          $message = 'invalid token';
      } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
          // do whatever you want to do if a token is not present
          $message = 'provide token';
      }
      return response()->json([
              'success' => false,
              'message' => $message
        ]);
    }
}
