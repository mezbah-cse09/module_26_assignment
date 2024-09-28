<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helper\JWTToken;

class CustomerAPI_Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('token');
        $result = JWTToken::VerifyToken($token);

        if ($result == 'unauthorized') {
            return response('unauthorized', 401)->cookie('token', '', -1);
        } else {
            if ($result->role == 'Admin') {
                return response('unauthorized', 401)->cookie('token', '', -1);
            } elseif ($result->role == 'Customer') {
                $request->headers->set('id', $result->userId);
                return $next($request);
            }
        }
    }
}
