<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole_AuthMiddleware
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

         if($result == 'unauthorized'){
            return redirect('/login')->cookie('token','',-1);;
        }
        else{
            if($result->role == 'Customer'){
                return redirect('/login')->cookie('token','',-1);;
            }
            elseif($result->role == 'Admin'){
                $request->headers->set('id',$result->userId);
                return $next($request);
            }
        }
     }
}
