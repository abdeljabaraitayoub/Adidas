<?php

namespace App\Http\Middleware;

use App\Models\Route;
use App\Models\User;
use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\pemissions;
use Illuminate\Support\Facades\DB;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $route = $request->route();
        $token = $request->header('Authorization');
        if (!$token) {
            return response()->json(['message' => 'No token provided'], 401);
        }
        $data = JWT::decode($token, new Key($_ENV['JWT_SECRET'], 'HS256'));
        if (!$data) {
            return response()->json(['message' => 'Invalid token'], 401);
        } else {
            DB::enableQueryLog();
            $user = User::find($data->id);
            if (!$user) {
                return response()->json(['message' => 'User not found'], 401);
            }
            if ($user->role_id == 1) {
                return $next($request);
            }
            $route = Route::where('name', $route->getName())->first();
            $permission = pemissions::where('role_id', $user->role_id)->where('route_id', $route->id)->first();
            if (!$permission) {
                return response()->json(['message' => 'You do not have permission to access this route'], 401);
            }
            // dump($permission);
        }
        return $next($request);
    }
}
