<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $route = $request->route();
        // $token = $request->cookie('jwt');

        // $payload = JWT::decode($token, $_ENV['JWT_SECRET'], $_ENV['JWT_ALGO']);
        // dump($payload);

        return $next($request);
    }
}
