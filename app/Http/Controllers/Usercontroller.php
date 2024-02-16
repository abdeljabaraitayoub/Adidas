<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;


class Usercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * @OA\Get(
     *     path="/api/users",
     *     @OA\Response(response="200", description="An example endpoint")
     * )
     */
    public function index()
    {
        $users = User::join('roles', 'users.role_id', '=', 'roles.id')->select('users.*', 'roles.name as role_name')->get();
        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role_id = $request->role_id;
        $user->save();
        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role_id = $request->role_id;
        $user->save();
        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }
}
