<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        $token = $request->cookie('token');
        if($token !== null){
            $result = JWTToken::VerifyToken($token);
            $request->headers->set('id',$result->userId);
            if($result->role == 'Admin'){
                return redirect('/admin/dashboard');
            }
            elseif($result->role == 'Customer'){
                return $next($request);
            }
        }
        return $next($request);
    }
}
