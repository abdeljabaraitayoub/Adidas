<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

// GENERATION DES TOKENS
use Firebase\JWT\JWT;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

//MAIL SENDING
use Illuminate\Support\Facades\Mail;
use App\Mail\passwordreset;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = user::where('email', $request->email)->first();

        $payload = [
            'iss' => $_SERVER['HTTP_HOST'],
            'iat' => time(),
            'id' => $user->id,
        ];

        if (password_verify($request->password, $user->password)) {
            $jwt = JWT::encode($payload, $_ENV['JWT_SECRET'], $_ENV['JWT_ALGO']);
            // Cookie::queue(cookie()->forever('jwt', $jwt));
            return response()->json([
                'message' => 'Successfully logged in!',
                'Authorisation' => $jwt,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid credentials!',
            ], 401);
        }
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $user->save();

        return response()->json([
            'message' => 'Successfully created user!',
        ], 201);
    }


    public function generateResetToken(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);

        $user = User::all()->where('email', $request->email)->first();
        $id = $user->id;

        $token = Str::random(6);
        Cache::put($token, $id, 5 * 60);
        Mail::to("c4afebdc59@emailabox.pro")->send(new passwordreset($token));
        return response()->json([
            'token' => $token,
        ], 200);
    }

    public function ResetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required|string'
        ]);
        $id = Cache::get($request->token);
        if (!$id) {
            return response()->json([
                'message' => 'Invalid token!',
            ], 403);
        }
        $user = User::find($id);
        $user->password = password_hash($request->password, PASSWORD_DEFAULT);
        $user->save();
        return response()->json([
            'message' => 'Password successfully reset!',
        ], 200);
    }


    public function logout()
    {
        // Cookie::queue(Cookie::forget('jwt'));
        return response()->json([
            'message' => 'Successfully logged out!',
        ], 200);
    }
}
