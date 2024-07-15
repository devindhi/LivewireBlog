<?php

namespace App\Http\Middleware;

use App\Exceptions\GeneralJsonException;
use App\Helpers\DecodeJwt;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

     private $jwtHelper;

     public function __construct( DecodeJwt $jwtHelper)
     {
         $this->jwtHelper = $jwtHelper;
     }

    public function handle(Request $request, Closure $next): Response
    {
        {
            $token = (string) $request->bearerToken();
            if (!$token) {
                throw new GeneralJsonException("Not Authorized",401);
            }
         
            $this->jwtHelper->decodeJwtToken($token); //decode token to see if it is valid
            return $next($request);
        }
    }
}
